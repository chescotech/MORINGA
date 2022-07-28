<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['payment_mode_id'];
mysqli_query($con, "DELETE FROM modes_of_payment_tb where payment_mode_id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Deleted Record !!');</script>";
echo "<script>document.location='modes-of-payment.php'</script>";
?>
