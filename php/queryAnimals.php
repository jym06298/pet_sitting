<?php 
    require('database.php');

    $animals_query = "SELECT animal_name, animalID from animals;";

    $animals_statement = $db->prepare($animals_query);
    $animals_statement->execute();
    $animals = array();


    while( $row = $animals_statement->fetch() ) {
        $animals[$row['animal_name']] = $row['animalID'];
    }
?>