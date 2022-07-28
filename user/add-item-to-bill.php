<?php

session_start();
$id = $_SESSION['id'];
$branch = $_SESSION['branch'];

include('../dist/includes/dbcon.php');

// check if barcode has been used or not.. 

$user_id = $_SESSION['id'];
$qty = $_POST['qty'];
$name = $_POST['description'];
$price = $_POST['price'];

$query1 = mysqli_query($con, "select * from temp_trans where description='$name' and branch_id='$branch'")or die(mysqli_error($con));
$count = mysqli_num_rows($query1);

//$total = $price * $qty;

if ($count > 0) {
    mysqli_query($con, "update temp_trans set qty=qty+'$qty' where prod_id='$name' and branch_id='$branch'")or die(mysqli_error($con));
} else {
    mysqli_query($con, "INSERT INTO temp_trans(prod_id,qty,price,branch_id,user_id,description) VALUES('0','$qty','$price','$branch','$user_id','$name')")or die(mysqli_error($con));
}
echo "<script>document.location='cash_transaction'</script>";
?>