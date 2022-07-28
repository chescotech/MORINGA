<?php

session_start();
$id = $_SESSION['id'];
include('../dist/includes/dbcon.php');
$invoice = $_POST['invoice'];
$stock_branchid =  $_SESSION['transfer_to'];

$query = mysqli_query($con, "select * from stock_purchases_tb WHERE status='' ")or die(mysqli_error($con));

while ($row = mysqli_fetch_array($query)) {
    
    $purchase_id = $row['purchase_id'];
    $pid = $row['prod_id'];
    $qty = $row['qty'];
    $buy_price = $row['cost_price'];
    $sale_price = $row['sale_price'];
    
    mysqli_query($con, "UPDATE product SET prod_qty=prod_qty+'$qty', prod_sell_price='$sale_price',prod_price='$buy_price' where prod_id='$pid'  AND stock_branch_id='$stock_branchid'  ") or die(mysqli_error($con));
    
    mysqli_query($con, "UPDATE stock_purchases_tb SET status='purchased',invoice='$invoice' WHERE purchase_id='$purchase_id'  ") or die(mysqli_error($con));
    
    // insert into the batch details in the bath TB.. 
    
    mysqli_query($con, "INSERT INTO batches_tb(prod_id,qty,buy_price) VALUES('$pid','$qty','$buy_price')")or die(mysqli_error($con));
    
     //mysqli_query($con, "UPDATE stock_purchases_tb SET status='purchased',invoice='$invoice' WHERE purchase_id='$purchase_id'  ") or die(mysqli_error($con));
      
}

echo "<script type='text/javascript'>alert('Successfully Added Items!');</script>";

echo "<script>document.location='purchase-stock.php'</script>";

?>