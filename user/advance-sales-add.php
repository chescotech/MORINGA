<?php

session_start();
$id = $_SESSION['id'];
include('../dist/includes/dbcon.php');

$customer_name = $_POST['customer_name'];
$orderNumber = (rand(50, 5000));
$amount = $_POST['amount'];
// update the inventory draft sales record ... 

mysqli_query($con, "UPDATE advance_payments_tb SET order_no='$orderNumber',customer_name='$customer_name',amount='$amount' where order_no='0'") or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Record Saved Successfully !!..');</script>";
echo "<script>document.location='advance-sale.php'</script>";

?>