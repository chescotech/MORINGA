<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$qty = $_POST['qty'];
$cid = $_POST['cid'];

$priceTag = $_POST['price_tag'];

if ($priceTag != "none") {

    $productQuery = mysqli_query($con, "SELECT * FROM product WHERE prod_id IN (SELECT prod_id FROM quotation_tb WHERE quote_id='$id')")or die(mysqli_error($con));
    $Prices = mysqli_fetch_array($productQuery);
    $retailPrice = $Prices['prod_sell_price'];
    $wholesalePrice = $Prices['wholesale_price'];
    $discountPrice = $Prices['discount_price'];
    $special_price = $Prices['special_price'];

    if ($priceTag == "retail") {
        $price = $retailPrice;
    } else if ($priceTag == "wholesale") {
        $price = $wholesalePrice;
    } elseif ($priceTag == "special_price") {
        $price = $special_price;
    } else {
        $price = $discountPrice;
    }

    mysqli_query($con, "update quotation_tb set qty='$qty', price='$price',price_tag='$priceTag' where quote_id='$id'")or die(mysqli_error($con));
} else {
    mysqli_query($con, "update quotation_tb set qty='$qty',price_tag='$priceTag' where quote_id='$id'")or die(mysqli_error($con));
}


if (isset($_GET['type'])) {
    $quote_id = $_GET['quote_id'];
    echo "<script>document.location='edit-quotation.php?quote_id=$quote_id'</script>";
} else {
    echo "<script>document.location='quotation.php'</script>";
}
//echo "<script>document.location='quotation.php'</script>";
?>
