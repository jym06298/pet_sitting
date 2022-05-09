<?php
  session_start();
  require('database.php');
  require('queryAnimals.php');

  
  
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

    if( isset($_GET['delete']) ) {
      $delete_account_query = "DELETE FROM employee WHERE employeeID =:_employeeID ;";
      $delete_account_statement = $db->prepare($delete_account_query);
      $delete_account_statement->bindValue(":_employeeID", $_SESSION['userID']);

      try {
        $delete_account_statement->execute();
        header("Location: logout.php");
      } catch(Exception $e) {
          echo $e->getMessage();
      } //try catch

    }

    foreach($employee_willing_animals as $animal) {
      $_name = "remove" .$animal;
      if( isset($_GET[$_name]) ) {
        $delete_willing_query = "DELETE FROM employee_willing_animals WHERE employeeID =:_employeeID AND animalID = :_animalID;";
        $delete_willing_statement = $db->prepare($delete_willing_query);
        $delete_willing_statement->bindValue(":_employeeID", $_SESSION['userID']);
        $delete_willing_statement->bindValue(":_animalID", $animals[$animal]);

        try {
          $delete_willing_statement->execute();
          header("Location: employeeProfile.php");
        } catch(Exception $e) {
            echo $e->getMessage();
            function_alert("Something went wrong with our query");
        } //try catch
      } //if
    }



    if( isset($_POST['update']) ) {
      $update_array = array();

      if(!empty($_POST['email'])) {
        $update_array['email'] = $_POST['email'];
      } 
      if (!empty($_POST['phone'])){
        $update_array['phone'] = $_POST['phone'];
      }
      if (!empty($_POST['zipcode'])) {
        $update_array['zipcode'] = $_POST['zipcode'];
      }
      if(!empty($_POST['password'])) {
        $update_array['password'] = $_POST['password'];
      }

      foreach($update_array as $column => $update_val) {
        
        $update_query = "UPDATE customers SET $column = :_new_value WHERE customerID = :_customerID;";
        $update_statement = $db->prepare($update_query);
        $update_statement->bindValue(":_new_value", $update_val);
        $update_statement->bindValue(":_customerID", $_SESSION['userID']);

       
        try {
          $update_statement->execute();
          $update_statement->closeCursor();
        } catch(Exception $e) {
          function_alert("Something went wrong. Please try again.");  
          echo $e->getMessage();
            
        } //try catch

      } //foreach

      foreach($animals as $animal => $id) {

        //If the checkbox has been checked
        if (isset($_POST[$animal])) {
            #insert into employee_willing_animals
            $insert_empWilling_query = "INSERT INTO employee_willing_animals VALUES (:_empID, :_animalID);";
            $insert_empWilling_statement = $db->prepare($insert_empWilling_query);
            $insert_empWilling_statement->bindValue(":_empID", $_SESSION['userID']);
            $insert_empWilling_statement->bindValue(":_animalID", $id);

            try {

              $insert_empWilling_statement->execute();
              $insert_empWilling_statement->closeCursor();
              header("Location: employeeProfile.php");

            } catch(Exception $e) {
              function_alert("Something went wrong. Please try again.");  
              echo $e->getMessage();
                
            } //try catch
            
        }
   } //foreach

    } //if

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
				<?php if (isset ($_SESSION['loggedin'])): ?>
				<li><a href= <?php
					if ($_SESSION['isEmployee']) {
						echo "employeeProfile.php";
					} else {
						echo "customerProfile.php";
					} //if else
				?>>Profile</a></li>
				<?php endif ?>
				<li><a href="employeeSignup.php">Employee Sign-Up</a></li>
				<li><a href="customerSignUp.php">Customer Sign-Up</a></li>
				<?php if(isset($_SESSION['isEmployee']) && isset($_SESSION['loggedin'])):?>
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
				<li><?php echo $animal;
              $name = "remove" .$animal;
              ?> <form method ="get" action="#"><input type = "submit" name = <?php echo $name; ?> value="remove"></form>
        </li>
        
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

    <form action="#" method = "post">
			
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" placeholder="email@gmail.com"><br>
			<label for="number">Phone number:</label>
			<input type="tel" id="number" name="phone" placeholder="123-456-7890"><br>
			<label for="password">Password:</label>
			<input type="text" id="password" name="password"><br>
			<label for="zipcode">Zipcode:</label>
			<input type="text" id="zipcode" name="zipcode"><br>
			<label for="animal">Which animals are you willing to take care of:</label><br>

			<?php foreach($animals as $animal => $id): ?>
        <?php if( !in_array($animal, $employee_willing_animals) ): ?>
				<input type = "checkbox" name = <?php echo $animal; ?> value = <?php echo $animal; ?>>
				<label for=<?php echo $animal; ?>> <?php echo $animal; ?> </label><br>
			  <?php endif ?>
			<?php endforeach; ?>

			<label for="notes">Description:</label><br>
			<textarea id="notes" name="notes" rows="4" cols="50"></textarea><br>
			<input class="submit" type="submit" name="update" value="Submit">
		</form> 

    <form id="account_settings" action="#" method="get">
				<h2>Account settings:</h2>
				<h3 style="margin-left: 25px;">Delete your profile</h3>
				<input style="margin-left: 25px;" class="submit" type="submit" name="delete" value="DELETE">
			</form> 
		<h3>Pet-sitting at your convenience! Just post and certified pet sitters in your area will come at your service.</h3>
		<img id="pet_pic" src="https://cdn.pixabay.com/photo/2018/10/01/09/21/pets-3715733_1280.jpg" alt="Pets" style="max-width: 100%;width:auto;height:auto;">
		<div class="footer">
		 
		</div>
	</body>
</html>