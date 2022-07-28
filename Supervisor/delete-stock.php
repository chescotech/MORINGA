<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['prod_id'];

$productChecker = mysqli_query($con, "select * from product where prod_id='$id'")or die(mysqli_error($con));
$checkerResults = mysqli_fetch_array($productChecker);
$stock_branch_id = $checkerResults['stock_branch_id'];
$name = $checkerResults['prod_name'];

$queryStores = mysqli_query($con, "select * from stores_branch where id='$stock_branch_id'")or die(mysqli_error($con));
$storesRows = mysqli_fetch_array($queryStores);
$storeBranch = $storesRows['branch_name'];

mysqli_query($con, "INSERT INTO stock_audit_tb(prod_id,count,added_to,action)
			VALUES('$name','1','$storeBranch','Deleted')")or die(mysqli_error($con));

mysqli_query($con, "DELETE FROM product where prod_id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Deleted Item !');</script>";
echo "<script>document.location='product.php'</script>";
?>
