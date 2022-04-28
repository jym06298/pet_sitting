<?php

    session_start();
    require('database.php');
    #getting list of all animals
    $animals_query = "SELECT animal_name from animals;";

    $animals_statement = $db->prepare($animals_query);
    $animals_statement->execute();
    $animals_array = $animals_statement->fetch();

    echo $animals_statement->rowCount();
    if (isset($_POST['submit'])) {

        #employeeID	employee_name	rating	charging_rate	phone	email	description	zipcode	password	

        $insert_employee_query = "INSERT INTO employee(employee_name, rating, charging_rate, phone, email, description, zipcode, password) VALUES (:_employee_name, NULL, NULL, :_phone, :_email, :_description, :_zipcode, :_passw) ";

        $space = " ";
        
        echo $test;
        $insert_employee_statement = $db->prepare($insert_employee_query);

        $insert_employee_statement->bindValue(':_employee_name', $_POST['fname'] .$space .$_POST['lname']);
        $insert_employee_statement->bindValue(':_phone', $_POST['number']);
        $insert_employee_statement->bindValue(':_email', $_POST['email']);
        $insert_employee_statement->bindValue(':_description', $_POST['notes']);
        $insert_employee_statement->bindValue(':_zipcode', $_POST['zipcode']);
        $insert_employee_statement->bindValue(':_passw', $_POST['password']);

        try {
            $insert_employee_statement->execute();
            echo "successfully inserted.";
            header("Location: login.php");
        } catch(Exception $e) {
            echo $e->getMessage();
        }

        #Must insert into employee_willing_animal table too
        #First query employeeID that matches the name of employee that just signed up
    } //if
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <h2>Sign Up Employee Form</h2>
    <form action="#" method = "post">
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname" placeholder="John"><br><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" placeholder="Doe"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="email@gmail.com"><br><br>
        <label for="number">Phone number:</label><br>
        <input type="tel" id="number" name="number" placeholder="123-456-7890"><br><br>
        <label for="password">Password:</label><br>
        <input type="text" id="password" name="password"><br><br>
        <label for="zipcode">Zipcode:</label><br>
        <input type="text" id="zipcode" name="zipcode"><br><br>

        <label for="animal">Which animals are you willing to take care of:</label><br>
        <input type="checkbox" id="dog" name="dog" value="dog">
        <label for="dog">Dog</label><br>
        <input type="checkbox" id="cat" name="cat" value="cat">
        <label for="cat">Cat</label><br>
        <input type="checkbox" id="fish" name="fish" value="fish">
        <label for="fish">Fish</label><br>
        <input type="checkbox" id="reptile" name="reptile" value="reptile">
        <label for="reptile">Reptile</label><br>
        <input type="checkbox" id="rodent" name="rodent" value="rodent">
        <label for="rodent">Rodent</label><br><br>

        <label for="notes">Description:</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50">
        </textarea><br><br>
        <input type="submit" name = "submit" value="Submit">
    </form> 
</body>
</html>