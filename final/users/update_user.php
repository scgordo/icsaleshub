<?php

// Start user auth

session_start();
ob_start();
if (isset($_SESSION['first_name']) && !empty($_SESSION['first_name'])) {
require_once("../db_connection.php"); 
// debugging session variables -- output all of them to make sure they are properly set
 //echo '<pre>';
 //var_dump($_SESSION);
 //echo '</pre>';

if ($_SESSION["user_type"] != 'admin') {
	 echo "Access is unauthorized!"; 
 header("Location: /final/login.php"); 
 exit();
}
 
$query = "SELECT * FROM users";
 $result = mysqli_query($connection, $query);
if (!$result)
 { 
 die("Database connection failed." . mysqli_error($connection));
 }
 
 if ($_SESSION["user_type"] != 'admin') {
	die("Database connection failed." . mysqli_error($connection));
 }
 if (isset($_SESSION["user_id"])) {
 echo "Welcome " . $_SESSION["first_name"] . " | <a href='../logout.php'>Logout</a>";
 }
	if ($_SESSION["user_type"] == 'admin') {
		echo " | <a href='/final/users/listusers.php'>List Users</a>";
	}
 }
else {
 echo "Access is unauthorized!"; 
 header("Location: /final/login.php"); 
 exit();
 
// End user auth

}?>


<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// set your error variables up
$errors = "";

// initialize your variables for the form 
$email = $first_name = $last_name = $sales_company_id = $password = $password2 = "";


// Check if the server has posted the data, and begin validation and saving input data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["password"])) {
    $errors .= "Password is required. ";
  } else {
    $password = test_input($_POST["password"]);
  }
  
  if (empty($_POST["password2"])) {
    $errors .= "Password must be re-entered. ";
  } else {
    $password2 = test_input($_POST["password2"]);
  }
  
  if ($password != $password2) {
    $errors .= "Password must be the same in both fields. ";
	unset($password);
  } 
  
  if (empty($_POST["email"])) {
	  $errors .= "Email address is required. ";
  } else {
	  $email = test_input($_POST["email"]);
  }
 
$first_name = test_input($_POST["first_name"]);   
$last_name = test_input($_POST["last_name"]);   
$sales_company_id = $_POST["sales_company_id"];  
$user_id = $_POST["user_id"];

// After all form data has been stored to variables, create your query
// Be careful of your quotes/quotation marks. You have to use different ones for the variable assignment and different ones for the query values

if (isset($password, $password2, $email)) {
	$update_query = 
    "UPDATE users 
     SET email = '$email',
     first_name = '$first_name',
     last_name = '$last_name',    
     sales_company_id = '$sales_company_id',
     password = '$password' 
     WHERE user_id = $user_id";
     
// For Debugging

// echo $update_query . "<br>";
$update_result = mysqli_query($connection, $update_query);
}


if ($update_result) {
	// Success
	$message = "<br><br> User updated.";
    echo $message;
//	redirect_to("listusers.php");
} else {
		// Failure
	$message = "<br><br> User update failed.";
    echo $message . " " . $errors;
//		redirect_to("listusers.php");
	}
	
} else {
	// This is probably a GET request
//	redirect_to("new_subject.php");
}

?>


<?php
	if (isset($connection)) { mysqli_close($connection); }
?>
<a href="listusers.php">Go back to User list</a>