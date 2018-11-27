<?php
	
	session_start();

	if ((!isset($_SESSION['loggedIn']))) {
		header('Location: index.php');
		exit();
	}
	
	if ((!isset($_POST['password'])) || (!isset($_POST['newEmail'])) || (!isset($_POST['newEmail']))) {
		header('Location: my-account.php');
		exit();
	}
	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try {
		$connection	= new mysqli($host, $db_user, $db_password, $db_name);
		if ($connection->connect_errno != 0) {
			throw new Exception(mysqli_connect_errno());
		}
		else {
			$password = $_POST['password'];
			$newEmail = $_POST['newEmail'];
			$newEmail2 = $_POST['newEmail2'];
			
			$newEmail = htmlentities($newEmail,ENT_QUOTES,"UTF-8");
			$newEmail2 = htmlentities($newEmail2,ENT_QUOTES,"UTF-8");
			
			if ($result = $connection->query(sprintf("SELECT * FROM accounts WHERE login='$_SESSION[login]'"))) {
				$no_of_users = $result->num_rows;
				if ($no_of_users>0) {
					$row = $result->fetch_assoc();
					if ((password_verify($password,$row['password']))==true) {	
						if($newEmail == $newEmail2) {
							if ($connection->query(sprintf("UPDATE accounts SET email='%s' WHERE login='$_SESSION[login]'", $newEmail)) ) {
								$result->close();
								$_SESSION['changeEmailInfo'] = "The e-mail address was changed successfully!";
							}
							else {
								$_SESSION['changeEmailInfo'] = "Server Not Found! Please try again later.";
							}
						}
						else {
							$_SESSION['changeEmailInfo'] = "The e-mail addresses do not match.";
						}
					}
					else {
						$_SESSION['changeEmailInfo'] = "The password is incorrect.";
					}
				}
				else {
					$_SESSION['changeEmailInfo'] = "Server Not Found! Please try again later.";			
				}
			}
			else {
				throw new Exception($connection->error);
			}
			
			$connection->close();
		}
	}
	catch (Exception $e) {
		$_SESSION['changeEmailInfo'] = "Server Not Found! Please try again later.";
	}
	
	$_SESSION['showChangeEmailModal'] = true;
	header('Location: my-account.php');	
		
?>


		