
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


