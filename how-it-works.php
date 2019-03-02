<?php
	
	session_start();
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Overview -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>BeFree - How It Works</title>
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
		<link rel="stylesheet" href="css/style.css">	
		<link rel="stylesheet" href="css/navbar.css">
		<link rel="stylesheet" href="css/pop-up.css">			
		<link rel="stylesheet" href="css/how-it-works.css">	
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
						<li class="nav-item active"><a class="nav-link" href="how-it-works.php">&ensp; <u>How it works</u> &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="about-me.php">&ensp; About me &ensp;</a></li>
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
		<div class="container col-11 col-sm-9">		
			<p class="text-center">
				1. Are you looking for an freelancer or a job?
			</p>
			<div class="image col-md-10 rounded mx-auto d-block"> 
				<img src="img/how-it-works1.jpg" alt="img">
			</div>
			<span class="dot"></span>
			<span class="dot"></span>
			<span class="dot"></span>
			<p class="text-center">
				2. First log in to your account or create one
			</p>
			<div class="image col-md-10 rounded mx-auto d-block"> 
				<img src="img/how-it-works2.jpg" alt="img">
			</div>
			<span class="dot"></span>
			<span class="dot"></span>
			<span class="dot"></span>
			<p class="text-center">
				3. Now you can easily post an announcement or find one
			</p>
			<div class="image col-md-10 rounded mx-auto d-block"> 
				<img src="img/how-it-works3.jpg" alt="img">
			</div>
			<span class="dot"></span>
			<span class="dot"></span>
			<span class="dot"></span>
			<p class="text-center">
				4. Wait for someone to answer or do it yourself
			</p>
			<div class="image col-md-10 rounded mx-auto d-block"> 
				<img src="img/how-it-works4.jpg" alt="img">
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
							<label class="form-check-label checkbox">
								<a href="rules.html" 
									onclick="window.open('rules.html', 'newwindow', 'width=300,height=250'); 
									return false;">
										Accept the rules
								</a>
							</label>
							<div class="invalid-feedback"></div>
							<?php
								if (isset($_SESSION['e_rules'])) {
									echo '<div class="error">'.$_SESSION['e_rules'].'</div>';
									unset($_SESSION['e_rules']);
								}
							?>
							<!-- reCAPTCHA -->
							<div class="g-recaptcha" align="center" data-sitekey="<?php
																						require_once "captcha.php";
																						echo getKey(1); //get the site key from DB
																					?>

							"></div>
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