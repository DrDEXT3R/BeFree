<?php
	
	session_start();
	
	//this if is needed when something has to be seen only for logged in users
	if ((!isset($_SESSION['loggedIn']))) {
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
				<?php
					echo "<p>Welcome ".$_SESSION['login'].'![<a href="log-out.php">Log out</a>]</p>';				
				?>
			</div>		
		</div>
	</body>
</html>