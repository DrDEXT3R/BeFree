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
		<script src="code.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="logo">
				beFree
				<button onclick="document.getElementById('modal-wrapper').style.display='block'" style="width:100px;">Log in</button>
				<div id="modal-wrapper" class="modal">
				  <form class="modal-content animate" action="logIn.php" method="post">  
					<div class="popUpContainer">
					  <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
						<img src="img/avatar.jpg" alt="Avatar" class="avatar">
					  <input type="text" placeholder="Enter login" name="login">
					  <input type="password" placeholder="Enter password" name="password">        
					  <button class="popUpLogIn" type="submit">Log in</button>
					</div>
				  </form>
				</div>
			</div>
			<div class="menu"></div>			
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
		</div>
	</body>
</html>