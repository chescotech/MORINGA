<?php

session_start();
$id = $_SESSION['id'];
include('../dist/includes/dbcon.php');

$order_no = $_POST['order_no'];

$checker = mysqli_query($con, "select * from sales WHERE invoice_no='$order_no' ")or die(mysqli_error($con));
$row = mysqli_fetch_array($checker);
$salesid = $row['sales_id']; 
if (mysqli_num_rows($checker) > 0) {
    echo "<script>document.location='manage-order-reversal.php?order_no=$salesid&invoice=$order_no'</script>";
} else {
    echo "<script type='text/javascript'>alert('Error !! Order number  not found in records. !!!');</script>";
    echo "<script>document.location='input-reversal.php'</script>";
}
?>