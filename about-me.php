<?php
	
	session_start();
	
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
		<link rel="stylesheet" href="css/style.css">	
		<link rel="stylesheet" href="css/navbar.css">
		<link rel="stylesheet" href="css/pop-up.css">			
		<link rel="stylesheet" href="css/about-me.css">	
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Permanent+Marker" rel="stylesheet">
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
						<li class="nav-item active"><a class="nav-link" href="about-me.php">&ensp; <u>About me</u> &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="contact.php">&ensp; Contact &ensp;</a></li>				
						<?php
							if ((!isset($_SESSION['loggedIn']))) {
								echo '<li class="nav-item active"><a class="nav-link" href="#" data-toggle="modal" data-target="#logInModal">&ensp; Log in &ensp;</a></li>
									  <li class="nav-item active"><a class="nav-link" href="#" data-toggle="modal" data-target="#signUpModal">&ensp; Sign up &ensp;</a></li>';
							}
							else {
								echo '<li class="nav-item active"><a class="nav-link" href="my-account.php">&ensp; My account &ensp;</a></li>
									  <li class="nav-item active"><a class="nav-link" href="log-out.php">&ensp; Log Out &ensp;</a></li>';
							}
						?>
					</ul>
				</div>
			</nav>	
		</header>
		<div class="container containerFreelancer col-11 col-sm-9">		
			<div class="about d-flex justify-content-between flex-column flex-lg-row">
				<div class="block col-lg-3">
					<div class="image"> 
						<img src="img/author1.png" alt="img">
					</div>
					<div class="basicInfo d-flex justify-content-between flex-column flex-md-row flex-lg-column"> 
						<div class="text-center">
							<img src="img/email2.png"> <a href="contact.php">Send e-mail</a></br>
						</div>	
						<div class="text-center">
							<img src="img/github.png"> <a href="https://github.com/DrDEXT3R" target="_blank">Visit GitHub</a></br>
						</div>	
						<div class="text-center">
							<img src="img/blog.png"> <a href="https://github.com/DrDEXT3R" target="_blank">Visit Blog</a>&nbsp;&nbsp;&nbsp;</br>
						</div>	
					</div>					
				</div>	
				<div class="col-lg-9 align-self-center">
					<div class="authorName"> 
						>&nbsp;Tomasz Strzoda&nbsp;<
					</div> 
					<div class="college"> 
						 <img src="img/college.png"> University: <a href="https://www.google.pl/search?source=hp&ei=Oh5jXMXrHJKKrwTk_JqIBw&q=Silesian+University+of+Technology&btnK=Szukaj+w+Google&oq=Silesian+University+of+Technology&gs_l=psy-ab.3..35i39j0j38j0i30l7.673.7847..8087...0.0..0.127.929.12j1......0....1..gws-wiz.....0..0i131j0i67j35i304i39j0i13j0i13i30.Xof-gBC00As#btnK=Szukaj%20w%20Google" target="_blank">Silesian University of Technology</a>
					</div>
					<div class="description"> 
						<p>
						I'm a normal guy with a great dream of doing something useful for society. That's why, seeing the constant growth of freelancing, I decided to make life easier for many employees and employers. I believe that with this portal, I will conquer the freelance market around the world and the development plan of my website (because I still have a lot of ideas) will make me the leader in the world.
						</p>
					</div>
				</div>
			</div>
			<div class="slide">
				<img src="img/aeiiMap.png" alt="Image" class="mapImg">
				<div class="overlay">
					<div class="text">
						<a href="https://www.google.com/maps/place/Politechnika+%C5%9Al%C4%85ska,+Wydzia%C5%82+Automatyki,+Elektroniki+i+Informatyki/@50.2887094,18.6750773,17z/data=!3m1!4b1!4m5!3m4!1s0x4711310230b29c0f:0xeab62045ee48e692!8m2!3d50.288706!4d18.677266" target="_blank">Go to map</a>
					</div>
				</div>
			</div>		
			<div class="divider col-12"></div>
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
						<form class="needs-validation" novalidate action="sign-up.php" method="post">
							<div>
								<!-- Login -->
								<input type="text" class="form-control form-control-lg popUpInput" placeholder="Login" 
								value= "<?php
											if (isset($_SESSION['fr_login'])) {
												echo $_SESSION['fr_login'];
												unset($_SESSION['fr_login']);
											}
										?>" name="login" required>
								<div class="invalid-feedback"></div>
								<?php
									if (isset($_SESSION['e_login'])) {
										echo '<div class="error">'.$_SESSION['e_login'].'</div>';
										unset($_SESSION['e_login']);
									}
								?>
								<!-- E-mail -->
								<input type="text" class="form-control form-control-lg popUpInput" placeholder="E-mail" 
								value= "<?php
											if (isset($_SESSION['fr_email'])) {
												echo $_SESSION['fr_email'];
												unset($_SESSION['fr_email']);
											}
										?>" name="email" required>
								<div class="invalid-feedback"></div>
								<?php
									if (isset($_SESSION['e_email'])) {
										echo '<div class="error">'.$_SESSION['e_email'].'</div>';
										unset($_SESSION['e_email']);
									}
								?>
								<!-- Password -->
								<input type="password" class="form-control form-control-lg popUpInput" placeholder="Password" 
								value= "<?php
											if (isset($_SESSION['fr_password1']) ) {
												echo $_SESSION['fr_password1'];
												unset($_SESSION['fr_password1']);
											}
										?>" name="password1" required>
								<div class="invalid-feedback"></div>
								<?php
									if (isset($_SESSION['e_password'])) {
										echo '<div class="error">'.$_SESSION['e_password'].'</div>';
										unset($_SESSION['e_password']);
									}
								?>
								<!-- Repeat password -->
								<input type="password" class="form-control form-control-lg popUpInput" placeholder="Repeat password" 
								value= "<?php
											if (isset($_SESSION['fr_password2'])) {
												echo $_SESSION['fr_password2'];
												unset($_SESSION['fr_password2']);
											}
										?>" name="password2" required>
							</div>
							<!-- Rules -->
							<input class="form-check-input" type="checkbox" name="rules" 
									<?php
										if (isset($_SESSION['fr_rules'])) {
											echo "checked";
											unset($_SESSION['fr_rules']);
										}
									?> 
									required> 
							<label class="form-check-label checkbox">Accept the rules</label>
							<div class="invalid-feedback"></div>
							<?php
								if (isset($_SESSION['e_rules'])) {
									echo '<div class="error">'.$_SESSION['e_rules'].'</div>';
									unset($_SESSION['e_rules']);
								}
							?>
							<!-- reCAPTCHA -->
							<div class="g-recaptcha" align="center" data-sitekey="6LeK63QUAAAAADrg75dHw0aAN58FuxoNMmk56rFn"></div>
							<?php
								if (isset($_SESSION['e_bot'])) {
									echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
									unset($_SESSION['e_bot']);
								}
							?>
							<!-- Submit button -->
							<input class="popUpButton" type="submit" value="Register"/>
							<?php
								if (isset($_SESSION['signUpError'])) {
									echo "<script>$(window).load(function(){
												$('#signUpModal').modal('show');
										});</script>";
								}
							?>
						</form>
						<script>
							// Starter JavaScript for disabling form submissions if there are invalid fields
							(function() {
							'use strict';
							window.addEventListener('load', function() {
								// Fetch all the forms we want to apply custom Bootstrap validation styles to
								var forms = document.getElementsByClassName('needs-validation');
								// Loop over them and prevent submission
								var validation = Array.prototype.filter.call(forms, function(form) {
									form.addEventListener('submit', function(event) {
										if (form.checkValidity() === false) {
											event.preventDefault();
											event.stopPropagation();
										}
										form.classList.add('was-validated');
									}, false);
								});
							}, false);
							})();
						</script>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>