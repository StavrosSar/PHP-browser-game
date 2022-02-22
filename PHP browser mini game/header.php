<?php
	session_start();
?>
<html>

	<head>
		<meta charset="utf-8">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title></title>
		<link rel="stylesheet" href="stylecss.css">
	</head>

	<body>
		<div class="header">
			<header>
				<nav>
					<div class="topnav">
						<a href="index.php">Home</a>
						<?php 
							if(isset($_SESSION['userId'])){
								echo '<form action="includes/logout.inc.php" method="post">
							<button type="submit" name="logout-submit">Logout</button>
							</form>';
							}
							else{
								echo '<form action="includes/login.inc.php" method="post">
							
							
							
							<input type="text" name="uid" placeholder="Username">
							<button type="submit" name="login-submit">Login</button>
						
							
							<a href="signup.php">Signup</a>
							
						</form>';
							}
						?>
						

					</div>
				</nav>	
			</header>
		</div>


	