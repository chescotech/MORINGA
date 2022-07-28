<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['prod_id'];
$discount_price = $_POST['discount_price'];
$prod_sell_price = $_POST['prod_sell_price'];

$date = explode('-', $_POST['date']);
$branch = $_SESSION['branch'];
$start = date("Y-m-d", strtotime($date[0]));
$startDate = $start . " 00:00:00";
$end = date("Y-m-d", strtotime($date[1]));
$endDate = $end . " 00:00:00";
$status = $_POST['status'];

$query2 = mysqli_query($con, "select * from discount_tb where prod_id='$id'")or die(mysqli_error($con));
$count = mysqli_num_rows($query2);

if ($count > 0) {
    if ($_POST['date'] == ""){
        if ($status != 'active'){
            $row1 = mysqli_fetch_array($query2);
            $previousPrice = $row1['price_before_disc'];
            mysqli_query($con, "update product set prod_sell_price='$previousPrice'  where prod_id='$id'")or die(mysqli_error($con));
        }
        mysqli_query($con, "update discount_tb set discount_price='$discount_price',price_before_disc='$prod_sell_price',status='$status' where prod_id='$id'")or die(mysqli_error($con));
    } else {
        mysqli_query($con, "update discount_tb set discount_price='$discount_price',discount_from='$startDate',discount_to='$endDate',price_before_disc='$prod_sell_price',status='$status' where prod_id='$id'")or die(mysqli_error($con));
    }

    echo "<script type='text/javascript'>alert('Successfully Updated Discount !!!');</script>";
    echo "<script>document.location='product.php'</script>";
} else {

    mysqli_query($con, "INSERT INTO discount_tb(prod_id,discount_price,discount_from,discount_to,price_before_disc,status)
			VALUES('$id','$discount_price','$startDate','$endDate','$prod_sell_price','$status')")or die(mysqli_error($con));


    echo "<script type='text/javascript'>alert('Successfully updated Discount !!!');</script>";
    echo "<script>document.location='product.php'</script>";
}
?>
