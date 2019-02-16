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
						<li class="nav-item active"><a class="nav-link" href="about-me.php">&ensp; About me &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="contact.php">&ensp; Contact &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="#" data-toggle="modal" data-target="#logInModal">&ensp; Log in &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="#" data-toggle="modal" data-target="#signUpModal">&ensp; Sign up &ensp;</a></li>
					</ul>
				</div>
			</nav>	
		</header>
		<div class="container content col-12">
			<h1>&nbsp;</h1>
			<h1 align="center" class="d-none d-md-block d-md-block animated slideInLeft slow">Are you looking for an <font>expert?</font>&emsp;Post an ad...</h1>			
			<h1 align="center" class="d-none d-md-block animated slideInRight slow">Do you want to earn <font>money?</font>&emsp;Find work...</h1>
			<h1 align="center" class="animated bounceInUp slow">Just <font>be free!</font></h1>
			<div align="center" class="options col-sm-9 d-flex justify-content-between flex-column flex-md-row">
				<div class="option1">
					<a href="freelancer.php">I want to WORK</a>
				</div>	
				<div class="option2">
					<a href="employer.php">I want to HIRE</a>
				</div>
			</div>
		</div>
		<!-- Log in modal -->
		<div class="modal fade" id="logInModal" tabindex="-1" role="dialog" aria-labelledby="logInModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="logInModalLongTitle">Log in</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="log-in.php" method="post"> 
							<img src="img/avatar.png" alt="Avatar" class="avatar">
							<input class="popUpInput" type="text" placeholder="Enter login" name="login">
							<input class="popUpInput" type="password" placeholder="Enter password" name="password">
							<button class="popUpButton" type="submit">Log in</button>
							<a href="#" data-dismiss="modal" data-toggle="modal" data-target="#signUpModal">Create account</a>	
							<?php
								if (isset($_SESSION['logInError'])) {
									echo "</br>".$_SESSION['logInError']."</br>";
									echo "<script>$(window).load(function(){
												$('#logInModal').modal('show');
										});</script>";
								}
							?>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Sign up modal -->
		<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="signUpModalLongTitle">Sign up</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						
						<img src="img/signup.png" alt="Image" class="avatar">
						
						<form action="sign-up.php" method="post">
							<input class="popUpInput" type="text" placeholder="Login" value="<?php
								if (isset($_SESSION['fr_login'])) {
									echo $_SESSION['fr_login'];
									unset($_SESSION['fr_login']);
								}
							?>" name="login"/>
							<?php
								if (isset($_SESSION['e_login'])) {
									echo '<div class="error">'.$_SESSION['e_login'].'</div>';
									unset($_SESSION['e_login']);
								}
							?>
							<input class="popUpInput" type="text" placeholder="E-mail" value="<?php
								if (isset($_SESSION['fr_email'])) {
									echo $_SESSION['fr_email'];
									unset($_SESSION['fr_email']);
								}
							?>" name="email"/>
							<?php
								if (isset($_SESSION['e_email'])) {
									echo '<div class="error">'.$_SESSION['e_email'].'</div>';
									unset($_SESSION['e_email']);
								}
							?>
							<input class="popUpInput" type="password" placeholder="Password" value="<?php
								if (isset($_SESSION['fr_password1']) ) {
									echo $_SESSION['fr_password1'];
									unset($_SESSION['fr_password1']);
								}
							?>" name="password1"/>
							<?php
								if (isset($_SESSION['e_password'])) {
									echo '<div class="error">'.$_SESSION['e_password'].'</div>';
									unset($_SESSION['e_password']);
								}
							?>
							<input class="popUpInput" type="password" placeholder="Repeat password:" value="<?php
								if (isset($_SESSION['fr_password2'])) {
									echo $_SESSION['fr_password2'];
									unset($_SESSION['fr_password2']);
								}
							?>" name="password2"/>
							<label><input type="checkbox" name="rules" <?php
								if (isset($_SESSION['fr_rules'])) {
									echo "checked";
									unset($_SESSION['fr_rules']);
								}
							?>/>Accept the rules</label>
							<?php
								if (isset($_SESSION['e_rules'])) {
									echo '<div class="error">'.$_SESSION['e_rules'].'</div>';
									unset($_SESSION['e_rules']);
								}
							?>
							<div class="g-recaptcha" align="center" data-sitekey="6LeK63QUAAAAADrg75dHw0aAN58FuxoNMmk56rFn"></div>
							<?php
								if (isset($_SESSION['e_bot'])) {
									echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
									unset($_SESSION['e_bot']);
								}
							?>
							<input class="popUpButton" type="submit" value="Register"/>
							<?php
								if (isset($_SESSION['signUpError'])) {
									echo "<script>$(window).load(function(){
												$('#signUpModal').modal('show');
										});</script>";
								}
							?>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Alert modal -->
		<div class="modal fade bd-example-modal-sm" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalTitle" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Notice
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<div class="modal-body" align="center">
					It's visible only to logged in users.
					<?php
						if (!(isset($_SESSION['loggedIn'])) && isset($_SESSION['alertError'])) {
							echo "<script>$(window).load(function(){
										$('#alertModal').modal('show');
								});</script>";
						}
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