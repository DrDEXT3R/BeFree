<?php
	
	session_start();
	
	if (!isset($_SESSION['succRegistration'])) {
		header('Location: index.php');
		exit();
	}
	else {
		unset($_SESSION['succRegistration']);
	}
	
	
	//Removing variables used for saving the entered data in the registration form
	if (isset($_SESSION['fr_login']))		unset($_SESSION['fr_login']);
	if (isset($_SESSION['fr_email']))		unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_password1']))	unset($_SESSION['fr_password1']);
	if (isset($_SESSION['fr_password2']))	unset($_SESSION['fr_password2']);
	if (isset($_SESSION['fr_rules']))		unset($_SESSION['fr_rules']);
	
	//Removing registration errors
	if (isset($_SESSION['e_login']))		unset($_SESSION['e_login']);
	if (isset($_SESSION['e_email']))		unset($_SESSION['e_email']);
	if (isset($_SESSION['e_password']))		unset($_SESSION['e_password']);
	if (isset($_SESSION['e_rules']))		unset($_SESSION['e_rules']);
	if (isset($_SESSION['e_bot']))			unset($_SESSION['e_bot']);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Overview -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>BeFree</title>
		<meta name="description" content="Job board for freelancers and employers. Find for FREE commissions and offers of remote work.">
		<meta name="keywords" content="befree, freelancer, job, work, offers, commissions, remote">
		<meta name="author" content="Tomasz Strzoda">		
		<meta http-equiv="X-Ua-Compatible" content="IE-edge,chrome=1">
		<!-- Icons for Android devices -->
		<link rel="icon" type="image/png" href="img/favicon/favicon.png" sizes="16x16" />
		<link rel="icon" type="image/png" href="img/favicon/favicon.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="img/favicon/favicon.png" sizes="96x96" />
		<link rel="icon" type="image/png" href="img/favicon/favicon.png" sizes="160x160" />
		<link rel="icon" type="image/png" href="img/favicon/favicon.png" sizes="196x196" />
		<!-- Icons for Apple devices -->
		<link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-touch-icon.png" />
		<!-- Icon for Windows -->
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="img/favicon/mstile-150x150.png">
		<!-- Style sheets and more -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
		<link rel="stylesheet" href="css/style.css">	
		<link rel="stylesheet" href="css/navbar.css">	
		<link rel="stylesheet" href="css/pop-up.css">	
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136379266-2"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
		
			gtag('config', 'UA-136379266-2');
		</script>
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
						<li class="nav-item active"><a class="nav-link" href="how-it-works.php">&ensp; How it works &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="about-me.php">&ensp; About me &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="contact.php">&ensp; Contact &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="#" data-toggle="modal" data-target="#logInModal">&ensp; Log in &ensp;</a></li>
					</ul>
				</div>
			</nav>	
		</header>
		<div class="container content col-12 asyncImage" data-src="img/main2.png">
			<h1>&nbsp;</h1>
			<h1 align="center" class="d-none d-md-block d-md-block animated slideInLeft slow">Are you looking for an <font>expert?</font>&emsp;Post an ad...</h1>			
			<h1 align="center" class="d-none d-md-block animated slideInRight slow">Do you want to earn <font>money?</font>&emsp;Find work...</h1>
			<h1 align="center" class="animated bounceInUp slow">Just <font>be free!</font></h1>
			<div align="center" class="options col-sm-9 d-flex align-items-center justify-content-between flex-column flex-md-row">
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
							<input class="form-control form-control-lg popUpInput" type="text" placeholder="Enter login" name="login" required>
							<div class="invalid-feedback"></div>
							<input class="form-control form-control-lg popUpInput" type="password" placeholder="Enter password" name="password" required>
							<div class="invalid-feedback"></div>
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
		<!-- Alert modal -->
		<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalTitle" aria-hidden="true">
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
		<!-- Registration complete modal -->
		<div class="modal fade" id="regCompleteModal" tabindex="-1" role="dialog" aria-labelledby="regCompleteModalTitle" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="col-12 modal-title text-center">Registration complete
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h5>
				</div>
				<div class="modal-body" align="center">
					Thank you for registering to the BeFree website! Now you can log in to your account.
					<?php
						echo "<script>$(window).load(function(){
									$('#regCompleteModal').modal('show');
							});</script>";
					?>	
				</div>
			</div>
		  </div>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="replace.js"></script>	
	</body>
</html>		