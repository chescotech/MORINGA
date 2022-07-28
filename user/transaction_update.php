<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$qty = $_POST['qty'];
$cid = $_POST['cid'];

$price = $_POST['price'];


    
    mysqli_query($con, "update temp_trans set qty='$qty', price='$price' where temp_trans_id='$id'")or die(mysqli_error($con));



echo "<script>document.location='cash_transaction.php'</script>";
?>
