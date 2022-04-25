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

    <title>Form</title>
</head>
<body>
    <h2>Customer Request Form</h2>

    <!--This form should lead to the cards page-->
    <form >
        <label for="search">What animal would you like to watched?</label><br>
        <select id="search" name="search">
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
            <option value="fish">Fish</option>
            <option value="Reptile">Reptile</option>
            <option value="Rodent">Rodent</option>
        </select><br><br>
        <input type="submit" value="Submit" onClick="clickedSubmit()">
    </form><br><br>

    <div id="results"></div>

    <script defer src="orders.js">
    </script>
</body>
</html>