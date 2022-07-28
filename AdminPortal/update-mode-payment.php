<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$name = $_POST['name'];

mysqli_query($con, "update modes_of_payment_tb set name='$name' where payment_mode_id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully updated Record !!');</script>";
echo "<script>document.location='modes-of-payment.php'</script>";
?>
