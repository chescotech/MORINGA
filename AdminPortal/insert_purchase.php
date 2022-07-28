<?php

session_start();
include('../dist/includes/dbcon.php');

$qty = $_POST['qty'];
$prod_id = $_POST['prod_id'];
$supplier_id = $_POST['supplier_id'];
$cost_price = $_POST['cost_price'];
 $currency = $_POST['currency'];

$quotes = mysqli_query($con, "SELECT MAX(identifier) AS quote_id FROM `purchase_orders` ")or die(mysqli_error($con));
$quoteRows = mysqli_fetch_array($quotes);
$quote_identity = $quoteRows['quote_id'] + 1;
$date = date('Y-m-d H:i:s');
$cost = 0;
$currn = "";
for ($i = 0; $i < count($qty); $i++) {

    //echo 'qty '.$qty[$i].' <br>'; 
    $quantity = $qty[$i];
    $product = $prod_id[$i];
    $cost = $cost_price[$i];
    $currn = $currency[$i];

    //echo 'cost '.$cost;
    //print_r($qty);

    mysqli_query($con, "INSERT INTO purchase_orders(prod_id,qty,cost_price,supplier,status,identifier,date_added,currency)
      VALUES('$product','$quantity','$cost','$supplier_id','open','$quote_identity','$date','$currn' )")or die(mysqli_error($con));

    //mysql_query("insert into purchase_orders values('$name[$i]','$age[$i]','$job[$i]')");
}

//echo "<script>document.location='purchase-order-print.php?identifier='" . $quote_identity . "</script>";

echo "<script>document.location='purchase-order-print.php?identifier=$quote_identity'</script>";

//echo 'qty ' . $qty . '<br>';
