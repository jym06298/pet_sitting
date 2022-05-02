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

    <!--
    <div class="row">
    <div class="leftcolumn" style="font-size: large; line-height: 2.0; text-align: center;">Pet-sitting at your convenience! Just post and certified pet sitters in your area will come at your service.</div>
    <div class="rightcolumn">

    </div>

    -->
    <div class="grid">

    <!-- Displays each card from the products databade -->
    <?php foreach ($products as $product) : ?>

    <div class="card">
        <div class="title"><p><?php echo $product['productName']; ?></p></div>
        <img src=<?php echo $product['imageURL'];?> alt=<?php echo $product['productName']; ?>>
        <p class="price">$<?php echo $product['price'];?></p>
        <form action="add_to_cart.php" method="post">
        <input type="hidden" name="productID"value="<?php echo $product['productID']; ?>">
        <input type="hidden" name="uri"value="<?php echo $_SERVER['QUERY_STRING']; ?>">
        <input type="submit" value="Add to Cart" name="submit"></form>
    </div>

    <?php endforeach; ?>
    </div>



    <div class="footer">&nbsp;</div>

</body>
</html>


