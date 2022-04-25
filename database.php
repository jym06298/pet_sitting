<?php
    $dsn = 'mysql:host=localhost;dbname=pet_sitting';
    $username = 'root';
    $password = 'asjdf';

    // Error handling
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo  '<p> Unable to connect to the database: '.$error;
        exit();
    }
    

?>