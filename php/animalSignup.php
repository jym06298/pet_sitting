<?php
    session_start();
    require('queryAnimals.php');
    #petID	pet_name	customerID	animalID	



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="../css/style.css">
    <title>Animal Profile</title>
</head>

<body>
    <h2>Animal Profile</h2>
	<div class="topnav">
		<ul>
			<li><a href='homepage.php'>Home</a></li>
			<li><a href='employeeSignup.php'>Employee Sign-Up</a></li>
			<li><a href='customerSignUp.php'>Customer Sign-Up</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
    </div>
    <form action="#">
        <label for="name">Your pet's name: </label>
        <input type="text" id="name" name="name" placeholder="Bobby"><br>
        <label for="animal">Choose animal type: </label>
        <select id="animal" name="animal">
            <?php foreach($animals as $animal => $id): ?>
                <option value= <?php echo $animal ?> ><?php echo $animal ?> </option>
            <?php endforeach ?>
   
        </select><br>
        <label for="age">How old is your pet:</label>
        <select id="age" name="age">
            <option value="underOne">Less than a year old</option>
            <option value="young">1-3</option>
            <option value="mid">3-7</option>
            <option value="old">7+</option>
        </select><br>
        <label for="begin">Begin Date:</label>
        <input type="datetime" id="begin" name="begin">
        <label for="end">End Date:</label>
        <input type="datetime" id="end" name="end"><br>
        <label for="notes">Any additional notes: </label><br>
        <textarea id="notes" name="notes" rows="4" cols="50"></textarea><br>
        <input class="submit" type="submit" name = "submit" value="Submit">
    </form> 
</body>
</html>