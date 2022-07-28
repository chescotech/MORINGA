<?php

session_start();
$id = $_SESSION['id'];
$branch = $_SESSION['branch'];

include('../dist/includes/dbcon.php');

$cid = $_POST['cid'];
$name = $_POST['prod_name'];
$qty = $_POST['qty'];
$supplier_id = $_POST['supplier_id'];


$query = mysqli_query($con, "select prod_price,prod_id from product where prod_id='$name'")or die(mysqli_error($con));
$row = mysqli_fetch_array($query);
$price = $row['prod_price'];

$query1 = mysqli_query($con, "select * from stock_purchases_tb where prod_id='$name' ")or die(mysqli_error($con));
$count = mysqli_num_rows($query1);

$total = $price * $qty;

if ($count > 0) {
    mysqli_query($con, "update stock_purchases_tb set qty=qty+'$qty',status='' where prod_id='$name'")or die(mysqli_error($con));
} else {
    mysqli_query($con, "INSERT INTO stock_purchases_tb(prod_id,qty,supplier_id) VALUES('$name','$qty','$supplier_id')")or die(mysqli_error($con));
}

echo "<script>document.location='purchase-stock.php'</script>";
?>