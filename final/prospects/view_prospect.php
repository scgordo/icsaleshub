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
	<link rel="stylesheet" href="view_prospect_style.css" type="text/css">
<style>
	ul {
    list-style-type: none;
    margin-left: 30%;
	margin-right: 30%;
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
$query = "SELECT * FROM prospects WHERE prospect_id = $prospect_id";
$result = mysqli_query($connection, $query);

$facility_name_query = "SELECT prospects.facility_name FROM prospects WHERE prospects.prospect_id = $prospect_id";
$result2 = mysqli_query($connection, $facility_name_query);
$inst_name = mysqli_fetch_array($result2);

//For debugging
//echo "Prospect ID: " . $prospect_id . "<br>";
//echo "Query: " . $query . "<br>";
?>

<h3>Prospect Information For Facility: <?php echo $inst_name['facility_name']; ?></h3>

<table>
<thead>
<tr><th>Prospect ID</th>
    <th>Facility Code</th>
	<th>Facility Name</th>
	<th>Provider Number</th>
	<th>City</th>
	<th>State</th>
	<th>Website</th>
	<th>CMI</th>
	<th>Beds</th>
	<th>Discharges</th>
	<th>Price Quoted</th>
	<th>Contact #1 Name</th>
	<th>Contact #1 Title</th>
	<th>Contact #1 Email</th>
	<th>Contact #1 Phone</th>
	<th>Contact #2 Name</th>
	<th>Contact #2 Title</th>
	<th>Contact #2 Email</th>
	<th>Contact #2 Phone</th>
</tr>
</thead>

<?php
while ($row = mysqli_fetch_array($result))
{
 echo "<tr><td>" . $row['prospect_id'] . "</td><td>" . $row['code'] . "</td><td>" . $row['facility_name'] . "</td><td>" . 
 $row['provider_number'] . "</td><td>" . $row['city'] . "</td><td>" . $row['state'] . "</td><td>" .
 $row['web'] . "</td><td>" . $row['cmi'] . "</td><td>"  . $row['beds'] . "</td><td>" .
 $row['discharges_per_year'] . "</td><td>" . $row['price_quoted'] . "</td><td>" . $row['contact_name'] . "</td><td>"
  . $row['contact_title'] . "</td><td>" . $row['contact_email'] . "</td><td>" . $row['contact_phone'] . "</td><td>"
   . $row['contact2_name'] . "</td><td>" . $row['contact2_title'] . "</td><td>" . $row['contact2_email'] . "</td><td>"
    . $row['contact2_phone'] . "</td></tr>";
 }
mysqli_free_result($result);
mysqli_close($connection);
?>
</table>
<br>
<hr>
<br>
<ul>

	<li><?php echo "<a href='/final/action_items/edit_action_item.php?uid=" . $prospect_id . "'>" . "Edit Action Items" . "</a></li>
	<li><a href='/final/action_items/list_action_items.php?uid=" . $prospect_id . "'>" . "Show Action Items" . "</li>" .
	"<li><a href='listprospects.php'>Back to Prospects List</a></li>"; ?>
</ul>

</body>

</html>