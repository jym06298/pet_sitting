<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel = "stylesheet" href="../css/style.css">
		<title>Success!</title>
	</head>
	<body>
		<div class="together">
			<a href="homepage.php"><img class="logoImg" src="pawprint.png"></a>
			<h1>DBMS Petsitting Co.</h1>
		</div>
			
			<!-- TOP NAV BAR -->
			<div class="topnav">
			<ul>
				<li><a href="homepage.php">Home</a></li>
			
				<!-- EMPLOYEE PROFILE OR CUSTOMER PROFILE (Dont show if not logged in)-->
				<?php if (isset ($_SESSION['loggedin'])): ?>
				<li><a href= <?php
					if ($_SESSION['isEmployee']) {
						echo "employeeProfile.php";
					} else {
						echo "customerProfile.php";
					} //if else
				?>>Profile</a></li>
				<?php endif ?>
				<li><a href="employeeSignup.php">Employee Sign-Up</a></li>
				<li><a href="customerSignUp.php">Customer Sign-Up</a></li>
				<?php if(isset($_SESSION['isEmployee']) && isset($_SESSION['loggedin'])):?>
				<li><a href="animalSignup.php">Create Pet Account</a></li>
				<li><a href="createPosts.php">Create Post</a></li>
				<?php endif ?>
				<li><a href="search.php">Posts</a></li>
				<li><a href="login.php">Login</a> </li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div><br>
	</body>
</html>