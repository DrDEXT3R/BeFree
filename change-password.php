<?php
	
	session_start();

	if ((!isset($_SESSION['loggedIn']))) {
		header('Location: index.php');
		exit();
	}
	
	if ((!isset($_POST['password'])) || (!isset($_POST['newPassword'])) || (!isset($_POST['newPassword2']))) {
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
			$newPassword = $_POST['newPassword'];
			$newPassword2 = $_POST['newPassword2'];
			
			$password_hash=password_hash($newPassword,PASSWORD_DEFAULT);
			
			if ($result = $connection->query(sprintf("SELECT * FROM accounts WHERE login='$_SESSION[login]'"))) {
				$no_of_users = $result->num_rows;
				if ($no_of_users>0) {
					$row = $result->fetch_assoc();
					if ((password_verify($password,$row['password']))==true) {	
						if($newPassword == $newPassword2) {
							if ($connection->query(sprintf("UPDATE accounts SET password='%s' WHERE login='$_SESSION[login]'", $password_hash)) ) {
								$result->close();
								$_SESSION['changePasswordInfo'] = "The password was changed successfully!";
							}
							else {
								$_SESSION['changePasswordInfo'] = "Server Not Found! Please try again later.";
							}
						}
						else {
							$_SESSION['changePasswordInfo'] = "The passwords do not match.";
						}
					}
					else {
						$_SESSION['changePasswordInfo'] = "The password is incorrect.";
					}
				}
				else {
					$_SESSION['changePasswordInfo'] = "Server Not Found! Please try again later.";			
				}
			}
			else {
				throw new Exception($connection->error);
			}
			
			$connection->close();
		}
	}
	catch (Exception $e) {
		$_SESSION['changePasswordInfo'] = "Server Not Found! Please try again later.";
	}
	
	$_SESSION['showChangePasswordModal'] = true;
	header('Location: my-account.php');	
		
?>


		