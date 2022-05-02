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

  <div >
		<h1> WELCOME, <?php echo $_SESSION['username'] ?>!</h1>
  </div>
  	<div class="together">
	  	<a href="homepage.php"><img class="logoImg" src="../pawprint.png"></a>
        <h1>DBMS Petsitting Co.</h1>
    </div>
	<div class="topnav">
		<a href="homepage.php">Home</a>
    <a href="employeeProfile.php">Profile</a>
		<a href="employeeSignup.php">Employee Sign-Up</a>
		<a href="customerSignUp.php">Customer Sign-Up</a>
		<a href="login.php">Login</a> 
		<a href="logout.php">Logout</a>
	</div><br>

<!--
<div class="row">
<div class="leftcolumn" style="font-size: large; line-height: 2.0; text-align: center;">Pet-sitting at your convenience! Just post and certified pet sitters in your area will come at your service.</div>
<div class="rightcolumn">
 
</div>
-->
<div class = "center">
  <img style="max-width: 50%; width: auto; height: auto;" src="https://cdn.pixabay.com/photo/2018/10/01/09/21/pets-3715733_1280.jpg" alt="Pets" />
</div>

<div class="center">
<button style="font-size:32px;background-color:#FFEB3B; color:rgba(0, 0, 0, 0.87);padding:10px;border:none;  box-shadow: 0 2px 4px rgba(0, 0, 0, .6);">START NOW</button>
</div>

<div class="footer">&nbsp;</div>

</body>
</html>


