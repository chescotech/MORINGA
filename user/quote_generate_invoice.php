<?php

error_reporting(0);
session_start();

include('../dist/includes/dbcon.php');

// echo "<scr   ipt>document.location='cash_transaction'</scr>";

$quote_id = $_GET['quote_id'];
$id = $_SESSION['id'];
// check if there is anything in the temp table for the user...

$query_checker = mysqli_query($con, "SELECT * FROM `temp_trans` WHERE user_id='$id'") or die(mysqli_error($con));
if (mysqli_num_rows($query_checker) > 0) {
    mysqli_query($con, "DELETE FROM `temp_trans` WHERE user_id='$id'") or die(mysqli_error($con));
}

$query1 = mysqli_query($con, "SELECT * from temp_trans WHERE quote_id='$quote_id'") or die(mysqli_error($con));
if (mysqli_num_rows($query1) > 0) {
    echo "<script>document.location='cash_transaction'</script>";
} else {
    $query = mysqli_query($con, "SELECT * from quotation_tb WHERE quote_id='$quote_id'") or die(mysqli_error($con));

    while ($row = mysqli_fetch_array($query)) {
        $branch = $_SESSION['branch'];
        $user_id = $_SESSION['id'];

        $prod_id = $row['prod_id'];
        $qty = $row['qty'];
        $price = $row['price'];
        $description = $row['description'];

        if ($row['discount'] != "") {
            
            $discount = $row['discount'];
            $discount_type = "Percentage";
            
            mysqli_query($con, "INSERT INTO temp_trans(prod_id,qty,price,amount,discount_type,branch_id,user_id,quote_id,description) 
            VALUES('$prod_id','$qty','$price','$discount','$discount_type','$branch','$user_id','$quote_id','$description')") or die(mysqli_error($con));
        } else {
            mysqli_query($con, "INSERT INTO temp_trans(prod_id,qty,price,branch_id,user_id,quote_id,description) 
            VALUES('$prod_id','$qty','$price','$branch','$user_id','$quote_id','$description')") or die(mysqli_error($con));
        }
    }
    if ($query) {
        echo "<script>document.location='cash_transaction'</script>";
    }
}
