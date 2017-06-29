<?php

function pc_validate($user,$pass) {
    /* replace with appropriate username and password checking,
       such as checking a database */
    $users = array('guest' => '!r3h4bs4l3s',
                   'admin'  => '!s4l3sadm1n');

    if (isset($users[$user]) && ($users[$user] == $pass)) {
        return true;
    } else {
        return false;
    }
}

	if(! pc_validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
	{
		header('WWW-Authenticate: Basic realm="Intelligent Charting Sales Hub"');
		header("HTTP/1.0 401 Unauthorized");
		echo "There was an error. Please contact the webmaster for authentication credentials.";
		exit;
	}

?>
<?php 
// initialize the session for this user
session_start();
ob_start();
// initialize message variable for success/failure
$message="";// check to see if anything has POSTED yet, if not, skip the PHP processing
if(count($_POST)>0) {
 // be sure to get your db connection variable before running a query
 require_once("db_connection.php");
 // pull over your POSTED inputs to use in the SQL query
 $email = $_POST["email"];
 $password = $_POST["password"];
 // create your query with the variables input
 $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
 // debugging -- comment out the echo statement once working
 // echo $query;
 $result = mysqli_query($connection, $query);
 $count = mysqli_num_rows($result);
 // debugging
// echo $count;
 // if the count in the database is not zero, there was a match found. You might want to check for the count being exactly 1
 if($count==0) {
 $message = "Invalid Username or Password. Please try again or contact your administrator.";
 } else {
 $row = mysqli_fetch_array($result);
 $message = "You are successfully authenticated!"; 
 $_SESSION["user_id"] = $row[user_id];
 $_SESSION["first_name"] = $row[first_name]; 
 $_SESSION["user_type"] = $row[user_type];
 
 /* Redirect browser to the admin page */ 
 header("Location: prospects/listprospects.php"); 
 exit();
 }
}
?><html>
<head>
<title>User Login</title>
<link rel="stylesheet" type="text/css" href="form_style.css" />
</head>
<body>
<form name="frmUser" method="post" action="login.php">
<div class="message"><?php if($message!="") { echo $message; } ?></div>
<h2>Enter Login Details</h2>
<p>Email: <input type="text" name="email"></p>
<p>Password: <input type="password" name="password"></p>
<p><input type="submit" name="submit" value="Submit"></p>
</form>
</body>
</html>