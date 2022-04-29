<?php

	// The beginning of the session
	session_start();

	// Making sure the user is logged in
	if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) 
	{
		header("Location: login.php");
	}

	require('database.php');
?>

<html>
	<head>
		<link rel="stylesheet" href="../css/style.css">
	</head>
<!-- example of how to inject php code into html code. $_SESSION['username'] was created in login.php-->
	<body>
		<center>
			<h1> WELCOME, <?php echo $_SESSION['username'] ?>!</h1>
		</center>
		<div class="topnav">
			<ul>
				<li><a class="active" href="homepage.php">Home</a></li>
				<li><a href="employeeSignup.php">Employee Sign-Up</a></li>
				<li><a href="customerSignUp.php">Customer Sign-Up</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div><br>

	<div class="row">
		<h2 id="heading">Pet-sitting at your convenience!</h2>
		<h3 id="description">Just post and certified pet sitters in your area will come at your service.</h3>
		<div id="homepage_content">
			<img id="homepage_pet_pic" src="https://cdn.pixabay.com/photo/2018/10/01/09/21/pets-3715733_1280.jpg" alt="Pets"/>
			<button id="start_now_button">START NOW</button>
		</div>
	</div>

	<div class="footer">&nbsp;</div>

	</body>
</html>


