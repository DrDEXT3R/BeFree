<?php
	
	session_start();
	
	if ((isset($_SESSION['loggedIn'])) && ($_SESSION['loggedIn']==true)) {
		header('Location: action.php');
		exit();
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
		<link rel="stylesheet" href="css/style.css">	
		<link rel="stylesheet" href="css/loginPopUp.css">	
		<script src="code.js"></script>	
		<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Permanent+Marker" rel="stylesheet">
	</head>
	<body>
		<div class="menu">
			<div class="logo">
				<a href="#"> <img src="img/logo.png"/></a>
			</div>
			<div class="logo_text">
				<a href="#">BeFree</a>
			</div>
			<ol>
				<li><a href="signup.php">Sign up</a></li>
				<li><a href="#" onclick="document.getElementById('modal-wrapper').style.display='block'">Log in</a></li>
				<li><a href="#">Contact</a></li>
				<li><a href="#">About us</a></li>
				<li><a href="#">How it works?</a></li>
			</ol>
		</div>
		<div class="content">
			<div class="option1">
				<a href="freelancer.php">I want to WORK</a>
			</div>	
			<div class="option2">
				<a href="employer.php">I want to HIRE</a>
			</div>
		</div>
		<div id="modal-wrapper" class="background">
			<form class="popUpContent animate" action="login.php" method="post">  
				<div class="popUpContainer">
					<span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
					<img src="img/avatar.png" alt="Avatar" class="avatar">
					<input class="popUpInput" type="text" placeholder="Enter login" name="login">
					<input class="popUpInput" type="password" placeholder="Enter password" name="password">
					<button class="popUpLogInButton" type="submit">Log in</button>
					<a href="signup.php">Create account</a>	
					<?php
						if (isset($_SESSION['error'])) {
							echo "</br>".$_SESSION['error']."</br>";
							echo '<script>var modal = document.getElementById("modal-wrapper");window.onload = function(){modal.style.display="block";}</script>';
						}
					?>
				</div>
			</form>
		</div>	
	</body>
</html>