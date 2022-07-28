<?php
include("../dist/includes/dbcon.php");
$id = $_REQUEST['id'];
$cid = $_POST['cid'];
$result=mysqli_query($con,"DELETE FROM stock_purchases_tb WHERE purchase_id ='$id'")
	or die(mysqli_error($con));
	
echo "<script>document.location='purchase-stock.php'</script>";  
?>