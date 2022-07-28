<?php

session_start();
$branch = $_SESSION['branch'];
include('../dist/includes/dbcon.php');

function checkQuantityInStockByProductId($con, $productId) {
    $query = mysqli_query($con, "SELECT * FROM product WHERE prod_id = '$productId'");
    $row = mysqli_fetch_array($query);
    $prod_qty = $row['prod_qty'];
    return $prod_qty;
}

$item_sold_id = $_POST['item_sold_id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

$added_by = $_SESSION['id'];

if ($quantity <= checkQuantityInStockByProductId($con, $item_sold_id)) {

    mysqli_query($con, "INSERT INTO sales_tb(item_sold_id,quantity,added_by,price)
			VALUES('$item_sold_id','$quantity','$added_by','$price')")or die(mysqli_error($con));

    mysqli_query($con, "UPDATE product SET prod_qty = prod_qty - " . $quantity . " WHERE prod_id='$item_sold_id' ")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Record Successfully Added !!');</script>";
    echo "<script>document.location='sold-items.php'</script>";
} else {
    echo "<script type='text/javascript'>alert(' Error , Not enough stock to sell that quantity !!');</script>";
    echo "<script>document.location='sold-items.php'</script>";
}
?>