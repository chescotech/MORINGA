<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['payment_id'];
$order_no =  $_POST['order_no'];
mysqli_query($con, "DELETE FROM part_payments_tb where payment_id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Deleted !!');</script>";
echo "<script>document.location='partial_payment_add.php?orderno=$order_no'</script>";
?>
