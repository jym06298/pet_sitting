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
	</div>
    <form action="#" method = "post">
        <label for="fname">First name:</label>
        <input type="text" id="fname" name="fname" placeholder="John"><br>
        <label for="lname">Last name:</label>
        <input type="text" id="lname" name="lname" placeholder="Doe"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="email@gmail.com"><br>
        <label for="number">Phone number:</label>
        <input type="tel" id="number" name="number" placeholder="123-456-7890"><br>

        <!--<label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>-->
        <label for="password">Password:</label>
        <input type="text" id="password" name="password"><br>
        <label for="zipcode">Zipcode:</label>
        <input type="text" id="zipcode" name="zipcode"><br>
        <input class="submit" type="submit" name = "submit" value="Submit">
    </form> 

   
</body>
</html>