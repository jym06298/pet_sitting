<?php
    session_start();
    require("database.php");

    //Checking whether submit has been pressed
    if(isset($_POST['submit'])){
        
		//If it has it will query matching email and password.
        //It will do a query on both the customers and employee table and the if else block on line 37 will set the sessions necessary
        
        //Create query string that you want to run
        // Notice that instead of strict values (ex: employee.email="example@gmail.com"and password="1234") for our conditions,
        // we instead replace it with any string starting with the character ':',
        // Then we just use the bindValue() command to bind the values users have inputted in the form(since we used method = post it will be in $_POST[name]).
        $employee_login_query = "SELECT * FROM employee WHERE email=:_email AND password=:_passw;";
        $customer_login_query = "SELECT * FROM customers WHERE email=:_email AND password=:_passw;";

        //You must prepare the query using the prepare command
        $employee_login_statement = $db->prepare($employee_login_query);
        $customer_login_statement = $db->prepare($customer_login_query);
    
        //Binding values as mentioned in comment line: 14
        $employee_login_statement->bindValue(':_email', $_POST['email']);
        $employee_login_statement->bindValue(':_passw', $_POST['password']);
        $customer_login_statement->bindValue(':_email', $_POST['email']);
        $customer_login_statement->bindValue(':_passw', $_POST['password']);

        //This line executes the query
        $employee_login_statement->execute();
        $customer_login_statement->execute();

        //Fetching results so it will be easily assessible using column names
        $employee_result = $employee_login_statement->fetch();
        $customer_result = $customer_login_statement->fetch();

        //Checking if query returned a result.
        if($employee_login_statement->rowCount() == 1 ) {
           
            //Creating a 'loggedin' session. (Sessions are like cookies(saves information) but are on server side so they are more secure)
            $_SESSION['loggedin'] = true;
			
            //Creating a isEmployee session. We will use this session value to see whether the user is an employee or customer
            $_SESSION['isEmployee'] = true;

            //The fetch result, $employee_result makes it easier to access the values. you can use $employee_result['employee_name'] instead of
            //$employee_result[0][1]
            $_SESSION['username'] = $employee_result['employee_name'];
            $_SESSION['userID'] = $employee_result['employeeID'];
            //Redirecting to homepage
#            header("Location: homepage.php");
            echo $employee_result['employeeID'];
            
			//Redirecting to homepage
            header("Location: homepage.php");
        } else if ($customer_login_statement->rowCount() == 1 ) {

            //Creating a 'loggedin' session.
            $_SESSION['loggedin'] = true;
			
            //Creating a isEmployee session
            $_SESSION['isEmployee'] = false;

            $_SESSION['username'] = $customer_result['customer_name'];
            $_SESSION['userID'] = $customer_result['customerID'];
			
            //Redirecting to homepage
            header("Location: homepage.php");
        } else {
            //For now I am just echoing (printing out) that something went wrong. We might want to create and redirect to a login_error.php page for styling and all that
            echo "Something went wrong with your login. Please try again";
        }

    }  else {
        echo "Please Log In";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
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

    <div class="center">
        <form method = "post" action="#">
            <label for="email">Email:</label> <br /><input 
        id="email" name="email" type="text" /><br /><br /><label 
        for="password">Password:</label><br /><input id="password" name="password" 
        type="text" /><br /><br /><input type="submit" name = "submit" value="Submit" />
        </form> 

        <div>
            <a href='customerSignup.php'>customer signup</a>
            <a href="employeeSignup.php">employee signup</a>
        </div>
    </div>

</body>
	
</html>
