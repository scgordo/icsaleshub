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
	<link rel="stylesheet" type="text/css" href="/final/form_style.css" >
</head>
<body>


<?php
$user_id = $_GET['uid'];
$query = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

//For debugging
//echo $user_id;
//echo $query;



?>
<main>
<h3>Edit User</h3>
<form action="update_user.php" method="post">
<p>Email address:
<input type="text" name="email" value="<?php echo $row['email']; ?>" />
</p>
<p>First name:
<input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" />
</p>
<p>Last name:
<input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" />
</p>    
<p>Sales Company:
    <select name="sales_company_id">
                <option value="1">Intelligent Charting</option>
                <option value="2">GPS Healthcare Consultants</option>
    </select>          
</p>  
<p>Password:
<input type="password" value="" name="password">             
</p>    
<p>Repeat Password:
<input type="password" value="" name="password2">  
</p>    
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">    
<input type="submit" value="Update">    
</form>  
		  
</main>
</body>
</html>