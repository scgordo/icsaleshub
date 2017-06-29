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
	<script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
</head>

<body>

<?php
$prospect_id = $_GET['uid'];
$query = "SELECT prospects.facility_name, prospects.prospect_id, action_items.* 
FROM prospects 
JOIN action_items
ON prospects.prospect_id = action_items.prospect_id 
WHERE prospects.prospect_id = $prospect_id
ORDER BY action_items.action_item_timestamp DESC
LIMIT 1";

$options = "";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

//For debugging
// echo $prospect_id . "<br>";
// echo $facility_name . "<br>";
// echo $query . "<br>";
// echo $row['last_called'] . "<br>";


?>
<main>
<h3>Edit Prospect Action</h3>
<form action="update_action_item.php" method="post">
<p>Prospect ID: <?php echo $prospect_id; ?></p>
<p>Facility Name: <?php echo $row['facility_name']; ?></p>             
          <p>Email Sent:
				<input type="text" name="email_sent" alt="date" class="IP_calendar" title="Y-m-d" value="<?php echo $row['email_sent']; ?>" >
          </p>  
         <p>Last Called:
				<input type="text" name="last_called" id="last_called" alt="date" class="IP_calendar" title="Y-m-d" value="<?php echo $row['last_called']; ?>" >
         </p>    
         <p>Callback:
			<input type="text" name="callback" id="callback" alt="date" class="IP_calendar" title="Y-m-d" value="<?php echo $row['callback']; ?>" >            
         </p>
		<p>Interest Level:
			<select name="interest_level" value="">
				<option value="<?php echo $row['interest_level']; ?>"></option>
				<option value="Cold Call">Cold Call</option>
				<option value="Interested">Interested</option>
				<option value="Demoed">Demoed</option>
				<option value="Hot">Hot</option>
				<option value="Dead">Dead</option>
			</select>  
         </p> 
         <p>Current Client? (Y/N):
			<input type="text"name="current_client" value="<?php echo $row['current_client']; ?>" >             
         </p>
         <p>Demo Performed? (Y/N):
			<input type="text"name="demo_performed" value="<?php echo $row['demo_performed']; ?>" >             
         </p>
         <p>Demo Date:
			<input type="text" name="demo_date" id="demo_date" alt="date" class="IP_calendar" title="Y-m-d" value="<?php echo $row['demo_date']; ?>" >            
         </p>
         <p>Post Demo Letter Sent:
			<input type="text" name="post_demo_letter_sent" id="post_demo_letter_sent" alt="date" class="IP_calendar" title="Y-m-d" value="<?php echo $row['post_demo_letter_sent']; ?>" >           
         </p>
         <p>Reference Sent:
			<input type="text" name="reference_sent" id="reference_sent" alt="date" class="IP_calendar" title="Y-m-d" value="<?php echo $row['reference_sent']; ?>" > 
         </p>    
         <p>Contract Sent:
			<input type="text" name="contract_sent" id="contract_sent" alt="date" class="IP_calendar" title="Y-m-d" value="<?php echo $row['contract_sent']; ?>" > 
         </p>
         <p>IT Issues:
         <textarea id="it_issues" cols="20" rows="5" name="it_issues" value="<?php echo $row['it_issues']; ?>" ></textarea>             
         </p>
         <p>Comments:
         <textarea id="comments" cols="86" rows="10" name="comments" value="<?php echo $row['comments']; ?>" ></textarea>             
         </p> 		 
       <button onclick="location.href='/final/prospects/listprospects.php'" type="button">
     Back to Prospects List</button>
<input type="hidden" name="prospect_id" value="<?php echo $prospect_id; ?>">    
<input type="submit" value="Update">    
</form>  
		  
</main>
</body>
</html>