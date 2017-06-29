<?php require_once("../db_connection.php"); ?>

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
$prospect_id = $action_item_timestamp = $code = $facility_name = $provider_number = $city = $state
= $web = $cmi = $discharges_per_year = $beds = $price_quoted = $contact_name = $contact_title
 = $contact_email = $contact_phone = $contact2_name = $contact2_title = $contact2_email = $contact2_phone = "";


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
	
     VALUES ('$prospect_id', '$action_item_timestamp', '$code', '$facility_name', '$provider_number', '$city', 
	 '$state', '$web', '$cmi', '$discharges_per_year', '$beds', '$price_quoted', '$contact_name', '$contact_title', 
	 '$contact_email', '$contact_phone', '$contact2_name', '$contact2_title', '$contact2_email', '$contact2_phone')";


$insert_result = mysqli_query($connection, $insert_query);

if ($insert_result) {
	// Success
	$message = "Prospect created.";	
	echo $message . "<br>";
	echo '<a href="/final/prospects/listprospects.php">Back to List of Prospects</a>';
} else {
		// Failure
    echo $insert_query . "<br>";
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
