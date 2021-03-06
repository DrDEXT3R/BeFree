<?php

	session_start();
	
	if ((!isset($_SESSION['loggedIn']))) {
		$_SESSION['alertError'] = true;
		header('Location: index.php');
		exit();
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Overview -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>BeFree - Freelancer</title>
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
		<link rel="stylesheet" href="css/freelancer.css">
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136379266-2"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
		
			gtag('config', 'UA-136379266-2');
		</script>	
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
						<li class="nav-item active"><a class="nav-link" href="how-it-works.php">&ensp; How it works &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="about-me.php">&ensp; About me &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="contact.php">&ensp; Contact &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="my-account.php">&ensp; My account &ensp;</a></li>
						<li class="nav-item active"><a class="nav-link" href="log-out.php">&ensp; Log Out &ensp;</a></li>
					</ul>
				</div>
			</nav>	
		</header>
			<div class="container containerFreelancer col-11 col-sm-9">
				<?php
				
					require_once "connect.php";
					mysqli_report(MYSQLI_REPORT_STRICT);
					
					try {
						$connection	= new mysqli($host, $db_user, $db_password, $db_name);
						if ($connection->connect_errno != 0) {
							throw new Exception(mysqli_connect_errno());
						}
						else {				
							if ($result = $connection->query(sprintf("SELECT * FROM jobs"))) {						
								while ($row = $result->fetch_assoc()) {
									
									//format date
									$date = $row['date'];
									$day = date("j",strtotime($date));
									$month = date("M",strtotime($date));
									$year = date("Y",strtotime($date));
									$hour = date("H",strtotime($date));
									$min = date("i",strtotime($date));
									$formattedDate = $day.' '.$month.' '.$year.' &nbsp;&nbsp;'.$hour.':'.$min;
									
									//check if any image is added to offer
									if($row['image']) 
										$imgName = $row['image'];
									else
										$imgName = "no_image.png";
									
									
									echo '<div class="offer">
											<div class="block col-12 col-md-3">
												<div class="image"> 
													<img src="uploads/'.$imgName.'" alt="img">
												</div>		
												<div class="basicInfo"> 
													<div class="text-center">
														<img src="img/money.png"> Remuneration: <font>'.$row['price'].'$</font></br> 
													</div>
													<div class="text-center">
														<img src="img/phone.png"> Phone: <font>'.$row['phone'].'</font></br>
													</div>
													<div class="text-center">
														<img src="img/email.png"> E-mail: <font>'.$row['email'].'</font></br>
													</div>
												</div>
											</div>										
											<div class="date col-12 col-md-9 text-center text-center text-md-right">
												'.$formattedDate.'
											</div>										
											<div class="employer col-12 col-md-9"> 
												>&nbsp;'.$row['employer'].'&nbsp;< </br>
											</div> 
											<div class="technique col-12 col-md-4">
												<img src="img/tools.png"> Technology: <font>'.$row['technique'].'</font></br> 
											</div>
											<div class="location col-12 col-md-4"> 
												<img src="img/location.png"> Location: <font>'.$row['location'].'</font></br>
											</div>
											<div class="description col-12 col-md-9"> 
												<img src="img/description.png"> <a>Description:</a><p>'.$row['description'].'</p>
											</div>
										</div>
										<div class="divider col-12"></div>';
								}
							}
							else {
								throw new Exception($connection->error);
							}
							
							$connection->close();
						}
					}
					catch (Exception $e) {
						echo '<span style="color:red;">Server Not Found! Please try again later.</span>';
						//echo '<br/>Info: '.$e; //comment this before last release - info about exception for developer
					}
				
				?>
			</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>
										