<?php

	// The beginning of the session
	session_start();

	// Making sure the user is logged in
  /*
	if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) 
	{
		header("Location: login.php");
	}
*/
	require('database.php');
?>

<html>
	<head>
		<link rel="stylesheet" href="../css/style.css">
	</head>
<!-- example of how to inject php code into html code. $_SESSION['username'] was created in login.php-->

	<body>
	<div >
		
  </div>
  	<div class="together">
	  	<a href="homepage.php"><img class="logoImg" src="../pawprint.png"></a>
        <h1>DBMS Petsitting Co.</h1>
    </div>

    <h1> WELCOME, <?php if($_SESSION['loggedin']){echo $_SESSION['username'];} else {echo "Guest";} ?>!</h1>
	<div class="topnav">
    <ul>
		<li><a href="homepage.php">Home</a></li>
    <!--SHOULD ADD LOGIC WHERE IT WILL GO TO EMPLOYEE PROFILE OR CUSTOMER PROFILE -->
    <li><a href= <?php
      if ($_SESSION['isEmployee']) {
        echo "employeeProfile.php";
      } else {
        echo "customerProfile.php";
      } //if else
      ?> >Profile</a> </li>
		<li><a href="employeeSignup.php">Employee Sign-Up</a></li>
		<li><a href="customerSignUp.php">Customer Sign-Up</a></li>
    <li><a href="animalSignup.php">Create Pet Account</a></li>
    <li><a href="createPosts.php">Create Post</a></li>
    <li><a href="posts.php">Posts</a></li>
		<li><a href="login.php">Login</a> </li>
		<li><a href="logout.php">Logout</a></li>
    </ul>
	</div><br>

	<div class = "center">
	    <img src="https://cdn.pixabay.com/photo/2018/10/01/09/21/pets-3715733_1280.jpg">
        <h2> WELCOME, <?php echo $_SESSION['username'] ?>!</h2>
        <p>
            DBMS Petsitting Co. is a imaginary company that are created during the Spring semester of 2022. 
            It was created by Miriam Talamantes, Jun Mun, Hyemi Byun, and Trisha Nayak. The idea of this company is 
            to have a service where pet owners and pet sitters are able to connect. Any pet owners with an account registered 
            can create an order request and any available pet sitters are able to select orders they are able to fulfill. 
            Whether you are a pet owner or a pet sitter, click the button below to get started by creating an account today! 
        </p>
        <button id="start_now_button">START NOW</button>
	</div>
</body>
</html>


