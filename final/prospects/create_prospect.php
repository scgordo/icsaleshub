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
 
// echo $_SESSION["user_type"] . "<br>";
 
$query = "SELECT * FROM users";
 $result = mysqli_query($connection, $query);
if (!$result)
 { 
 die("Database connection failed." . mysqli_error($connection));
 }
 if (isset($_SESSION["user_id"])) {
 echo "Welcome " . $_SESSION["first_name"] . " | <a href='logout.php'>Logout</a>";
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
$errors = "";

// initialize your variables for the form 
//$prospect_id = $code = $facility_name = $provider_number = $city = $state
//= $web = $cmi = $discharges_per_year = $beds = $price_quoted = $contact_name = $contact_title
// = $contact_email = $contact_phone = $contact2_name = $contact2_title = $contact2_email = $contact2_phone = "";

$provider_number = $_POST['provider_number'];
$city = $_POST['city'];
$state = $_POST['state'];
$web = $_POST['web'];
$cmi = $_POST['cmi'];
$discharges_per_year = $_POST['discharges_per_year'];
$beds = $_POST['beds'];
$price_quoted = $_POST['price_quoted'];
$contact_name = $_POST['contact_name'];
$contact_title = $_POST['contact_title'];
$contact_email = $_POST['contact_email'];
$contact_phone = $_POST['contact_phone'];
$contact2_name = $_POST['contact2_name'];
$contact2_title = $_POST['contact2_title'];
$contact2_email = $_POST['contact2_email'];
$contact2_phone = $_POST['contact2_phone'];


// Check if the server has posted the data, and begin validation and saving input data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["code"])) {
    $errors .= "Code is required. ";
  } else {
    $code = test_input($_POST["code"]);
  }
  
if (empty($_POST["facility_name"])) {
    $errors .= "Facility name is required";
  } else {
    $code = test_input($_POST["facility_name"]);
  }

 
$facility_name = test_input($_POST["facility_name"]);   
$code = test_input($_POST["code"]);      

 }
// After all form data has been stored to variables, create your query


$insert_query = 
    "INSERT INTO prospects (prospect_id, code, facility_name, provider_number, city, state, 
	web, cmi, discharges_per_year, beds, price_quoted, contact_name, contact_title, contact_email, contact_phone, contact2_name,
	contact2_title, contact2_email, contact2_phone) 
	
     VALUES ('$prospect_id', '$code', '$facility_name', '$provider_number', '$city', 
	 '$state', '$web', '$cmi', '$discharges_per_year', '$beds', '$price_quoted', '$contact_name', '$contact_title', 
	 '$contact_email', '$contact_phone', '$contact2_name', '$contact2_title', '$contact2_email', '$contact2_phone')";

echo $insert_query;
$insert_result = mysqli_query($connection, $insert_query);

if ($insert_result) {
	// Success
	$message = "Prospect created.";	
	echo $message . "<br>";
	echo '<a href="/final/prospects/listprospects.php">Back to List of Prospects</a>';
} else {
		// Failure
    // echo $insert_query . "<br>";
	echo $errors . "<br>";
    echo "Be sure you entered a code that is unique." . "<br>";
	echo '<a href="/final/prospects/listprospects.php">Back to List of Prospects</a>';

//		redirect_to("new_subject.php");
	}
    
// else {
	// This is probably a GET request
//	redirect_to("new_subject.php");
//}



?>


<?php
	if (isset($connection)) { mysqli_close($connection); }
?>
