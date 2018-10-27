<?php

	session_start();

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
								
								
								echo '<div>
									
										 Renumeration: '.$row['price'].' $</br>
										 Phone number: '.$row['phone'].'</br>
										 E-mail: '.$row['email'].'</br>
										 Technique: '.$row['technique'].'</br>
										 Employer: '.$row['employer'].'</br>
										 Description: '.$row['description'].'</br>
										 Location: '.$row['location'].'</br>
										 Date: '.$formattedDate.'</br></br>
								
								</div>';
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
					echo '<br/>Info: '.$e; //comment this before last release - info about exception for developer
				}
			
			?>
		</div>
	</body>
</html>