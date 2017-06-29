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
		echo " | <a href='//final/users/listusers.php'>List Users</a>";
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
	<link rel="stylesheet" href="list_action_items_style.css" type="text/css">
	<style>
	ul {
    list-style-type: none;
    margin-left: 15%;
	margin-right: 15%;
    padding: 0;
    overflow: hidden;
	text-align: center;
}

li {
    float: left;
	width: 200px;
	background: #333;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover{
    background-color: #111;
}
</style>
</head>
<body>
<?php
$prospect_id = $_GET['uid'];

$query = "SELECT prospects.*, action_items.* 
FROM action_items 
JOIN prospects 
ON action_items.prospect_id = prospects.prospect_id 
WHERE action_items.prospect_id = $prospect_id
ORDER BY action_items.action_item_timestamp DESC
LIMIT 20";
$result = mysqli_query($connection, $query);

$facility_name_query = "SELECT prospects.facility_name FROM prospects WHERE prospects.prospect_id = $prospect_id";
$result2 = mysqli_query($connection, $facility_name_query);
$inst_name = mysqli_fetch_array($result2);


if (!$result)
{	
	die("Database connection failed." . mysqli_error($connection));
}
if (!$result2)
{	
	die("Database connection failed." . mysqli_error($connection));
}

//For debugging
//echo "Prospect ID: " . $prospect_id . "<br>";
//echo "Query: " . $query . "<br>";
//echo $facility_name_query;
?>

<h3>Prospect Action Items For Facility: <?php echo $inst_name['facility_name']; ?></h3>


<table>
<thead>
<tr><th>Date/Time Updated</th>
	<th>Facility Name</th>
	<th>Email Sent (YYYY-MM-dd)</th>
	<th>Last Called (YYYY-MM-dd)</th>
	<th>Callback (YYYY-MM-dd)</th>
	<th>Interest Level</th>
	<th>Current Client? Y/N</th>
	<th>Demo Performed? Y/N</th>
	<th>Demo Date (YYYY-MM-dd)</th>
	<th>Post Demo Letter Sent (YYYY-MM-dd)</th>
	<th>Reference Sent (YYYY-MM-dd)</th>
	<th>Contract Sent (YYYY-MM-dd)</th>
	<th>IT Issues</th>
	<th>Comments</th>
</tr>
</thead>
<?php
while ($row = mysqli_fetch_array($result))
{
 echo "<tr><td>" . $row['action_item_timestamp'] . "</td><td>" . $row['facility_name'] . "</td><td>" . $row['email_sent'] . "</td><td>" . $row['last_called'] . "</td><td>" . 
 $row['callback'] . "</td><td>" . $row['interest_level'] . "</td><td>" . $row['current_client'] . "</td><td>" .
 $row['demo_performed'] . "</td><td>" . $row['demo_date'] . "</td><td>"  . $row['post_demo_letter_sent'] . "</td><td>" .
 $row['reference_sent'] . "</td><td>" . $row['contract_sent'] . "</td><td>" . $row['it_issues'] . "</td><td>"
  . $row['comments'] . "</td></tr>";
 }
mysqli_free_result($result);
mysqli_close($connection);
?>

</table>

<br>
<hr>
<br>

<ul>

	<li><?php echo "<a href='/final/action_items/edit_action_item.php?uid=" . $prospect_id . "'>" . "Add Action Item" . "</li>" .
	"<li><a href='/final/prospects/listprospects.php'>Back to Prospects List</a></li>"; ?>

</ul>
</body>

</html>