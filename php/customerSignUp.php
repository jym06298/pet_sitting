<?php
    session_start();
    require('database.php');

    if(isset($_POST['submit'])) {

        //Creating customer insert: customer_name, phone, email, zipcode, password	
        $insert_customer_query = "INSERT INTO customers(customer_name, phone, email, zipcode, password) VALUES (:_customer_name, :_phone, :_email, :_zipcode, :_passw);";
        
		//Used for customer first name, space, customer last name
		$space = " ";
        $insert_employee_statement = $db->prepare($insert_customer_query);

        $insert_employee_statement->bindValue(':_customer_name', $_POST['fname'] .$space .$_POST['lname']);
        $insert_employee_statement->bindValue(':_phone', $_POST['number']);
        $insert_employee_statement->bindValue(':_email', $_POST['email']);
        $insert_employee_statement->bindValue(':_zipcode', $_POST['zipcode']);
        $insert_employee_statement->bindValue(':_passw', $_POST['password']);

        try {
            $insert_employee_statement->execute();
            echo "successfully inserted.";
            header("Location: login.php");
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    } //if form has been submitted

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
    <title>Customer Signup</title>
</head>
<body>
    <h2>Customer Profile</h2>
	<div class="topnav">
        <a href='homepage.php'>Home</a>
        <a href='employeeSignup.html'>Employee Sign-Up</a>
        <a href='customerSignUp.html'>Customer Sign-Up</a>
        <a href='sign_out.php' style="float:right">Sign Out</a>
    </div>
    <form action="#" method = "post">
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname" placeholder="John"><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" placeholder="Doe"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="email@gmail.com"><br>
        <label for="number">Phone number:</label><br>
        <input type="tel" id="number" name="number" placeholder="123-456-7890"><br>

        <!--<label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>-->
        <label for="password">Password:</label><br>
        <input type="text" id="password" name="password"><br>
        <label for="zipcode">Zipcode:</label><br>
        <input type="text" id="zipcode" name="zipcode"><br><br>
        <input type="submit" name = "submit" value="Submit">
    </form> 

   
</body>
</html>