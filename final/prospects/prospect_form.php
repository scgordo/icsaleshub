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

<main>
	<h3>Create a Facility Prospect</h3>
	<form action="create_prospect.php" method="post">
	  <p>Facility Code:
	    <input type="text" name="code" value="" />
	  </p>
          <p>Facility Name:
            <input type="text" name="facility_name" value="" />
          </p>
          <p>Provider Number:
            <input type="text" name="provider_number" value="" />
          </p>             
          <p>City:
			<input type="text" name="city" value="" />
          </p>  
         <p>State (2 letter abbreviation):
         <input type="text"name="state" value="" >             
         </p>    
        <p>Website:
			<input type="text" name="web" value="">  
        </p>    
		<p>CMI:
			<input type="text" name="cmi" value="">  
        </p>
		<p>Discharges Per Year:
			<input type="text" name="discharges_per_year" value="">  
        </p>
		<p>Beds:
			<input type="text" name="beds" value="">  
        </p>
		<p>Price Quoted:
			<input type="text" name="price_quoted" value="">  
        </p>
		<p>Contact Name:
			<input type="text" name="contact_name" value="">  
        </p>
		<p>Contact Title:
			<input type="text" name="contact_title" value="">  
        </p>
		<p>Contact Email:
			<input type="text" name="contact_email" value="">  
        </p>
		<p>Contact Phone:
			<input type="text" name="contact_phone" value="">  
        </p>
		<p>Contact2 Name:
			<input type="text" name="contact2_name" value="">  
        </p>
		<p>Contact2 Title:
			<input type="text" name="contact2_title" value="">  
        </p>
		<p>Contact2 Email:
			<input type="text" name="contact2_email" value="">  
        </p>
		<p>Contact2 Phone:
			<input type="text" name="contact2_phone" value="">  
        </p>
       <button onclick="location.href='listprospects.php'" type="button">
     Back to Prospects List</button>
        <input type="submit" value="Register">    
    </form>  
		  
</main>

</body>
</html>