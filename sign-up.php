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
		include_once "captcha.php";
                $secret = getKey(2); //get the secret key from DB      
		$post_data = "secret=".$secret."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR'] ;
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, 
					array('Content-Type: application/x-www-form-urlencoded; charset=utf-8', 
					'Content-Length: ' . strlen($post_data)));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
                
		$googresp = curl_exec($ch);       
		$decgoogresp = json_decode($googresp);
		curl_close($ch);
		if ($decgoogresp->success == true) {
			$succVal=false;
			$_SESSION['e_bot']='<span style="color:red">*Please confirm you are not a robot!</span>';
		}
        
      
		//Remember the entered data
		$_SESSION['fr_login'] = $login;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_password1'] = $password1;
		$_SESSION['fr_password2'] = $password2;
		if (isset($_POST['rules']))		
			$_SESSION['fr_rules'] = true;

		
		require "connect.php";
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

						//send an email informing the administrator (id=1) about creating a new account
						if( $result = $connection->query("SELECT * FROM recipients WHERE id=1") ) {
							$no_of_users = $result->num_rows;
							if ($no_of_users>0) {
								$row = $result->fetch_assoc();
								$recipient = $row['email'];
							}
						}
						else {
							throw new Exception($connection->error);
						}
						$subject =	'Message from BeFree website';
						$message = 	'Someone has created a new account!' . "\r\n\n" . 
									'Login: ' . $login . "\r\n" .
									'E-mail: ' . $email . "\r\n";
						$headers =	'From: admin@befree.itlookssoeasy.com' . "\r\n" .
									'Reply-To: admin@befree.itlookssoeasy.com' . "\r\n" .
									'X-Mailer: PHP/' . phpversion();
						mail($recipient, $subject, $message, $headers);		

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