<?php
	
	session_start();
	
	if ((!isset($_SESSION['loggedIn']))) {
		header('Location: index.php');
		exit();
	}
	
	if (isset($_POST['description'])) {
		//assumption: successful validation
		$succVal=true;
		
		//check employer
		$employer=$_POST['employer'];
		if ((strlen($employer)<1) || (strlen($employer)>20)) {
			$succVal=false;
			$_SESSION['e_employer']="Employer must be at least 1 and up to 20 characters long!";
		}
		
		//check e-mail
		$email=$_POST['email'];
		$emailB=filter_var($email,FILTER_SANITIZE_EMAIL);
		if ((filter_var($email,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)) {
			$succVal=false;
			$_SESSION['e_email']="Please insert a valid email address!";
		}
		
		//check technique
		$technique=$_POST['technique'];
		if ((strlen($technique)<1) || (strlen($technique)>20)) {
			$succVal=false;
			$_SESSION['e_technique']="Technique must be at least 1 and up to 20 characters long!";
		}
		
		//check description
		$description=$_POST['description'];
		if (strlen($description)<1) {
			$succVal=false;
			$_SESSION['e_description']="Description cannot be blank!";
		}
		
		//check location
		$location=$_POST['location'];
		if (strlen($location)<1) {
			$succVal=false;
			$_SESSION['e_location']="Location cannot be blank!";
		}
		
		//check phone number
		$phone=$_POST['phone'];
		if (strlen($phone)!=9) {
			$succVal=false;
			$_SESSION['e_phone']="Phone number must be 9 digits!";
		}
		if (!(ctype_digit($phone))) {
			$succVal=false;
			$_SESSION['e_phone']="Phone number must contain only digits!";
		}
		
		//check price
		$price=$_POST['price'];
		if (strlen($price)<1) {
			$succVal=false;
			$_SESSION['e_price']="Price cannot be blank!";
		}
		if (!(ctype_digit($price))) {
			$succVal=false;
			$_SESSION['e_price']="Price must contain only digits!";
		}
		
		//Remember the entered data
		$_SESSION['fr_employer'] = $employer;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_technique'] = $technique;
		$_SESSION['fr_description'] = $description;
		$_SESSION['fr_location'] = $location;
		$_SESSION['fr_phone'] = $phone;
		$_SESSION['fr_price'] = $price;

		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$connection	= new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno != 0) {
				throw new Exception(mysqli_connect_errno());
			}
			else {
				//Everything OK
				if ($succVal==true) {
					$fileName = $_FILES["fileToUpload"]["name"];
					if( $connection->query("INSERT INTO jobs VALUES(NULL,'$price','$phone','$email','$technique','$employer','$description','$location','$fileName',now())") ) {
						$_SESSION['succRegistration'] = true;
						include 'upload.php';
					}
					else {
						throw new Exception($connection->error);
					}
				}	
				
				$connection->close();
			}
		}
		catch (Exception $e) {
			echo '<span style="color:red;">Server Not Found! Please try again later.</span>';
			echo '<br/>Info: '.$e; //comment this before last release - info about exception for developer
		}
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
		<link rel="stylesheet" href="css/style.css">	
		<link rel="stylesheet" href="css/navbar.css">
		<link rel="stylesheet" href="css/bookmarks.css">
		<link rel="stylesheet" href="css/employer.css">
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
						<li class="nav-item active"><a class="nav-link" href="about-us.php">&ensp; About us &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="contact.php">&ensp; Contact &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="my-account.php">&ensp; My account &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="log-out.php">&ensp; Log Out &ensp;</a></li>
					</ul>
				</div>
			</nav>	
		</header>
		<div class="container col-11 col-sm-9">
			<form method="post" enctype="multipart/form-data">
				<div class="row">
					<img src="img/employer.png">
					<div class="name">Employer </div>
					<input class="col-xl-9 right" type="text" value="<?php
						if (isset($_SESSION['fr_employer'])) {
							echo $_SESSION['fr_employer'];
							unset($_SESSION['fr_employer']);
						}
					?>" name="employer" placeholder="Company name / person who employs"/><br/>
					<?php
						if (isset($_SESSION['e_employer'])) {
							echo '<div class="error">'.$_SESSION['e_employer'].'</div>';
							unset($_SESSION['e_employer']);
						}
					?>
				</div>
				<div class="row">
					<img src="img/email.png">
					<div class="name">E-mail </div>
					<input class="col-xl-9 right" type="text" value="<?php
						if (isset($_SESSION['fr_email'])) {
							echo $_SESSION['fr_email'];
							unset($_SESSION['fr_email']);
						}
					?>" name="email" placeholder="name@example.com"/><br/>
					<?php
						if (isset($_SESSION['e_email'])) {
							echo '<div class="error">'.$_SESSION['e_email'].'</div>';
							unset($_SESSION['e_email']);
						}
					?>
				</div>
				<div class="row">
					<img src="img/tools.png">
					<div class="name">Technology </div>
					<input class="col-xl-9 right" type="text" value="<?php
						if (isset($_SESSION['fr_technique']) ) {
							echo $_SESSION['fr_technique'];
							unset($_SESSION['fr_technique']);
						}
					?>" name="technique" placeholder="Execution technologies"/><br/>
					<?php
						if (isset($_SESSION['e_technique'])) {
							echo '<div class="error">'.$_SESSION['e_technique'].'</div>';
							unset($_SESSION['e_technique']);
						}
					?>
				</div>
				<div class="row">
					<img src="img/location.png">
					<div class="name">Location </div>
					<input class="col-xl-9 right" type="text" value="<?php
						if (isset($_SESSION['fr_location']) ) {
							echo $_SESSION['fr_location'];
							unset($_SESSION['fr_location']);
						}
					?>" name="location" placeholder="Company / person location"/><br/>
					<?php
						if (isset($_SESSION['e_location'])) {
							echo '<div class="error">'.$_SESSION['e_location'].'</div>';
							unset($_SESSION['e_location']);
						}
					?>
				</div>
				<div class="row">
					<img src="img/phone.png">
					<div class="name">Phone number </div>
					<input class="col-xl-9 right" type="text" value="<?php
						if (isset($_SESSION['fr_phone'])) {
							echo $_SESSION['fr_phone'];
							unset($_SESSION['fr_phone']);
						}
					?>" name="phone" placeholder="Contact number"/><br/>
					<?php
						if (isset($_SESSION['e_phone'])) {
							echo '<div class="error">'.$_SESSION['e_phone'].'</div>';
							unset($_SESSION['e_phone']);
						}
					?>
				</div>
				<div class="row">
					<img src="img/money.png">
					<div class="name">Remuneration </div>
					<input class="col-xl-9 right" type="text" value="<?php
						if (isset($_SESSION['fr_price'])) {
							echo $_SESSION['fr_price'];
							unset($_SESSION['fr_price']);
						}
					?>" name="price" placeholder="Remuneration ($)"/><br/>
					<?php
						if (isset($_SESSION['e_price'])) {
							echo '<div class="error">'.$_SESSION['e_price'].'</div>';
							unset($_SESSION['e_price']);
						}
					?>
				</div>
				<div class="row">
					<img src="img/description.png">
					<div class="name">Description </div>
					<input class="col-xl-9 right" type="text" value="<?php
						if (isset($_SESSION['fr_description']) ) {
							echo $_SESSION['fr_description'];
							unset($_SESSION['fr_description']);
						}
					?>" name="description" placeholder="I am looking for someone who..." style="height:200px"/><br/><br/>
					<?php
						if (isset($_SESSION['e_description'])) {
							echo '<div class="error">'.$_SESSION['e_description'].'</div>';
							unset($_SESSION['e_description']);
						}
					?>
				</div>
				<div class="row">
					<img src="img/image.png">
					<div class="name">Image to upload </div>
					<input class="col-xl-9 right p-2" type="file" name="fileToUpload" id="fileToUpload" style="height:90px"></br><br/>
				</div>
				<div align="right">
					<input type="submit" value="Add announcement"/>
				</div>
			</form>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>