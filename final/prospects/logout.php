<?php
session_start();
session_destroy();
header("Location: http://www.collegewebserver.com/~sgordon/final/login.php");
?>