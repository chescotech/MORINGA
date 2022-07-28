<?php

session_start();
$id = $_SESSION['id'];
include('../dist/includes/dbcon.php');

$query = mysqli_query($con, "select * from stock_purchases_tb WHERE status='' ")or die(mysqli_error($con));
while ($row = mysqli_fetch_array($query)) {
    $purchase_id = $row['purchase_id'];
    $pid = $row['prod_id'];
    $qty = $row['qty'];
   
    mysqli_query($con, "UPDATE product SET prod_qty=prod_qty+'$qty' where prod_id='$pid'") or die(mysqli_error($con));
    
     mysqli_query($con, "UPDATE stock_purchases_tb SET status='purchased' WHERE purchase_id='$purchase_id'  ") or die(mysqli_error($con));
    
}

echo "<script type='text/javascript'>alert('Successfully Added Items!');</script>";

echo "<script>document.location='purchase-stock.php'</script>";
?>