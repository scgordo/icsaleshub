<?php
	define("DB_SERVER", "localhost");
	define("DB_USER", "icsale5_sgordon");
	define("DB_PASS", "dskn44");
	define("DB_NAME", "icsale5_ic_external_sales");

  // 1. Create a database connection
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>
