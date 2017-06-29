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


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/final/form_style.css" >
</head>

<body>


<?php
$prospect_id = $_GET['uid'];
$query = "SELECT * FROM prospects WHERE prospect_id = $prospect_id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

//For debugging
//echo $prospect_id;
//echo $query;



?>
<main>
<h3>Edit Prospect</h3>
<form action="update_prospect.php" method="post">
<p>Facility Code:
	    <input type="text" name="code" value="<?php echo $row['code']; ?>" />
	  </p>
          <p>Facility Name:
            <input type="text" name="facility_name" value="<?php echo $row['facility_name']; ?>" />
          </p>
          <p>Provider Number:
            <input type="text" name="provider_number" value="<?php echo $row['provider_number']; ?>" />
          </p>             
          <p>City:
			<input type="text" name="city" value="<?php echo $row['city']; ?>" />
          </p>  
         <p>State:
         <input type="text"name="state" value="<?php echo $row['state']; ?>" >             
         </p>    
        <p>Website:
			<input type="text" name="web" value="<?php echo $row['web']; ?>">  
        </p>    
		<p>CMI:
			<input type="text" name="cmi" value="<?php echo $row['cmi']; ?>">  
        </p>
		<p>Discharges Per Year:
			<input type="text" name="discharges_per_year" value="<?php echo $row['discharges_per_year']; ?>">  
        </p>
		<p>Beds:
			<input type="text" name="beds" value="<?php echo $row['beds']; ?>">  
        </p>
		<p>Price Quoted:
			<input type="text" name="price_quoted" value="<?php echo $row['price_quoted']; ?>">  
        </p>
		<p>Contact Name:
			<input type="text" name="contact_name" value="<?php echo $row['contact_name']; ?>">  
        </p>
		<p>Contact Title:
			<input type="text" name="contact_title" value="<?php echo $row['contact_title']; ?>">  
        </p>
		<p>Contact Email:
			<input type="text" name="contact_email" value="<?php echo $row['contact_email']; ?>">  
        </p>
		<p>Contact Phone:
			<input type="text" name="contact_phone" value="<?php echo $row['contact_phone']; ?>">  
        </p>
		<p>Contact2 Name:
			<input type="text" name="contact2_name" value="<?php echo $row['contact2_name']; ?>">  
        </p>
		<p>Contact2 Title:
			<input type="text" name="contact2_title" value="<?php echo $row['contact2_title']; ?>">  
        </p>
		<p>Contact2 Email:
			<input type="text" name="contact2_email" value="<?php echo $row['contact2_email']; ?>">  
        </p>
		<p>Contact2 Phone:
			<input type="text" name="contact2_phone" value="<?php echo $row['contact2_phone']; ?>">  
        </p>
       <button onclick="location.href='listprospects.php'" type="button">
     Back to Prospects List</button>
<input type="hidden" name="prospect_id" value="<?php echo $prospect_id; ?>">    
<input type="submit" value="Update">    
</form>  
		  
</main>
</body>
</html>