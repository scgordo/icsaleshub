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

// function that will check to make sure inputted data is safe
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// set your error variables up
$email_err = $fname_err = $lname_err = $city_err = $sales_company_err = $pass1_err = $pass2_err = "";

// initialize your variables for the form 
$email = $first_name = $last_name = $city = $sales_company = $password = $password2 = "";


// Check if the server has posted the data, and begin validation and saving input data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    $email_err = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
 
$first_name = test_input($_POST["first_name"]);   
$last_name = test_input($_POST["last_name"]);   
$sales_company = $_POST["sales_company"];       
    
    
 if (empty($_POST["password"]))  {
     $pass1_err = "Password is required";    
 }   
 else {
     $password = test_input($_POST["password"]);
 }

// After all form data has been stored to variables, create your query

    
$insert_query = 
    "INSERT INTO users (email, first_name, last_name, sales_company_id, password) 
     VALUES ('$email', '$first_name', '$last_name', '$sales_company', '$password')";

$insert_result = mysqli_query($connection, $insert_query);

if ($insert_result) {
	// Success
	$message = "User created.";	
	echo $message . "<br>";
	echo '<a href="/final/users/listusers.php">Back to List Users</a>';
} else {
		// Failure
	$message = "User creation failed.";
	echo $message;
	echo '<a href="/final/users/listusers.php">Back to List Users</a>';

//		redirect_to("new_subject.php");
	}
    
} else {
	// This is probably a GET request
//	redirect_to("new_subject.php");
}



?>


<?php
	if (isset($connection)) { mysqli_close($connection); }
?>
