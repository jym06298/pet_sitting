<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<img src="profilepic.png" alt="Profile Pic" width="100", height="100", style="max-width: 50%">
    <h1><a href="homepage.php">Pet-Sitter</a></h1>
    <div class="topnav">
        <a href='homepage.php'>Home</a>
        <a href='employeeSignup.html'>Employee Sign-Up</a>
        <a href='customerSignUp.html'>Customer Sign-Up</a>
        <a href='sign_out.php' style="float:right">Sign Out</a>
    </div>
    <div class="content">
	
    <!-- PHP to list the animals employee is willing to take care of HERE -->
		<div>
			<h2>Animals you are willing to take care of:</h2>
			<ul>
				<li>dog</li>
				<li>cat</li>
			</ul>
			<h2>Order history:</h2>
			<ul>
				<li>list specific animal they took care of</li>
				<li>list specific animal they took care of</li>
			</ul>
		</div>
		<div class="row">
			<h3 style="text-align:center">Pet-sitting at your convenience! Just post and certified pet sitters in your area will come at your service.</h3>
			<img src="https://cdn.pixabay.com/photo/2018/10/01/09/21/pets-3715733_1280.jpg" alt="Pets" style="max-width: 100%;width:auto;height:auto;">
		</div>
    </div>
    <div class="footer">
     
    </div>
</body>
</html>