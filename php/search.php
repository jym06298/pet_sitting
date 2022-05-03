<?php
    session_start();
    

    #This file(queryAnimals.php) has code that queries all animals and puts it into an array
    # where :
    #           $animals['animal_name'] = animalID;
    #
    # for example:
    #
    #           $animals['cat'] =  2;
    #
    require('queryAnimals.php');

    #querying all orders(posts)
    $orders_query = "SELECT * FROM orders WHERE employeeID IS NULL;";
    $orders_statement = $db->prepare($orders_query);
    
    try {
        $orders_statement->execute();
        $posts = $orders_statement->fetchAll();
    } catch(Exception $e) {
        echo $e->getMessage();
    } //try catch
    
   
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/style.css">
		<title>Customer Requests</title>

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

        <!--This form should lead to the cards page-->
        <form >
            <label for="search">What animal would you like to watched?</label><br>
            <select id="search" name="search">

            <?php foreach($animals as $animal => $animalID): ?>
                <option value=<?php echo $animal ?> ><?php echo $animal ?></option>
            <?php endforeach ?>

            </select><br><br>
            <label for="search">If you would like to filter by employee rating, please select a rating.</label><br>
            <select id="search" name="search">

            <?php foreach($employee as $employeeRating => $rating): ?>
                <option value=<?php echo $employeeRating ?> ><?php echo $employeeRating ?></option>
            <?php endforeach ?>

            </select><br><br>

            <input type="submit" value="Submit" onClick="clickedSubmit()">

        </form><br><br>

        <?php foreach($posts as $post): ?>


        <div id="results">
            <div class="card">
                <?php 
                #Calling procedure to get pet name
                $pet_query = "CALL get_pet_name(:_petID)";
                $pet_statement = $db->prepare($pet_query);
                $pet_statement->bindValue(":_petID", $post['petID']);

                #Calling procedure to get animal name
                $animal_type_call = "CALL get_animal_name(:_animalID)";
                $animal_type_statement = $db->prepare($animal_type_call);
                try {
                    $pet_statement->execute();
                    $pet_info = $pet_statement->fetch();
                    $pet_statement->closeCursor();
                    
                    $animal_type_statement->bindValue(":_animalID", $pet_info['animalID']);
                    $animal_type_statement->execute();
                    $animal_type = $animal_type_statement->fetch();
                    $animal_type_statement->closeCursor();
                } catch(Exception $e) {
                    echo $e->getMessage();
                } //try catch

               
                $animal_type_statement->execute()

                ?>
                <h2><?php echo $pet_info['pet_name']; ?></h2>
                <p>Animal Type: <?php echo $animal_type['animal_name'] ?></p>
                <p>Description:<br> <?php echo $post['description'] ?></p>
                <p>Begin Date: <?php echo $post['begin_time'] ?></p>
                <p>End Date: <?php echo $post['end_time'] ?></p>
                
            </div>
        </div>

        <?php endforeach ?>
        <script defer src="orders.js">
        </script>
    </body>
	
</html>