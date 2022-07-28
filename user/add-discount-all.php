<?php

include("../dist/includes/dbcon.php");
session_start();
//$cid = $_POST['cid'];

$amount = $_POST['amount'];
$discount_type = $_POST['discount_type'];
$user_id = $_SESSION['id'];
// update the data to show the discounts..

$itemChecker = mysqli_query($con, " select * from temp_trans WHERE user_id ='$user_id' ")or die(mysqli_error($con));

$itemRows = mysqli_fetch_array($itemChecker);

$price = $itemRows['price'];

if ($discount_type == "Percentage") {
    $result = mysqli_query($con, "UPDATE temp_trans SET amount='$amount', discount_type='$discount_type'  WHERE user_id ='$user_id'") or die(mysqli_error($con));
} else {

    while ($row = mysqli_fetch_array($itemChecker)) {
        
        $result = mysqli_query($con, "UPDATE temp_trans SET amount='$amount', discount_type='$discount_type'  WHERE user_id ='$user_id'") or die(mysqli_error($con));
    }
}

echo "<script>document.location='cash_transaction.php'</script>";
?>