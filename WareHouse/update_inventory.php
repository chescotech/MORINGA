<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$invname = $_POST['invname'];
$quantity = $_POST['quantity'];

mysqli_query($con, "update inventory_tb set name='$invname',quantity='$quantity' where id='$id'")or die(mysqli_error($con));
echo "<script type='text/javascript'>alert('Successfully updated details!');</script>";

echo "<script>document.location='inventory-list.php'</script>";
?>
