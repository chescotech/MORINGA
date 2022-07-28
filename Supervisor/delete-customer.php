<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['cust_id'];
mysqli_query($con, "DELETE FROM customer where cust_id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Deleted !!');</script>";
echo "<script>document.location='customer.php'</script>";
?>
