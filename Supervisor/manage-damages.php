<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['prod_id'];
$no_damages = $_POST['no_damages'];
$user_id = $_SESSION['id'];

$query2 = mysqli_query($con, "select * from stock_damages_tb WHERE prod_id='$id'")or die(mysqli_error($con));
$count = mysqli_num_rows($query2);

if ($count > 0) {
    $productQuery = mysqli_query($con, "select * FROM product WHERE prod_id='$id'")or die(mysqli_error($con));
    $row = mysqli_fetch_array($productQuery);
    $productCount = $row['prod_qty'];
    if ($no_damages <= $productCount) {
        mysqli_query($con, "update stock_damages_tb set no_damages=no_damages+'$no_damages' where prod_id='$id'")or die(mysqli_error($con));
        mysqli_query($con, "update product set prod_qty=prod_qty-'$no_damages' where prod_id='$id'")or die(mysqli_error($con));

        mysqli_query($con, "INSERT INTO damages_log_tb(prod_id,qty_damage,user_id)
			VALUES('$id','$no_damages','$user_id')")or die(mysqli_error($con));

        echo "<script type='text/javascript'>alert('Successfully Updated Record !!!');</script>";
        echo "<script>document.location='product.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error !!!, you can not have more damages than what is in Stock!!! '" . $productCount . " );</script>";
        echo "<script>document.location='product.php'</script>";
    }
} else {
    $productQuery = mysqli_query($con, "select * FROM product WHERE prod_id='$id'")or die(mysqli_error($con));
    $row = mysqli_fetch_array($productQuery);
    $productCount = $row['prod_qty'];
    if ($no_damages <= $productCount) {
        mysqli_query($con, "INSERT INTO stock_damages_tb(prod_id,no_damages)
			VALUES('$id','$no_damages')")or die(mysqli_error($con));
        mysqli_query($con, "update product set prod_qty=prod_qty-'$no_damages' where prod_id='$id'")or die(mysqli_error($con));
        
         mysqli_query($con, "INSERT INTO damages_log_tb(prod_id,qty_damage,user_id)
			VALUES('$id','$no_damages','$user_id')")or die(mysqli_error($con));
        
        echo "<script type='text/javascript'>alert('Successfully updated Damages !!!');</script>";
        echo "<script>document.location='product.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error !!!, you can not have more damages than what is in Stock!!! ' );</script>";
        echo "<script>document.location='product.php'</script>";
    }
}
?>
