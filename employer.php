<?php
	
	session_start();
	
	if (isset($_POST['description'])) {
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
		<link rel="stylesheet" href="css/main.css">	
		<script src="code.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="logo">
			beFree
			</div>
			<div class="menu"></div>
			

			
			<form method="post">
				Employer: <input type="text" value="<?php
					if (isset($_SESSION['fr_employer'])) {
						echo $_SESSION['fr_employer'];
						unset($_SESSION['fr_employer']);
					}
				?>" name="employer"/><br/>
				<?php
					if (isset($_SESSION['e_employer'])) {
						echo '<div class="error">'.$_SESSION['e_employer'].'</div>';
						unset($_SESSION['e_employer']);
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
				Technique: <input type="text" value="<?php
					if (isset($_SESSION['fr_technique']) ) {
						echo $_SESSION['fr_technique'];
						unset($_SESSION['fr_technique']);
					}
				?>" name="technique"/><br/>
				<?php
					if (isset($_SESSION['e_technique'])) {
						echo '<div class="error">'.$_SESSION['e_technique'].'</div>';
						unset($_SESSION['e_technique']);
					}
				?>
				Description: <input type="text" value="<?php
					if (isset($_SESSION['fr_description']) ) {
						echo $_SESSION['fr_description'];
						unset($_SESSION['fr_description']);
					}
				?>" name="description"/><br/>
				<?php
					if (isset($_SESSION['e_description'])) {
						echo '<div class="error">'.$_SESSION['e_description'].'</div>';
						unset($_SESSION['e_description']);
					}
				?>
				Location: <input type="text" value="<?php
					if (isset($_SESSION['fr_location']) ) {
						echo $_SESSION['fr_location'];
						unset($_SESSION['fr_location']);
					}
				?>" name="location"/><br/>
				<?php
					if (isset($_SESSION['e_location'])) {
						echo '<div class="error">'.$_SESSION['e_location'].'</div>';
						unset($_SESSION['e_location']);
					}
				?>
				Phone number: <input type="text" value="<?php
					if (isset($_SESSION['fr_phone'])) {
						echo $_SESSION['fr_phone'];
						unset($_SESSION['fr_phone']);
					}
				?>" name="phone"/><br/>
				<?php
					if (isset($_SESSION['e_phone'])) {
						echo '<div class="error">'.$_SESSION['e_phone'].'</div>';
						unset($_SESSION['e_phone']);
					}
				?>
				Price: <input type="text" value="<?php
					if (isset($_SESSION['fr_price'])) {
						echo $_SESSION['fr_price'];
						unset($_SESSION['fr_price']);
					}
				?>" name="price"/><br/>
				<?php
					if (isset($_SESSION['e_price'])) {
						echo '<div class="error">'.$_SESSION['e_price'].'</div>';
						unset($_SESSION['e_price']);
					}
				?>
				<input type="submit" value="Add offer"/></br>
			</form>
			
			
			
			
		</div>
	</body>
</html>