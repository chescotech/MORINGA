<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$qty = $_POST['qty'];
$cid = $_POST['cid'];
$user_id = $_SESSION['id'];
$branch = $_SESSION['branch'];


$price = $_POST['price'];


mysqli_query($con, "update draft_temp_trans set qty='$qty',price='$price' where temp_trans_id='$id' AND order_no='0'")or die(mysqli_error($con));

//mysqli_query($con, "INSERT INTO draft_temp_trans(prod_id,qty,price,branch_id,user_id) VALUES('$name','$qty','$price','$branch','$user_id')")or die(mysqli_error($con));

echo "<script>document.location='draft-order.php'</script>";
?>
