<?php

session_start();
$id = $_SESSION['id'];
$branch = $_SESSION['branch'];

include('../dist/includes/dbcon.php');

$cid = $_POST['cid'];
$name = $_POST['prod_name'];
$qty = $_POST['qty'];
$orderNo = $_POST['order_no'];
$user_id = $_SESSION['id'];
$customer_name = $_POST['customer_name'];

$qtyChecker = mysqli_query($con, "select prod_qty,prod_name from product WHERE prod_id='$name'")or die(mysqli_error($con));
$qtyRows = mysqli_fetch_array($qtyChecker);
$noQtyInStock = $qtyRows['prod_qty'];
$prodName = $qtyRows['prod_name'];

if ($qty <= $noQtyInStock) {
    $query = mysqli_query($con, "select prod_sell_price,prod_id from product where prod_id='$name'")or die(mysqli_error($con));
    $row = mysqli_fetch_array($query);
    $price = $row['prod_sell_price'];

    $query1 = mysqli_query($con, "select * from draft_temp_trans where prod_id='$name' and branch_id='$branch' AND order_no='$orderNo' ")or die(mysqli_error($con));
    $count = mysqli_num_rows($query1);

    $total = $price * $qty;

    $draft_rows = mysqli_fetch_array($query1);
    $price = $draft_rows['temp_trans_id'];

    if ($count > 0) {
        mysqli_query($con, " UPDATE  draft_temp_trans SET qty=qty+'$qty' WHERE prod_id='$name'  ")or die(mysqli_error($con));

        // update the new sales..

    } else {

        mysqli_query($con, "INSERT INTO draft_temp_trans(prod_id,qty,price,branch_id,order_no,user_id,customer_name)"
                        . " VALUES('$name','$qty','$price','$branch','$orderNo','$user_id','$customer_name')")or die(mysqli_error($con));
  
        /*
        mysqli_query($con, "INSERT INTO draft_temp_trans(prod_id,qty,price,branch_id,order_no,user_id,customer_name)"
                        . " VALUES('$name','$qty','$price','$branch','$orderNo','$user_id','$customer_name')")or die(mysqli_error($con));
                        */
    }
    echo "<script>document.location='update-order-draft.php?orderno=$orderNo'</script>";
} else {
    echo "<script type='text/javascript'>alert('Error !!, you cannot sell " . $qty . " items of " . $prodName . " because it is more than what is in stock !!! ');</script>";
    echo "<script>document.location='update-order-draft.php?orderno=$orderNo'</script>";
}
?>