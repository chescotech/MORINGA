<?php

session_start();
$id = $_SESSION['id'];
include('../dist/includes/dbcon.php');

$invoice_no = $_POST['invoice_no'];

$checker = mysqli_query($con, "select * from sales WHERE invoice_no='$invoice_no' ")or die(mysqli_error($con));

if (mysqli_num_rows($checker) > 0) {
    echo "<script>document.location='credit-note.php?invoice=$invoice_no'</script>";

} else {
    echo "<script type='text/javascript'>alert('Error !! Invoice number  not found in records. !!!');</script>";
    echo "<script>document.location='input-invoiceno.php'</script>";
}
?>