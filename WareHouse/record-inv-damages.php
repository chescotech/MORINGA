<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$quantity = $_POST['quantity'];

$query2 = mysqli_query($con, "select * from inv_damages_tb where inv_id='$id'")or die(mysqli_error($con));
$count = mysqli_num_rows($query2);

if ($count > 0) {
    mysqli_query($con, "update inv_damages_tb set quantity=quantity+'$quantity' where inv_id='$id'")or die(mysqli_error($con));
    mysqli_query($con, "update inventory_tb set quantity=quantity-'$quantity' where id='$id'")or die(mysqli_error($con));
    echo "<script type='text/javascript'>alert('Successfully Added!');</script>";
    echo "<script>document.location='inventory-list.php'</script>";
} else {
    mysqli_query($con, "INSERT INTO inv_damages_tb(inv_id,quantity) 
				VALUES('$id','$quantity')")or die(mysqli_error($con));

    mysqli_query($con, "update inventory_tb set quantity=quantity-'$quantity' where id='$id'")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Successfully Added!');</script>";
    echo "<script>document.location='inventory-list.php'</script>";
}
?>
