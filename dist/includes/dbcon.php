<?php
 //$con = mysqli_connect("localhost","root","","chescote_accounting_db");
 
  $con = mysqli_connect("localhost","root","","chescote_moringa_db");
  
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  date_default_timezone_set("Africa/Lusaka"); 
?>

