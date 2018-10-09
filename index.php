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
			
				Freenalce jobs _____________________log_in__sign up
				<!-- <button type="button">Click Me!</button> -->
				
				<div class=logowanie>Log in</div>
				
				<a href="javascript:void(0)" class="button button1" onclick="showLoginPopup()">Logowanie</a>
				
			</div>
			
			
			
			
			<?php
				$forename = "Joanna";
				echo "$forename, Hello World";
			?>
			
			<form>
				Login <br/><input type="text" name="login"/><br/><br/>
				Password <br/><input type="password" name="password"/><br/><br/>
				<input type="submit" value="Log in"/>
			</form>
	
	
			
			
			
			<a href="employer.html" class="button button1">
				<div class="kurs">
					<div class="test"></div>
					<h1>przycisk1</h1>
					<p>opis1</p>
					Szukasz zleceń
				</div>
			</a>
		
			<a href="freelancer.html" class="button button1">
				<div class="kurs">
					<h1>przycisk2</h1>
					<p>opis2</p>
					Szukasz zleceń
				</div>	
			</a>
			
			
			<div class="menu"></div>
		</div>
	</body>
</html>