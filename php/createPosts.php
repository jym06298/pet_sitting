
<?php

// The beginning of the session
session_start();

// Making sure the user is logged in
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) 
{
    header("Location: login.php");
} else {
    #check that the user is a customer, not an employee
    if($_SESSION['isEmployee']) {
        #send to error page 
    }
}

require('database.php');

# Query all the pets that the customer has.
$pet_query = "SELECT * FROM pet_accounts WHERE customerID = :_customerID;";
$pet_query_statement = $db->prepare($pet_query);
$pet_query_statement->bindValue(":_customerID", $_SESSION['userID']);

try {
    $pet_query_statement->execute();
    $pets = $pet_query_statement->fetchAll();
} catch(Exception $e) {
    echo $e->getMessage();
} //try catch

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


<form action="#" method="post">
        
        <select id="animal" name="animal">
            <?php foreach($pets as $pet): ?>
                <option value= <?php echo $pet['pet_name'] ?> ><?php echo $pet['pet_name'] ?> </option>
            <?php endforeach ?>
   
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


