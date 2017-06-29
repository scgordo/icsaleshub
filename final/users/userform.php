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
<main>
	<h3>User Registration</h3>
	<form action="create_user.php" method="post">
	  <p>Email address:
	    <input type="text" name="email" value="" />
	  </p>
          <p>First name:
            <input type="text" name="first_name" value="" />
          </p>
          <p>Last name:
            <input type="text" name="last_name" value="" />
          </p>             
          <p>State:
            <select name="sales_company">
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
       <button onclick="location.href='listusers.php'" type="button">
     Back to User List</button>
        <input type="submit" value="Register">    
    </form>  
		  
</main>
</body>
</html>