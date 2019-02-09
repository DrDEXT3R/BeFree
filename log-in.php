<?php
	
	session_start();
	
	$_SESSION['showSignUpModal'] = false;
	
	if ((!isset($_POST['login'])) || (!isset($_POST['password']))) {
		header('Location: index.php');
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
			$login = $_POST['login'];
			$password = $_POST['password'];
			
			$login = htmlentities($login,ENT_QUOTES,"UTF-8");
			
			if ($result = $connection->query(sprintf("SELECT * FROM accounts WHERE login='%s'", mysqli_real_escape_string($connection,$login)))) {
				$no_of_users = $result->num_rows;
				if ($no_of_users>0) {
					$row = $result->fetch_assoc();
					
					if ((password_verify($password,$row['password']))==true) {				
						$_SESSION['loggedIn']=true;
						$_SESSION['alertError']=false;
						
						$_SESSION['id']=$row['id'];
						$_SESSION['login'] = $row['login'];
						
						unset($_SESSION['logInError']);
						$result->close();
						header('Location: action.php');
					}
					else {
						$_SESSION['logInError']='<span style="color:red">Incorrect login or password!</span>';
						header('Location: index.php');
					}
				}
				else {
					$_SESSION['logInError']='<span style="color:red">Incorrect login or password!</span>';
					header('Location: index.php');					
				}
			}
			else {
				throw new Exception($connection->error);
			}
			
			$connection->close();
		}
	}
	catch (Exception $e) {
		echo '<span style="color:red;">Server Not Found! Please try again later.</span>';
		echo '<br/>Info: '.$e; //comment this before last release - info about exception for developer
	}
	
?>