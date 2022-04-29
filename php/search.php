<?php
    session_start();
    require('database.php');

    #This file(queryAnimals.php) has code that queries all animals and puts it into an array
    # where :
    #           $animals['animal_name'] = animalID;
    #
    # for example:
    #
    #           $animals['cat'] =  2;
    #
    require('queryAnimals.php');

    $animal_names_query = "SELECT E.employee_name, A.animal_name
    FROM employee_willing_animals EW 
    INNER JOIN employee E ON E.employeeID = EW.employeeID
    INNER JOIN animals A ON A.animalID = EW.animalID
    WHERE E.employeeID = :_employeeID AND animal_name = :_animal_name;";

    $test_query = "SELECT employee_name FROM employee;";
    //db->prepare($animal_names_query);
    
    //db->execute();
    try {
        $test_stmt = $db->query($test_query);
        $employees = $test_stmt->fetch();
    
        echo $employees[0];

    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        #results{
            width: 200px;
            height: auto;
            border-style: solid;
        }

        .img{
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px;
        }

        .paragraph{
            font-size: 1.6rem;
        }
    </style>
    <link rel= "stylesheet" href="../css/style.css">
    <title>Form</title>
</head>
<body>
    <h2>Customer Request Form</h2>

    <div class="topnav">
		<a href="homepage.php">Home</a>
        <a href="employeeProfile.php">Profile</a>
		<a href="employeeSignup.php">Employee Sign-Up</a>
		<a href="customerSignUp.php">Customer Sign-Up</a>
		<a href="login.php">Login</a> 
		<a href="logout.php">Logout</a>
	</div><br>

    <!--This form should lead to the cards page-->
    <form >
        <label for="search">What animal would you like to watched?</label><br>
        <select id="search" name="search">

        <?php foreach($animals as $animal => $animalID): ?>
            <option value=<?php echo $animal ?> ><?php echo $animal ?></option>
        <?php endforeach ?>

        </select><br><br>

        <input type="submit" value="Submit" onClick="clickedSubmit()">

    </form><br><br>

    <div id="results"></div>

    <script defer src="orders.js">
    </script>
</body>
</html>