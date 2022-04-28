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
    <form action="/action_page.php">
        <label for="fname">First name:</label><br>
        <input type="text" id="fname" name="fname" placeholder="John"><br><br>
        <label for="lname">Last name:</label><br>
        <input type="text" id="lname" name="lname" placeholder="Doe"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="email@gmail.com"><br><br>
        <label for="number">Phone number:</label><br>
        <input type="tel" id="number" name="number" placeholder="123-456-7890"><br><br>

        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
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
        <input type="submit" value="Submit">
    </form> 
</body>
</html>