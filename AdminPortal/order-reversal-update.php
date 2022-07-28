<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');

endif;

include('../dist/includes/dbcon.php');

$qty = $_POST['qty'];
$prod_id = $_POST['prod_id'];
$sales_details_id = $_POST['sales_details_id'];
$order_no = $_POST['order_number'];
$qty_before = $_POST['qty_before'];

$checker = mysqli_query($con, "SELECT * FROM product WHERE prod_id='$prod_id'")or die(mysqli_error($con));
$rows = mysqli_fetch_array($checker);
$productPrice = $rows['prod_sell_price'];

// check if we are editing the same product.. 
$checker2 = mysqli_query($con, "SELECT * FROM sales_details WHERE sales_details_id='$sales_details_id'")or die(mysqli_error($con));
$rows2 = mysqli_fetch_array($checker2);
$previousProdId = $rows2['prod_id'];

if ($previousProdId != $prod_id){

    mysqli_query($con, "update product set prod_qty=prod_qty+'$qty_before' where prod_id='$previousProdId'")or die(mysqli_error($con));
   
    mysqli_query($con, "update sales_details set qty='$qty',price='$productPrice', prod_id='$prod_id' where sales_details_id='$sales_details_id'")or die(mysqli_error($con));

    mysqli_query($con, "update product set prod_qty=prod_qty-'$qty' where prod_id='$prod_id'")or die(mysqli_error($con));
    
    echo "<script type='text/javascript'>alert('Successfully Updated details !!');</script>";
    echo "<script>document.location='manage-order-reversal.php?order_no=$order_no'</script>";
    
}else{
    if ($qty_before < $qty){
        $qtyToUpdate = $qty - $qty_before;

        mysqli_query($con, "update product set prod_qty=prod_qty-'$qtyToUpdate' where prod_id='$prod_id'")or die(mysqli_error($con));
        mysqli_query($con, "update sales_details set qty='$qty',price='$productPrice', prod_id='$prod_id' where sales_details_id='$sales_details_id'")or die(mysqli_error($con));

        echo "<script type='text/javascript'>alert('Successfully Updated details !!');</script>";
        echo "<script>document.location='manage-order-reversal.php?order_no=$order_no'</script>";
    }else{
        $qtyToUpdate = $qty_before - $qty;

        mysqli_query($con, "update product set prod_qty=prod_qty+'$qtyToUpdate' where prod_id='$prod_id'")or die(mysqli_error($con));
        mysqli_query($con, "update sales_details set qty='$qty',price='$productPrice', prod_id='$prod_id' where sales_details_id='$sales_details_id'")or die(mysqli_error($con));

        echo "<script type='text/javascript'>alert('Successfully Updated details !!');</script>";
        echo "<script>document.location='manage-order-reversal.php?order_no=$order_no'</script>";
    }
}
?>
