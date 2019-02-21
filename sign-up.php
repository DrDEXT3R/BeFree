<?php
	
	session_start();
	
	if (isset($_POST['email'])) {
		//assumption: successful validation
		$succVal=true;

		//check login
		$login=$_POST['login'];
		if ((strlen($login)<3) || (strlen($login)>20)) {
			$succVal=false;
			$_SESSION['e_login']='<span style="color:red">*Login must be at least 3 and up to 20 characters long!</span>';
		}
		if (ctype_alnum($login)==false) {
			$succVal=false;
			$_SESSION['e_login']='<span style="color:red">*Login must contain only letters and numbers!</span>';
		}
		
		//check e-mail
		$email=$_POST['email'];
		$emailB=filter_var($email,FILTER_SANITIZE_EMAIL);
		if ((filter_var($email,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)) {
			$succVal=false;
			$_SESSION['e_email']='<span style="color:red">*Please insert a valid email address!</span>';
		}
		
		//check password
		$password1=$_POST['password1'];
		$password2=$_POST['password2'];
		if ((strlen($password1)<8) || (strlen($password1)>20)) {
			$succVal=false;
			$_SESSION['e_password']='<span style="color:red">*Password must be at least 8 and up to 20 characters long!</span>';
		}
		if ($password1!=$password2) {
			$succVal=false;
			$_SESSION['e_password']='<span style="color:red">*Both passwords are not matching!</span>';
		}
		
		$password_hash=password_hash($password1,PASSWORD_DEFAULT);
		
		//checkbox 
		if (!isset($_POST['rules'])) {
			$succVal=false;
			$_SESSION['e_rules']='<span style="color:red">*Accept rules!</span>';
		}
		
		//Bot or not
		$secret = "6LeK63QUAAAAAFG4ZQ9mkBxWL3PSSaWaFOBpXCB2";
		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		$answer = json_decode($check);
		if ($answer->success==false) {
			$succVal=false;
			$_SESSION['e_bot']='<span style="color:red">*Please confirm you are not a robot!"</span>';
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
					$_SESSION['e_email']='<span style="color:red">*That email address is already in use!</span>';
				}
				//check if login exists
				$result = $connection->query("SELECT id FROM accounts WHERE login='$login'");
				if (!$result) 	throw new Exception($connection->error);
				$noOfTheseLogins = $result->num_rows;
				if ($noOfTheseLogins>0) {
					$succVal=false;
					$_SESSION['e_login']='<span style="color:red">*That login is already in use!</span>';
				}
				
				//Everything OK
				if ($succVal==true) {
					if( $connection->query("INSERT INTO accounts VALUES(NULL,'$login','$password_hash','$email')") ) {
						$_SESSION['succRegistration'] = true;
						$_SESSION['signUpError'] = false;
						header('Location: welcome.php');
					}
					else {
						throw new Exception($connection->error);
					}
				}
				else {
					$_SESSION['signUpError'] = true;
					header('Location: index.php');
				}				
				
				$connection->close();
			}
		}
		catch (Exception $e) {
			echo '<span style="color:red;">Server Not Found! Please try again later.</span>';
			//echo '<br/>Info: '.$e; //comment this before last release - info about exception for developer
		}
	}
		
?>