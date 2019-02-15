<?php
	
	session_start();
	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	try {
		$connection	= new mysqli($host, $db_user, $db_password, $db_name);
		if ($connection->connect_errno != 0) {
			throw new Exception(mysqli_connect_errno());
		}
		else {
			
			$name = $_POST['name'];
			$recipientID=$_POST['recipientID'];
			$message = $_POST['message'];
			
			if( $result = $connection->query("SELECT * FROM recipients WHERE id='$recipientID'") ) {
				$no_of_users = $result->num_rows;
				if ($no_of_users>0) {
					$row = $result->fetch_assoc();
					$recipient = $row['email'];
				}
			}
			else {
				throw new Exception($connection->error);
			}

			$connection->close();
			
			$subject = 'Message from BeFree website';
			$headers = 'From: webmaster@example.com' . "\r\n" .
					   'Reply-To: webmaster@example.com' . "\r\n" .
					   'X-Mailer: PHP/' . phpversion();
			
			if( mail($recipient, $subject, $message, $headers) ) { //mail() doesn't work in local server
				$_SESSION['sendEmailInfo'] = "Your message was sent successfully.";	
			}
			else {
				$_SESSION['sendEmailInfo'] = "Oops... Your message was not sent. Try Again!";	
			}
		}
	}
	catch (Exception $e) {
		echo '<span style="color:red;">Server Not Found! Please try again later.</span>';
		echo '<br/>Info: '.$e; //comment this before last release - info about exception for developer
	}
	
	$_SESSION['showSendEmailModal'] = true;
	header('Location: contact.php');
	
?>