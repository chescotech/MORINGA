<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$qty = $_POST['qty'];
$cid = $_POST['cid'];

mysqli_query($con, "update stock_purchases_tb set qty='$qty' where purchase_id='$id'")or die(mysqli_error($con));

echo "<script>document.location='purchase-stock.php'</script>";
?>
