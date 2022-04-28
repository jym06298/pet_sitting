<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="style.css">
    <title>Animal Profile Form</title>
</head>

<body>
    <h2>Animal Profile Form</h2>
    <form action="/action_page.php">
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" placeholder="Bobby"><br>
        <label for="animal">Choose animal type: </label>
        <select id="animal" name="animal">
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
            <option value="fish">Fish</option>
            <option value="Reptile">Reptile</option>
            <option value="Rodent">Rodent</option>
        </select><br>
        <label for="age">How old is your pet:</label>
        <select id="age" name="age">
            <option value="underOne">Less than a year old</option>
            <option value="young">1-3</option>
            <option value="mid">3-7</option>
            <option value="old">7+</option>
        </select><br>
        <label for="begin">Begin Date:</label>
        <input type="date" id="begin" name="begin">
        <label for="end">End Date:</label>
        <input type="date" id="end" name="end"><br>
        <label for="notes">Any additional notes: </label><br>
        <textarea id="notes" name="notes" rows="4" cols="50">
        
        </textarea><br><br>
        <input type="submit" value="Submit">
    </form> 
</body>
</html>