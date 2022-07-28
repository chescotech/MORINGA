<?php

session_start();
$id = $_SESSION['id'];
include('../dist/includes/dbcon.php');

$tendered = $_POST['tendered'];
$order_no = $_POST['order_no'];
$payment_mode_id = $_POST['payment_mode_id'];

mysqli_query($con, "INSERT INTO part_payments_tb(amount,order_no,user_id,payment_mode_id) 
	VALUES('$tendered','$order_no','$id','$payment_mode_id')")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Record Added Successfully !!');</script>";
echo "<script>document.location='partial_payment_add.php?orderno=$order_no'</script>";
?>