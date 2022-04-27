<?php
    session_start();
    if ( isset($_POST['submit']) ){
        $login_query = "SELECT * FROM customers, employees WHERE ";
    } else {
        echo "Please log-in";
    }
    
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
    <h2>Login Form</h2>
<form method = "post" action="#">
    <label for="email">Email:</label> <br /><input 
id="email" name="email" type="text" /><br /><br /><label 
for="password">Password:</label><br /><input id="password" name="password" 
type="text" /><br /><br /><input type="submit" value="Submit" />
</form> 

</body>
</html>
