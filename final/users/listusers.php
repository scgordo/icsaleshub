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

if ($_SESSION["user_type"] != 'admin') {
	 echo "Access is unauthorized!"; 
 header("Location: /final/login.php"); 
 exit();
}
 
$query = "SELECT * FROM users";
 $result = mysqli_query($connection, $query);
if (!$result)
 { 
 die("Database connection failed." . mysqli_error($connection));
 }
 
 if ($_SESSION["user_type"] != 'admin') {
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
	<link rel="stylesheet" href="users_style.css" type="text/css">
</head>
<body>


<?php

$query = "SELECT * FROM users
JOIN sales_companies
ON users.sales_company_id = sales_companies.sales_company_id";
$result = mysqli_query($connection, $query);

if (!$result)
{	
	die("Database connection failed." . mysqli_error($connection));
}
?>

<h3>REGISTERED WEBSITE USERS</h3>
<a href="userform.php">Add a User</a><br>
<a href="../prospects/listprospects.php">Prospects List</a>
<table>
<thead>
<tr><th>First Name</th>
	<th>Last Name</th>
	<th>Email Address</th>
	<th>Sales Company</th>
</tr>
</thead>
<?php
while ($row = mysqli_fetch_array($result))
{
 echo "<tr><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td><a href='edit_user.php?uid=" . $row['user_id'] . "'>" . $row['email'] . "</a></td><td>" . $row['sales_company_name'] . "</td></tr>";
 }
mysqli_free_result($result);
mysqli_close($connection);
?>

</table>

</body>

</html>