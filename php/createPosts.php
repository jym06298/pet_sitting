
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


<div class="grid">


 
 </div>
-->
<form action="#" method="post">
        <label for="name">Your pet's name: </label>
        <input type="text" id="name" name="name" placeholder="Bobby"><br>
        <label for="animal">Choose animal type: </label>
        <select id="animal" name="animal">
            <?php foreach($animals as $animal => $id): ?>
                <option value= <?php echo $animal ?> ><?php echo $animal ?> </option>
            <?php endforeach ?>
   
        </select><br>
        <label for="age">How old is your pet:</label>
        <select id="age" name="age">
            <option value="underOne">Less than a year old</option>
            <option value="young">1-3</option>
            <option value="mid">3-7</option>
            <option value="old">7+</option>
        </select><br>
        <label for="begin">Begin Date:</label>
        <input type="datetime-local" id="begin" name="begin">
        <label for="end">End Date:</label>
        <input type="datetime-local" id="end" name="end"><br>
        <label for="notes">Any additional notes: </label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"></textarea><br>
        <input class="submit" type="submit" name = "submit" value="Submit">
    </form> 


<div class="footer">&nbsp;</div>

</body>
</html>


