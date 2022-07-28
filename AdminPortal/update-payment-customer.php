<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$amount = $_POST['amount'];

mysqli_query($con, "update customer set balance	=balance-'$amount' where cust_id='$id'")or die(mysqli_error($con));

mysqli_query($con, "INSERT INTO customer_payments(amount,customer_id) VALUES('$amount','$id')")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully updated customer details!');</script>";
echo "<script>document.location='customer.php'</script>";

?>
