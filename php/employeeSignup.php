<?php
    session_start();
    require('database.php');
    #getting list of all animals
    require('queryAnimals.php');
	
    //Getting list of all animals
    $animals_query = "SELECT animal_name, animalID from animals;";

    $animals_statement = $db->prepare($animals_query);
    $animals_statement->execute();
    $animals = array();
    
  
    while($row = $animals_statement->fetch()) {
        $animals[$row['animal_name']] = $row['animalID'];
    }

    if (isset($_POST['submit'])) {

        //Inserting into employee table
        $insert_employee_query = "INSERT INTO employee(employee_name, rating, charging_rate, phone, email, description, zipcode, password) VALUES (:_employee_name, NULL, NULL, :_phone, :_email, :_description, :_zipcode, :_passw);";

        $space = " ";        
        $full_name = $_POST['fname'] .$space .$_POST['lname'];

        $insert_employee_statement = $db->prepare($insert_employee_query);

        #binding values to prepared query statement
        $insert_employee_statement->bindValue(':_employee_name', $full_name);
        $insert_employee_statement->bindValue(':_phone', $_POST['number']);
        $insert_employee_statement->bindValue(':_email', $_POST['email']);
        $insert_employee_statement->bindValue(':_description', $_POST['notes']);
        $insert_employee_statement->bindValue(':_zipcode', $_POST['zipcode']);
        $insert_employee_statement->bindValue(':_passw', $_POST['password']);

        #executing insertion into employee table
        try {
            $insert_employee_statement->execute();
            echo "successfully inserted.";

        } catch(Exception $e) {
            echo $e->getMessage();
        }

        //Inserting into employee_willing_animals table
        $employee_query = "SELECT employeeID from employee WHERE employee_name = :_emp_name AND email = :_email;";
        $employee_statement = $db->prepare($employee_query);
        $employee_statement->bindValue(":_emp_name", $full_name);
        $employee_statement->bindValue(":_email", $_POST['email']);

        try {
            $employee_statement->execute();
        } catch(Exception $e) {
            echo $e->getMessage();
            header("sql_error.php");
        }
		
        $employee = $employee_statement->fetch();
        
		//If successfully inserted into employee table and query works fine, then add to employee willing animals table
        if($employee_statement->rowCount() == 1) {
            foreach($animals as $animal => $id) {

                //If the checkbox has been checked
                if ($_POST[$animal]) {
                    #insert into employee_willing_animals
                    $insert_empWilling_query = "INSERT INTO employee_willing_animals VALUES (:_empID, :_animalID);";
                    $insert_empWilling_statement = $db->prepare($insert_empWilling_query);
                    $insert_empWilling_statement->bindValue(":_empID", $employee['employeeID']);
                    $insert_empWilling_statement->bindValue(":_animalID", $id);
                    $insert_empWilling_statement->execute();
                    $insert_empWilling_statement->closeCursor();
                }
           } //foreach



        } else {
            echo "Something went wrong querying your information";
            #go to error page?
        } //if else

        header("Location: successSignup.php");
    } //if
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link ref="stylesheet" href="../css/style.css">
		<title>Form</title>
		<link rel="stylesheet" href="../css/style.css">
		<title>Employee Sign-Up</title>
	</head>
	<body>
		<div class="together">
			<a href="homepage.php"><img id="logoImg" src="pawprint.png"></a>
			<h1>DBMS Petsitting Co.</h1>
		</div>
		
		<!-- TOP NAV BAR -->
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
		<form action="#" method = "post">
			<label for="fname">First name:</label>
			<input type="text" id="fname" name="fname" placeholder="John"><br>
			<label for="lname">Last name:</label>
			<input type="text" id="lname" name="lname" placeholder="Doe"><br>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" placeholder="email@gmail.com"><br>
			<label for="number">Phone number:</label>
			<input type="tel" id="number" name="number" placeholder="123-456-7890"><br>
			<label for="password">Password:</label>
			<input type="text" id="password" name="password"><br>
			<label for="zipcode">Zipcode:</label>
			<input type="text" id="zipcode" name="zipcode"><br>
			<label for="animal">Which animals are you willing to take care of:</label><br>

			<?php foreach($animals as $animal => $id): ?>
				<input type = "checkbox" name = <?php echo $animal; ?> value = <?php echo $animal; ?>>
				<label for=<?php echo $animal; ?>> <?php echo $animal; ?> </label><br>
			   
			<?php endforeach; ?>

			<label for="notes">Description:</label><br>
			<textarea id="notes" name="notes" rows="4" cols="50"></textarea><br>
			<input class="submit" type="submit" name="submit" value="Submit">
		</form> 
	</body>
</html>