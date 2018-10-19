<?php
	
	session_start();
	
	//this if is needed when something has to be seen only for logged in users
	if( (!isset($_SESSION['loggedIn'])) ) {
		header('Location: index.php');
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
		<link rel="stylesheet" href="css/main.css">	
		<link rel="stylesheet" href="css/loginPopUp.css">	
		<script src="code.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="logo">
				beFree
				<?php
					echo "<p>Witaj ".$_SESSION['login'].'![<a href="logout.php">Log out</a>]</p>';
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