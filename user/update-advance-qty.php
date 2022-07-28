<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$qty = $_POST['qty'];
$cid = $_POST['cid'];
$prodId = $_POST['prod_id'];
$user_id = $_SESSION['id'];
$branch = $_SESSION['branch'];

$query = mysqli_query($con, "select prod_sell_price,prod_id,prod_name from product where prod_id='$prodId'")or die(mysqli_error($con));
$row = mysqli_fetch_array($query);
$price = $row['prod_sell_price'];
$name = $row['prod_name'];

//mysqli_query($con, "update draft_temp_trans set qty='$qty' where temp_trans_id='$id' AND order_no='0'")or die(mysqli_error($con));

$query2 = mysqli_query($con, "select * FROM advance_payments_tb where prod_id='$prodId'")or die(mysqli_error($con));
if(mysqli_num_rows($query2)>0){
   mysqli_query($con, "update advance_payments_tb set qty='$qty' where advace_id='$id' AND order_no='0'")or die(mysqli_error($con));
}else{
    mysqli_query($con, "INSERT INTO advance_payments_tb(prod_id,qty,price,branch_id,user_id) VALUES('$name','$qty','$price','$branch','$user_id')")or die(mysqli_error($con));

}


echo "<script>document.location='advance-sale.php'</script>";
?>
