<?php
	
	session_start();
	
	if( isset($_POST['email']) ) {
		//assumption: successful validation
		$succVal=true;
		
		//check login
		$login=$_POST['login'];
		if( (strlen($login)<3) || (strlen($login)>20) ) {
			$succVal=false;
			$_SESSION['e_login']="Login must be at least 3 and up to 20 characters long!";
		}
		if( ctype_alnum($login)==false ) {
			$succVal=false;
			$_SESSION['e_login']="Login must contain only letters and numbers!";
		}
		
		//check e-mail
		$email=$_POST['email'];
		$emailB=filter_var($email,FILTER_SANITIZE_EMAIL);
		if( (filter_var($email,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email) ) {
			$succVal=false;
			$_SESSION['e_email']="Please insert a valid email address!";
		}
		
		//check password
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];
		if( (strlen($password1)<8) || (strlen($password1)>20) ) {
			$succVal=false;
			$_SESSION['e_password']="Password must be at least 8 and up to 20 characters long!";
		}
		if( $password1!=$password2 ) {
			$succVal=false;
			$_SESSION['e_password']="Both passwords are not matching!";
		}
		
		
		//Everything OK
		if($succVal==true) {
			echo 'WSZYSTKO OKEJ ;)';
			exit();
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
		<link rel="stylesheet" href="css/loginPopUp.css">	
		<script src="code.js"></script>
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
		<form method="post">
			Login: <input type="text" name="login"/><br/>
			<?php
				if(isset($_SESSION['e_login'])) {
					echo '<div class="error">'.$_SESSION['e_login'].'</div>';
					unset($_SESSION['e_login']);
				}
			?>
			E-mail: <input type="text" name="email"/><br/>
			<?php
				if(isset($_SESSION['e_email'])) {
					echo '<div class="error">'.$_SESSION['e_email'].'</div>';
					unset($_SESSION['e_email']);
				}
			?>
			Password: <input type="password" name="password1"/><br/>
			<?php
				if(isset($_SESSION['e_password'])) {
					echo '<div class="error">'.$_SESSION['e_password'].'</div>';
					unset($_SESSION['e_password']);
				}
			?>
			Repeat password: <input type="password" name="password2"/><br/>
			<label><input type="checkbox" name="rules"/>Accept the rules</label><br/> 
			<div class="g-recaptcha" data-sitekey="6LeK63QUAAAAADrg75dHw0aAN58FuxoNMmk56rFn"></div>
			<input type="submit" value="Register"/></br>
		</form>
	</body>
</html>