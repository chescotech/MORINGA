<?php
include("../dist/includes/dbcon.php");
$id = $_REQUEST['id'];
$cid = $_POST['cid'];
$result=mysqli_query($con,"DELETE FROM rawdata_updates_tb WHERE id ='$id'")
	or die(mysqli_error($con));
	
echo "<script>document.location='update-warehouse-stock.php'</script>";  
?>