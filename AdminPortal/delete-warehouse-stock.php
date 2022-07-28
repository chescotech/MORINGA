<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['prod_id'];

$productChecker = mysqli_query($con, "select * from ware_house_tb where prod_id='$id'")or die(mysqli_error($con));
$checkerResults = mysqli_fetch_array($productChecker);
$name = $checkerResults['prod_name'];

mysqli_query($con, "INSERT INTO stock_audit_tb(prod_id,count,added_to,action)
			VALUES('$name','1','Warehouse','Deleted')")or die(mysqli_error($con));

mysqli_query($con, "DELETE FROM ware_house_tb where prod_id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Deleted Item !');</script>";
echo "<script>document.location='ware-house-stock.php'</script>";
?>
