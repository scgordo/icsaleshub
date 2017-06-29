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

<?php require_once("db_connection.php"); ?>

<?php
$prospect_id = $_GET['uid'];
$query = "SELECT prospects.*, action_items.* 
FROM action_items 
JOIN prospects 
ON action_items.prospect_id = prospects.prospect_id 
WHERE action_items.prospect_id = $prospect_id";

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

//For debugging
// echo $prospect_id;
// echo $query;
// echo $row['last_called'];


?>

<main>
	<h2>Create Action Items</h2>
<form action="create_action_item.php" method="post">
<p>Prospect ID: <?php echo $prospect_id; ?></p>
<p>Facility Name: <?php echo $row['facility_name']; ?></p>             
          <p>Email Sent (YYYY-MM-dd):
			<input type="text" name="email_sent" value="<?php echo $row['email_sent']; ?>" />
          </p>  
         <p>Last Called (YYYY-MM-dd):
         <input type="text"name="last_called" value="<?php echo $row['last_called']; ?>" >             
         </p>    
         <p>Callback (YYYY-MM-dd):
         <input type="text"name="callback" value="<?php echo $row['callback']; ?>" >             
         </p>
		 <p>Interest Level:
         <input type="text"name="interest_level" value="<?php echo $row['interest_level']; ?>" >             
         </p> 
         <p>Current Client? (Y/N):
         <input type="text"name="current_client" value="<?php echo $row['current_client']; ?>" >             
         </p>
         <p>Demo Performed? (Y/N)>:
         <input type="text"name="demo_performed" value="<?php echo $row['demo_performed']; ?>" >             
         </p>
         <p>Demo Date (YYYY-MM-dd):
         <input type="text"name="demo_date" value="<?php echo $row['demo_date']; ?>" >             
         </p>
         <p>Post Demo Letter Sent (YYYY-MM-dd):
         <input type="text"name="post_demo_letter_sent" value="<?php echo $row['post_demo_letter_sent']; ?>" >             
         </p>
         <p>Reference Sent (YYYY-MM-dd):
         <input type="text"name="reference_sent" value="<?php echo $row['reference_sent']; ?>" >             
         </p>    
         <p>Contract Sent (YYYY-MM-dd):
         <input type="text"name="contract_sent" value="<?php echo $row['contract_sent']; ?>" >             
         </p>
         <p>IT Issues:
         <textarea id="it_issues" cols="20" rows="5" name="it_issues" value="<?php echo $row['it_issues']; ?>" ></textarea>             
         </p>
         <p>Comments:
         <textarea id="comments" cols="86" rows="10" name="comments" value="<?php echo $row['comments']; ?>" ></textarea>             
         </p> 		 
       <button onclick="location.href='/final/prospects/listprospects.php'" type="button">
     Back to Prospects List</button>
  
<input type="submit" value="Create">    
</form>  
		  
</main>