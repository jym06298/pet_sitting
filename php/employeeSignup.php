<?php

    session_start();
    require('database.php');
    #getting list of all animals
    $animals_query = "SELECT animal_name, animalID from animals;";

    $animals_statement = $db->prepare($animals_query);
    $animals_statement->execute();
    $animals = array();
    
  
    while( $row = $animals_statement->fetch() ) {
        $animals[$row['animal_name']] = $row['animalID'];
    }

    if (isset($_POST['submit'])) {

        #inserting into employee table
        $insert_employee_query = "INSERT INTO employee(employee_name, rating, charging_rate, phone, email, description, zipcode, password) VALUES (:_employee_name, NULL, NULL, :_phone, :_email, :_description, :_zipcode, :_passw) ";

        $space = " ";
        
        $full_name = $_POST['fname'] .$space .$_POST['lname'];

        $insert_employee_statement = $db->prepare($insert_employee_query);

        $insert_employee_statement->bindValue(':_employee_name', $full_name);
        $insert_employee_statement->bindValue(':_phone', $_POST['number']);
        $insert_employee_statement->bindValue(':_email', $_POST['email']);
        $insert_employee_statement->bindValue(':_description', $_POST['notes']);
        $insert_employee_statement->bindValue(':_zipcode', $_POST['zipcode']);
        $insert_employee_statement->bindValue(':_passw', $_POST['password']);

        try {
            $insert_employee_statement->execute();
            echo "successfully inserted.";

        } catch(Exception $e) {
            echo $e->getMessage();
        }

        #inserting into employee_willing_animals table
        $employee_query = "SELECT employeeID from employee WHERE employee_name = :_emp_name AND email = :_email" ;
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
        //if successfully inserted into employee table and query works fine, then add to employee willing animals table
        if($employee_statement->rowCount() == 1) {

            
            foreach($animals as $animal => $id) {

                #if the checkbox has been checked
                if ($_POST[$animal]) {
                    #insert into employee_willing_animals
                    $insert_empWilling_query = "INSERT INTO employee_willing_animals VALUES (:_empID, :_animalID);";
                    $insert_empWilling_statement = $db->prepare($insert_empWilling_query);
                    $insert_empWilling_statement->bindValue(":_empID", $employee['employeeID']);
                    $insert_empWilling_statement->bindValue(":_animalID", $id);
                    $insert_empWilling_statement->execute();
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

        <?php foreach($animals as $animal => $id): ?>
            <input type = "checkbox" name = <?php echo $animal; ?> value = <?php echo $animal; ?>>
            <label for=<?php echo $animal; ?>> <?php echo $animal; ?> </label><br>
           
        <?php endforeach; ?>

        <label for="notes">Description:</label><br>
        <textarea id="notes" name="notes" rows="4" cols="50">
        </textarea><br><br>
        <input type="submit" name = "submit" value="Submit">
    </form> 
</body>
</html>