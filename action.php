<?php

	session_start();
	
	require_once "connect.php";
	
	$connection	= @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($connection->connect_errno != 0) {
		echo "Error: ".$connection->connect_errno;
	}
	else {
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$login=htmlentities($login,ENT_QUOTES,"UTF-8");
		
		$sql = "SELECT * FROM accounts WHERE login='$login' AND password='$password'"; 
		
		if($result = @$connection->query($sql)) {
			$no_of_users = $result->num_rows;
			if($no_of_users>0) {
				$_SESSION['loggedIn']=true;
				$row = $result->fetch_assoc();
				$_SESSION['id']=$row['id'];
				$_SESSION['login'] = $row['login'];
				
				
				unset($_SESSION['error']);
				$result->close();
			}
			else {
				$_SESSION['error']='<span style="color:red">Incorrect login or password!</span>';
			}
		}
		
		$connection->close();
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
	</head>
	<body>
		<div class="container">
			<div class="logo">
				beFree
				
				<?php
					echo "<p>Witaj".$_SESSION['login']."!";
				?>
			</div>
			<div class="menu"></div>			
			<a href="employer.html" class="button button1">
				<div class="option">
					<div class="test"></div>
					<h1>przycisk1</h1>
					<p>opis1</p>
					Szukasz zleceń
				</div>
			</a>
			<a href="freelancer.html" class="button button1">
				<div class="option">
					<h1>przycisk2</h1>
					<p>opis2</p>
					Szukasz zleceń
				</div>	
			</a>
		</div>
	</body>
</html>