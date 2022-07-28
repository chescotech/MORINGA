<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['payment_id'];
mysqli_query($con, "DELETE FROM supplier_payments_tb where payment_id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Deleted Record !!');</script>";
echo "<script>document.location='supplier_payments.php'</script>";
?>
