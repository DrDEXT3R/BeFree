<?php
	
	session_start();
	
	if (isset($_POST['email'])) {
		//assumption: successful validation
		$succVal=true;
		
		//check login
		$login=$_POST['login'];
		if ((strlen($login)<3) || (strlen($login)>20)) {
			$succVal=false;
			$_SESSION['e_login']="Login must be at least 3 and up to 20 characters long!";
		}
		if (ctype_alnum($login)==false) {
			$succVal=false;
			$_SESSION['e_login']="Login must contain only letters and numbers!";
		}
		
		//check e-mail
		$email=$_POST['email'];
		$emailB=filter_var($email,FILTER_SANITIZE_EMAIL);
		if ((filter_var($email,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)) {
			$succVal=false;
			$_SESSION['e_email']="Please insert a valid email address!";
		}
		
		//check password
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];
		if ((strlen($password1)<8) || (strlen($password1)>20)) {
			$succVal=false;
			$_SESSION['e_password']="Password must be at least 8 and up to 20 characters long!";
		}
		if ($password1!=$password2) {
			$succVal=false;
			$_SESSION['e_password']="Both passwords are not matching!";
		}
		
		$password_hash=password_hash($password1,PASSWORD_DEFAULT);
		
		//checkbox 
		if (!isset($_POST['rules'])) {
			$succVal=false;
			$_SESSION['e_rules']="Accept rules!";
		}
		
		//Bot or not
		$secret = "6LeK63QUAAAAAFG4ZQ9mkBxWL3PSSaWaFOBpXCB2";
		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		$answer = json_decode($check);
		if ($answer->success==false) {
			$succVal=false;
			$_SESSION['e_bot']="Please confirm you are not a robot!";
		}
		
		//Remember the entered data
		$_SESSION['fr_login'] = $login;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_password1'] = $password1;
		$_SESSION['fr_password2'] = $password2;
		if (isset($_POST['rules']))		
			$_SESSION['fr_rules'] = true;

		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$connection	= new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno != 0) {
				throw new Exception(mysqli_connect_errno());
			}
			else {
				//check if email exists
				$result = $connection->query("SELECT id FROM accounts WHERE email='$email'");
				if (!$result) 	throw new Exception($connection->error);
				$noOfTheseEmails = $result->num_rows;
				if ($noOfTheseEmails>0) {
					$succVal=false;
					$_SESSION['e_email']="That email address is already in use!";
				}
				//check if login exists
				$result = $connection->query("SELECT id FROM accounts WHERE login='$login'");
				if (!$result) 	throw new Exception($connection->error);
				$noOfTheseLogins = $result->num_rows;
				if ($noOfTheseLogins>0) {
					$succVal=false;
					$_SESSION['e_login']="That login is already in use!";
				}
				
				//Everything OK
				if ($succVal==true) {
					if( $connection->query("INSERT INTO accounts VALUES(NULL,'$login','$password_hash','$email')") ) {
						$_SESSION['succRegistration'] = true;
						header('Location: welcome.php');
					}
					else {
						throw new Exception($connection->error);
					}
				}	
				
				$connection->close();
			}
		}
		catch (Exception $e) {
			echo '<span style="color:red;">Server Not Found! Please try again later.</span>';
			echo '<br/>Info: '.$e; //comment this before last release - info about exception for developer
		}
	}
		
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Freelance jobs</title>
		<meta name="description" content="Job board for freelancers and employers. Find for FREE commissions and offers of remote work.">
		<meta name="keywords" content="freelancer, job, work, offers, commissions, remote">
		<meta name="author" content="Tomasz Strzoda">		
		<meta http-equiv="X-Ua-Compatible" content="IE-edge,chrome=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">	
		<link rel="stylesheet" href="css/navbar.css">
		<link rel="stylesheet" href="css/loginPopUp.css">	
		<script src="code.js"></script>	
		<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Permanent+Marker" rel="stylesheet">
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<style>
			.error {
				color: red;
				margin-top: 10px;
				margin-bottom: 10px;
			}
		</style>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-default navbar-expand-lg">
				<a class="navbar-brand" href="index.php"><img src="img/logo.png" class="d-inline-block mr-1" alt=""> BeFree</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expended="false" aria-label="nav toggler">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="mainmenu">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active"><a class="nav-link" href="howitworks.php">&ensp; How it works? &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="aboutus.php">&ensp; About us &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="contact.php">&ensp; Contact &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="#" onclick="document.getElementById('modal-wrapper').style.display='block'">&ensp; Log in &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="signup.php">&ensp; Sign up &ensp;</a></li>
					</ul>
				</div>
			</nav>	
		</header>
		<form method="post">
			Login: <input type="text" value="<?php
				if (isset($_SESSION['fr_login'])) {
					echo $_SESSION['fr_login'];
					unset($_SESSION['fr_login']);
				}
			?>" name="login"/><br/>
			<?php
				if (isset($_SESSION['e_login'])) {
					echo '<div class="error">'.$_SESSION['e_login'].'</div>';
					unset($_SESSION['e_login']);
				}
			?>
			E-mail: <input type="text" value="<?php
				if (isset($_SESSION['fr_email'])) {
					echo $_SESSION['fr_email'];
					unset($_SESSION['fr_email']);
				}
			?>" name="email"/><br/>
			<?php
				if (isset($_SESSION['e_email'])) {
					echo '<div class="error">'.$_SESSION['e_email'].'</div>';
					unset($_SESSION['e_email']);
				}
			?>
			Password: <input type="password" value="<?php
				if (isset($_SESSION['fr_password1']) ) {
					echo $_SESSION['fr_password1'];
					unset($_SESSION['fr_password1']);
				}
			?>" name="password1"/><br/>
			<?php
				if (isset($_SESSION['e_password'])) {
					echo '<div class="error">'.$_SESSION['e_password'].'</div>';
					unset($_SESSION['e_password']);
				}
			?>
			Repeat password: <input type="password" value="<?php
				if (isset($_SESSION['fr_password2'])) {
					echo $_SESSION['fr_password2'];
					unset($_SESSION['fr_password2']);
				}
			?>" name="password2"/><br/>
			<label><input type="checkbox" name="rules" <?php
				if (isset($_SESSION['fr_rules'])) {
					echo "checked";
					unset($_SESSION['fr_rules']);
				}
			?>/>Accept the rules</label><br/> 
			<?php
				if (isset($_SESSION['e_rules'])) {
					echo '<div class="error">'.$_SESSION['e_rules'].'</div>';
					unset($_SESSION['e_rules']);
				}
			?>
			<div class="g-recaptcha" data-sitekey="6LeK63QUAAAAADrg75dHw0aAN58FuxoNMmk56rFn"></div>
			<?php
				if (isset($_SESSION['e_bot'])) {
					echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
					unset($_SESSION['e_bot']);
				}
			?>
			<input type="submit" value="Register"/></br>
		</form>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>