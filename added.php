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
	if (isset($_SESSION['fr_employer']))	unset($_SESSION['fr_employer']);
	if (isset($_SESSION['fr_email']))		unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_technique']))	unset($_SESSION['fr_technique']);
	if (isset($_SESSION['fr_description']))	unset($_SESSION['fr_description']);
	if (isset($_SESSION['fr_location']))	unset($_SESSION['fr_location']);
	if (isset($_SESSION['fr_phone']))		unset($_SESSION['fr_phone']);
	if (isset($_SESSION['fr_price']))		unset($_SESSION['fr_price']);
	
	//Removing registration errors
	if (isset($_SESSION['e_employer']))		unset($_SESSION['e_employer']);
	if (isset($_SESSION['e_email']))		unset($_SESSION['e_email']);
	if (isset($_SESSION['e_technique']))	unset($_SESSION['e_technique']);
	if (isset($_SESSION['e_description']))	unset($_SESSION['e_description']);
	if (isset($_SESSION['e_location']))		unset($_SESSION['e_location']);
	if (isset($_SESSION['e_phone']))		unset($_SESSION['e_phone']);
	if (isset($_SESSION['e_price']))		unset($_SESSION['e_price']);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>BeFree</title>
		<meta name="description" content="Job board for freelancers and employers. Find for FREE commissions and offers of remote work.">
		<meta name="keywords" content="befree, freelancer, job, work, offers, commissions, remote">
		<meta name="author" content="Tomasz Strzoda">		
		<meta http-equiv="X-Ua-Compatible" content="IE-edge,chrome=1">
		<link rel="stylesheet" href="css/main.css">	
		<link rel="stylesheet" href="css/loginPopUp.css">		
	</head>
	<body>
		Thank you for added job announcement!

		<div class="container">
			<div class="logo">
				<a href="index.php">Back to main page</a>
			</div>
			<div class="menu"></div>			
		</div>
	</body>
</html>