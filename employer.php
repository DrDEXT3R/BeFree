<?php
	
	session_start();
	
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
					if( $connection->query("INSERT INTO jobs VALUES(NULL,'$price','$phone','$email','$technique','$employer','$description','$location',now())") ) {
						$_SESSION['succRegistration'] = true;
						header('Location: added.php');
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
		<title>Freelance jobs</title>
		<meta name="description" content="Job board for freelancers and employers. Find for FREE commissions and offers of remote work.">
		<meta name="keywords" content="freelancer, job, work, offers, commissions, remote">
		<meta name="author" content="Tomasz Strzoda">		
		<meta http-equiv="X-Ua-Compatible" content="IE-edge,chrome=1">
		<link rel="stylesheet" href="css/main.css">	
		<script src="code.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="logo">
			beFree
			</div>
			<div class="menu"></div>
			

			
			<form method="post">
				Employer: <input type="text" value="<?php
					if (isset($_SESSION['fr_employer'])) {
						echo $_SESSION['fr_employer'];
						unset($_SESSION['fr_employer']);
					}
				?>" name="employer"/><br/>
				<?php
					if (isset($_SESSION['e_employer'])) {
						echo '<div class="error">'.$_SESSION['e_employer'].'</div>';
						unset($_SESSION['e_employer']);
					}
				?>
				E-mail: <input type="text" value="<?php
					if (isset($_SESSION['fr_email'])) {
						echo $_SESSION['fr_email'];
						unset($_SESSION['fr_email']);
					}
				?>" name="email"/><br/>
				<?php
					if (isset($_SESSION['e_email'])) {
						echo '<div class="error">'.$_SESSION['e_email'].'</div>';
						unset($_SESSION['e_email']);
					}
				?>
				Technique: <input type="text" value="<?php
					if (isset($_SESSION['fr_technique']) ) {
						echo $_SESSION['fr_technique'];
						unset($_SESSION['fr_technique']);
					}
				?>" name="technique"/><br/>
				<?php
					if (isset($_SESSION['e_technique'])) {
						echo '<div class="error">'.$_SESSION['e_technique'].'</div>';
						unset($_SESSION['e_technique']);
					}
				?>
				Description: <input type="text" value="<?php
					if (isset($_SESSION['fr_description']) ) {
						echo $_SESSION['fr_description'];
						unset($_SESSION['fr_description']);
					}
				?>" name="description"/><br/>
				<?php
					if (isset($_SESSION['e_description'])) {
						echo '<div class="error">'.$_SESSION['e_description'].'</div>';
						unset($_SESSION['e_description']);
					}
				?>
				Location: <input type="text" value="<?php
					if (isset($_SESSION['fr_location']) ) {
						echo $_SESSION['fr_location'];
						unset($_SESSION['fr_location']);
					}
				?>" name="location"/><br/>
				<?php
					if (isset($_SESSION['e_location'])) {
						echo '<div class="error">'.$_SESSION['e_location'].'</div>';
						unset($_SESSION['e_location']);
					}
				?>
				Phone number: <input type="text" value="<?php
					if (isset($_SESSION['fr_phone'])) {
						echo $_SESSION['fr_phone'];
						unset($_SESSION['fr_phone']);
					}
				?>" name="phone"/><br/>
				<?php
					if (isset($_SESSION['e_phone'])) {
						echo '<div class="error">'.$_SESSION['e_phone'].'</div>';
						unset($_SESSION['e_phone']);
					}
				?>
				Price: <input type="text" value="<?php
					if (isset($_SESSION['fr_price'])) {
						echo $_SESSION['fr_price'];
						unset($_SESSION['fr_price']);
					}
				?>" name="price"/>$<br/>
				<?php
					if (isset($_SESSION['e_price'])) {
						echo '<div class="error">'.$_SESSION['e_price'].'</div>';
						unset($_SESSION['e_price']);
					}
				?>
				<input type="submit" value="Add announcement"/></br>
			</form>
			
			
			
			
		</div>
	</body>
</html>