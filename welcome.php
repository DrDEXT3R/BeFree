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
		<meta charset="UTF-8">
		<title>Freelance jobs</title>
		<meta name="description" content="Job board for freelancers and employers. Find for FREE commissions and offers of remote work.">
		<meta name="keywords" content="freelancer, job, work, offers, commissions, remote">
		<meta name="author" content="Tomasz Strzoda">		
		<meta http-equiv="X-Ua-Compatible" content="IE-edge,chrome=1">
		<link rel="stylesheet" href="css/main.css">	
		<link rel="stylesheet" href="css/loginPopUp.css">	
	</head>
	<body>
		Thank you for registering to the beFree website! Now you can log in to your account.

		<div class="container">
			<div class="logo">
				beFree
				<button onclick="document.getElementById('modal-wrapper').style.display='block'" style="width:100px;">Log in</button>
				<div id="modal-wrapper" class="background">
					<form class="popUpContent animate" action="log-in.php" method="post">  
						<div class="popUpContainer">
							<span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
							<img src="img/avatar.png" alt="Avatar" class="avatar">
							<input class="popUpInput" type="text" placeholder="Enter login" name="login">
							<input class="popUpInput" type="password" placeholder="Enter password" name="password">
							<button class="popUpLogInButton" type="submit">Log in</button>
							<a href="sign-up.php">Create account</a>
							
							<?php
							//add automatically pop-up
								if (isset($_SESSION['error'])) {
									echo "</br>".$_SESSION['error']."</br>";
								}
							?>

						</div>
					</form>
				</div>
			</div>			

		</div>
	</body>
</html>