<?php
  session_start();
  require('database.php');
#  require('queryAnimals.php');


  
  if (isset($_SESSION['loggedin'])) {
   # Query all the pets that the customer has.
    $pet_query = "SELECT * FROM pet_accounts WHERE customerID = :_customerID;";
    $pet_query_statement = $db->prepare($pet_query);
    $pet_query_statement->bindValue(":_customerID", $_SESSION['userID']);

    try {
        $pet_query_statement->execute();
        $pets = $pet_query_statement->fetchAll();
    } catch(Exception $e) {
        echo $e->getMessage();
    } //try catch

   

  } //if

?>

<!DOCTYPE html>
<html>
<head>
    <title> Customer Profile </title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="header">
        <h1> <a href="homepage.php">Pet-Sitter</a> </h1>
    </div>


    <div class="topnav">
        
        <a href='homepage.php'>Home</a>
        <a href="employeeProfile.php">Profile</a>
        <a href='employeeSignup.php'>Employee Sign-Up</a>
        <a href='customerSignUp.php'>customer Sign-Up</a>
        <a href='logout.php' style="float:right">Sign Out</a>
        <a href='' style="float:right">orders</a>
    </div>


    <div class="content">
      <br>
    <img src="profilepic.png" alt="Profile Pic" width="100", height="100", style="max-width: 50%">  

      <!-- PHP to list the animals employee is willing to take care of HERE -->
      <div>
        Your pets:

        <ul>
        <?php if ($pet_query_statement->rowCount() == 0): ?>
            <li>You have no pets signed up</li>
        <?php endif ?>
        <?php foreach($pets as $pet): ?>
          <li><?php echo $pet['pet_name'] ?></li>
        <?php endforeach ?>

          
        </ul>

        Order history:
        <ul>
            <li>list specific animal they took care of</li>
            <li>list specific animal they took care of</li>
          </ul>
      </div>
      



        <div class="leftcolumn" style="font-size:large; line-height:2.0; text-align:center">
          Pet-sitting at your convenience! Just post and certified pet sitters in your area will come at your service.
        </div>

        <div class="center">
          <img src="https://cdn.pixabay.com/photo/2018/10/01/09/21/pets-3715733_1280.jpg" alt="Pets" style="max-width: 100%;width:auto;height:auto;">
        </div>


      <h3 style="color: #1c1c1c" > About Us </h3>
      

    </div>
    <div class="footer">
     
    </div>
</body>
</html>