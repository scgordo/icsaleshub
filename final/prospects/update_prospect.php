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
$code = $_POST['code'];
$facility_name = $_POST['facility_name'];
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
 
$prospect_id = $_POST["prospect_id"];

// After all form data has been stored to variables, create your query
// Be careful of your quotes/quotation marks. You have to use different ones for the variable assignment and different ones for the query values

$update_query = 
    "UPDATE prospects 
     SET code = '$code',
     facility_name = '$facility_name',
     provider_number = '$provider_number',    
     city = '$city',
     state = '$state',
     web = '$web',
     cmi = '$cmi',
     discharges_per_year = '$discharges_per_year',
     beds = '$beds',
     price_quoted = '$price_quoted',
     contact_name = '$contact_name',
     contact_title = '$contact_title',
     contact_email = '$contact_email',
     contact_phone = '$contact_phone',
     contact2_name = '$contact2_name',
     contact2_title = '$contact2_title',
     contact2_email = '$contact2_email',
     contact2_phone = '$contact2_phone'
     
      WHERE prospect_id = $prospect_id";
	  
// For Debugging
// echo $update_query . "<br>";
$update_result = mysqli_query($connection, $update_query);

    
if ($update_result) {
	// Success
	$message = "<br><br> Prospect updated.";
    echo $message;
//	redirect_to("listusers.php");
} 
    else {
		// Failure
    echo "Facilty not updated for the following reason(s):" . "<br>";
	 echo $errors;

	}
	
}

?>


<?php
	if (isset($connection)) { mysqli_close($connection); }
?>
<a href="listprospects.php">Go back to Prospects list</a>