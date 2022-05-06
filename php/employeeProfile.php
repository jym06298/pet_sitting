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
			</ul>
			<h2>Order history:</h2>
			<ul>
				<li>list specific animal they took care of</li>
				<li>list specific animal they took care of</li>
			 </ul>
		</div>
		<h3>Pet-sitting at your convenience! Just post and certified pet sitters in your area will come at your service.</h3>
		<img id="pet_pic" src="https://cdn.pixabay.com/photo/2018/10/01/09/21/pets-3715733_1280.jpg" alt="Pets" style="max-width: 100%;width:auto;height:auto;">
		<div class="footer">
		 
		</div>
	</body>
</html>