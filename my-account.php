<?php
	
	session_start();
	
	if ((!isset($_SESSION['loggedIn']))) {
		header('Location: index.php');
		exit();
	}
		
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Freelance jobs</title>
		<meta name="description" content="Job board for freelancers and employers. Find for FREE commissions and offers of remote work.">
		<meta name="keywords" content="freelancer, job, work, offers, commissions, remote">
		<meta name="author" content="Tomasz Strzoda">		
		<meta http-equiv="X-Ua-Compatible" content="IE-edge,chrome=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
		<link rel="stylesheet" href="css/style.css">	
		<link rel="stylesheet" href="css/navbar.css">	
		<link rel="stylesheet" href="css/pop-up.css">	
		<link rel="stylesheet" href="css/my-account.css">	
		<script src="code.js"></script>	
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Permanent+Marker" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Pacifico&amp;subset=latin-ext" rel="stylesheet">
	</head>
	<body>
		<header>
			<nav class="navbar navbar-default navbar-expand-lg">
				<a class="navbar-brand" href="index.php"><img src="img/logo.png" class="d-inline-block mr-1" alt=""> BeFree</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="nav toggler">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="mainmenu">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active"><a class="nav-link" href="how-it-works.php">&ensp; How it works? &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="about-us.php">&ensp; About us &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="contact.php">&ensp; Contact &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="my-account.php">&ensp; My account &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="log-out.php">&ensp; Log Out &ensp;</a></li>
					</ul>
				</div>
			</nav>	
		</header>
		<div class="container col-11 col-sm-9">
			<div class="profile d-flex justify-content-around flex-column flex-md-row"> 
				<div class="image position-static col-md-4">
					<img src="img/profile.png" alt="Profile Image">
				</div>
				<div class="profileInfo position-static col-md-7">
					<?php
						echo '<p class="hello">Hello <font>'.$_SESSION['login'].'</font>!</p></br>';				

						require_once "connect.php";
						mysqli_report(MYSQLI_REPORT_STRICT);
						
						try {
							$connection	= new mysqli($host, $db_user, $db_password, $db_name);
							if ($connection->connect_errno != 0) {
								throw new Exception(mysqli_connect_errno());
							}
							else {				
								if ($result = $connection->query(sprintf("SELECT email FROM accounts WHERE login='$_SESSION[login]'"))) {					
									while ($row = $result->fetch_assoc()) 
										echo '<img src="img/email.png"><p class="email">E-mail: <font>'.$row['email'].'</font></p>';	
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
				</div>
			</div>
			<div class="change d-flex justify-content-around flex-column flex-md-row">
				<div class="changeEmail col-md-5">
					<form action="change-email.php" method="post"> 
						<input class="popUpInput" type="password" placeholder="Enter your password" name="password">
						<input class="popUpInput" type="text" placeholder="Enter new email" name="newEmail">
						<input class="popUpInput" type="text" placeholder="Repeat new email" name="newEmail2">
						<button class="popUpButton" type="submit">Change e-mail</button>
					</form>
				</div>
				<div class="changePassword col-md-5">
					<form action="change-password.php" method="post"> 
						<input class="popUpInput" type="password" placeholder="Enter your password" name="password">
						<input class="popUpInput" type="password" placeholder="Enter new password" name="newPassword">
						<input class="popUpInput" type="password" placeholder="Repeat new password" name="newPassword2">
						<button class="popUpButton" type="submit">Change password</button>
					</form>
				</div>
				
			</div>
		</div>
		
		<?php
		
			if ($_SESSION['showChangeEmailModal'] == true) {
				echo "<script>$(window).load(function(){
						$('#changeEmailModal').modal('show');
					});</script>";
				$_SESSION['showChangeEmailModal'] = false;
					
			}
			
			if ($_SESSION['showChangePasswordModal'] == true) {
				echo "<script>$(window).load(function(){
						$('#changePasswordModal').modal('show');
					});</script>";
				$_SESSION['showChangePasswordModal'] = false;
					
			}
			
		?>
		
		<!-- Change e-mail address modal -->
		<div class="modal fade" id="changeEmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Change e-mail address</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<?php
					echo $_SESSION['changeEmailInfo'];
				?>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Change password modal -->
		<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Change password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<?php
					echo $_SESSION['changePasswordInfo'];
				?>
			  </div>
			</div>
		  </div>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>



		
		


		
	
		
