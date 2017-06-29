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
$email_sent = $_POST['email_sent'];
$last_called = $_POST['last_called'];
$callback = $_POST['callback'];
$interest_level = $_POST['interest_level'];
$current_client = $_POST['current_client'];
$demo_performed = $_POST['demo_performed'];
$demo_date = $_POST['demo_date'];
$post_demo_letter_sent = $_POST['post_demo_letter_sent'];
$reference_sent = $_POST['reference_sent'];
$contract_sent = $_POST['contract_sent'];
$it_issues = mysqli_real_escape_string($connection, $_POST['it_issues']);
$comments = mysqli_real_escape_string($connection, $_POST['comments']);

//$last_called = $callback = $interest_level = $current_client = $demo_performed 
//= $demo_date = $post_demo_letter_sent 
//= $reference_sent = $contract_sent = $it_issues = $comments = "";


// Check if the server has posted the data, and begin validation and saving input data

// TO DO: Validate

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // if (empty($_POST["code"])) {
 //   $errors .= "Code is required. ";
  //} else {
  //  $code = test_input($_POST["code"]);
  //}
  
//if (empty($_POST["facility_name"])) {
  //  $errors .= "Facility name is required";
  //} else {
   // $code = test_input($_POST["facility_name"]);
 // }

 
  
 
$prospect_id = $_POST["prospect_id"];

// After all form data has been stored to variables, create your query


$update_query = // need to figure out how to UPDATE if it exists, or INSERT INTO if it doesn't
	"REPLACE INTO action_items 
	 SET prospect_id = '$prospect_id',
	 action_item_timestamp = CURRENT_TIMESTAMP,
     email_sent = '$email_sent',
     last_called = '$last_called',
     callback = '$callback',    
     interest_level = '$interest_level',
     current_client = '$current_client',
     demo_performed = '$demo_performed',
     demo_date = '$demo_date',
     post_demo_letter_sent = '$post_demo_letter_sent',
     reference_sent = '$reference_sent',
     contract_sent = '$contract_sent',
     it_issues = '$it_issues',
     comments = '$comments'";
	  
// For Debugging

//echo $update_query . "<br>";
$update_result = mysqli_query($connection, $update_query);

    
if ($update_result) {
	// Success
	$message = "<br><br>Prospect updated.";
    echo $message;
//	redirect_to("listusers.php");
} 
    else {
		// Failure
    echo "Facilty not updated for the following reason(s):" . "<br>";
	 echo $errors;

	}
	


?>


<?php
	if (isset($connection)) { mysqli_close($connection); }
?>
<a href="/final/prospects/listprospects.php">Go back to Prospects list</a>