<?php
  session_start();
  require('database.php');
#  require('queryAnimals.php');


  
  if (isset($_SESSION['loggedin'])) {
   
    $animal_names_query = "CALL get_employee_willing_animal_names(:_employeeID)";
    $animal_names_statement = $db->prepare($animal_names_query);
    $animal_names_statement->bindValue(":_employeeID", $_SESSION['userID']);

    try {
      $animal_names_statement->execute();
    } catch(Exception $e) {
      echo $e->getMessage();
    }

    $employee_willing_animals = array();

    while( $row = $animal_names_statement->fetch() ) {
      array_push($employee_willing_animals, $row['animal_name']);
    }
    $animal_names_statement->closeCursor();

    $accepted_order_query = "SELECT * FROM orders WHERE employeeID = :_employeeID;";
    $accepted_order_statement = $db->prepare($accepted_order_query);
    $accepted_order_statement->bindValue(":_employeeID", $_SESSION['userID']);

    try {
      $accepted_order_statement->execute();
      $orders = $accepted_order_statement->fetchAll();

    } catch(Exception $e) {
        echo $e->getMessage();
    } //try catch

  } //if

?>

<!DOCTYPE html>
<html>
	<head>
		<title> Employee Profile </title>
		<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
		<div class="together">
			<a href="homepage.php"><img id="logoImg" src="pawprint.png"></a>
			<h1>DBMS Petsitting Co. Pet-Sitter</h1>
		</div>

		<!-- TOP NAV BAR -->
		<div class="topnav">
			<ul>
				<li><a href="homepage.php">Home</a></li>
				
				<!-- EMPLOYEE PROFILE OR CUSTOMER PROFILE (Dont show if not logged in)-->
				<?php if ($_SESSION['loggedin']): ?>
				<li><a href= <?php
					if ($_SESSION['isEmployee']) {
						echo "employeeProfile.php";
					} else {
						echo "customerProfile.php";
					} //if else
				?> >Profile</a> </li>
				<?php endif ?>
				<li><a href="employeeSignup.php">Employee Sign-Up</a></li>
				<li><a href="customerSignUp.php">Customer Sign-Up</a></li>
				<?php if(!$_SESSION['isEmployee'] && $_SESSION['loggedin']):?>
				<li><a href="animalSignup.php">Create Pet Account</a></li>
				<li><a href="createPosts.php">Create Post</a></li>
				<?php endif ?>
				<li><a href="search.php">Posts</a></li>
				<li><a href="login.php">Login</a> </li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div><br>
	  	<div class="content">
		<img src="profilepic.png" alt="Profile Pic" width="100", height="100", style="max-width: 50%">  

		<!-- PHP to list the animals employee is willing to take care of HERE -->
		<div>
			<h2>Animals you are willing to take care of:</h2>
			<ul>
				<?php foreach($employee_willing_animals as $animal): ?>
				<li><?php echo $animal ?></li>
				<?php endforeach ?>

        <h2>Orders you have accepted:</h2>
        <ul>
          <?php if ($accepted_order_statement->rowCount() == 0): ?>
            <li>You have no orders</li>
					<?php endif ?>

          <?php foreach($orders as $order): ?>
					<li>
            <?php
              $pet_name_procedure = "CALL get_pet_name(:_petID);";
              $pet_name_statement = $db->prepare($pet_name_procedure);
              $pet_name_statement->bindValue(":_petID", $order['petID']);

              try {
                $pet_name_statement->execute();
                $pet = $pet_name_statement->fetch();
                
              } catch(Exception $e) {
                  echo $e->getMessage();
              } //try catch
              
              echo "Pet: " .$pet['pet_name'] ."<br>Start Time: " .$order['begin_time'] ."<br>End Time: " .$order['end_time'];
           
            ?>
          </li>
					<?php endforeach ?>
					
				  </ul>
		</div>
		<h3>Pet-sitting at your convenience! Just post and certified pet sitters in your area will come at your service.</h3>
		<img id="pet_pic" src="https://cdn.pixabay.com/photo/2018/10/01/09/21/pets-3715733_1280.jpg" alt="Pets" style="max-width: 100%;width:auto;height:auto;">
		<div class="footer">
		 
		</div>
	</body>
</html>