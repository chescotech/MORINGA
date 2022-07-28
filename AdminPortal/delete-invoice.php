<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['sales_id'];
/*
$order_no = $_POST['order_no'];
$qty_before = $_POST['qty_before'];
$previousProdId = $_POST['prod_id'];
*/
mysqli_query($con, "DELETE FROM sales_details where sales_id='$id'")or die(mysqli_error($con));
mysqli_query($con, "DELETE FROM sales where sales_id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Deleted Item !');</script>";
echo "<script>document.location='customer-invoices'</script>";
?>
