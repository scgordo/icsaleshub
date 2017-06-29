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
	<link rel="stylesheet" href="prospects_list_style.css" type="text/css">
</head>
<body>
    



<?php

$query = "SELECT * FROM prospects";

$result = mysqli_query($connection, $query);

if (!$result)
{	
	die("Database connection failed." . mysqli_error($connection));
}
?>

<h3>Sales Prospects List</h3>
<a href="prospect_form.php">Add a Prospect</a><br>

<table>
<thead>
<tr><th id ="pid">ID (Click to Edit Info)</th>
    <th id="code">Facility Code (Click to view)</th>
	<th>Facility Name</th>
	<th>City</th>
	<th>State</th>
	<th>CMI</th>
	<th>Beds</th>
	<th>Discharges</th>
	<th>Price Quoted</th>
	<th>Show Action Items</th>
	<th>Edit Action Items</th>
</tr>
</thead>
<?php
while ($row = mysqli_fetch_array($result))
{
 echo "<tr><td><a href='edit_prospect.php?uid=" . $row['prospect_id'] . "'>" . $row['prospect_id'] . "</a></td><td>"."<a href='view_prospect.php?uid=" . $row['prospect_id'] . "'>" . $row['code'] . "</a></td><td>" . $row['facility_name'] . "</td><td>". $row['city'] . "</td><td>" . $row['state'] . "</td><td>" . $row['cmi'] . "</td><td>"  . $row['beds'] . "</td><td>" .
 $row['discharges_per_year'] . "</td><td> $" . $row['price_quoted'] . "</td><td><a href='/final/action_items/list_action_items.php?uid=" . $row['prospect_id'] . "'>" . "Show Action Items" . "</a></td><td><a href='/final/action_items/edit_action_item.php?uid=" . $row['prospect_id'] . "'>" . "Edit Action Items" . "</a></td></tr>";
 }
mysqli_free_result($result);
mysqli_close($connection);
?>

</table>

</body>

</html>