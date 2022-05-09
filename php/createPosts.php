
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

    if (isset($_POST['submit'])) {
        #customerID	employeeID	begin_time	end_time	cost	petID	description	

        $insert_order_query = "INSERT INTO orders (customerID, employeeID, begin_time, end_time, cost, petID, description, completed) VALUES(:_customerID, NULL, :_begin_time, :_end_time, NULL, :_petID, :_description, false);";
        $insert_order_statement = $db->prepare($insert_order_query);
        $insert_order_statement->bindValue(":_customerID", $_SESSION['userID']);
#        $insert_order_statement->bindValue(":_employeeID", "NULL");
        $insert_order_statement->bindValue(":_begin_time", $_POST['begin']);
        $insert_order_statement->bindValue(":_end_time", $_POST['end']);
#        $insert_order_statement->bindValue(":_cost", "NULL");

        #get petID by matching petname to name in $pets array
        $pet_found = false;
        $pet_ID = -1;
        $i = 0;
        while(!$pet_found) {
            if ($pets[$i]['pet_name'] == $_POST['pet']) {
                $pet_ID = $pets[$i]['petID'];
                $pet_found = true;
            }
            $i = $i +1;
        } //while
        $insert_order_statement->bindValue(":_petID", $pet_ID);
        $insert_order_statement->bindValue(":_description", $_POST['notes']);

        try {
            $insert_order_statement->execute();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
    }
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
			<ul>
				<li><a href="homepage.php">Home</a></li>
			
				<!-- EMPLOYEE PROFILE OR CUSTOMER PROFILE (Dont show if not logged in)-->
				<?php if (isset ($_SESSION['loggedin'])): ?>
				<li><a href= <?php
					if ($_SESSION['isEmployee']) {
						echo "employeeProfile.php";
					} else {
						echo "customerProfile.php";
					} //if else
				?>>Profile</a></li>
				<?php endif ?>
				<li><a href="employeeSignup.php">Employee Sign-Up</a></li>
				<li><a href="customerSignUp.php">Customer Sign-Up</a></li>
				<?php if(isset($_SESSION['isEmployee']) && isset($_SESSION['loggedin'])):?>
				<li><a href="animalSignup.php">Create Pet Account</a></li>
				<li><a href="createPosts.php">Create Post</a></li>
				<?php endif ?>
				<li><a href="search.php">Posts</a></li>
				<li><a href="login.php">Login</a> </li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div><br>
		<form action="#" method="post">
			<div>Select a pet:</div>
			<select id="pet" name="pet">
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


