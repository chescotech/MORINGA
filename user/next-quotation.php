<?php
include("../dist/includes/dbcon.php");

$result=mysqli_query($con,"DELETE FROM quotation_tb")
	or die(mysqli_error($con));
	
echo "<script>document.location='quotation.php'</script>";  
?>