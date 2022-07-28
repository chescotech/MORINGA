<?php

session_start();
include('../dist/includes/dbcon.php');

$branch = $_SESSION['branch'];
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$added_by = $_SESSION['id'];

$query2 = mysqli_query($con, "select * from inventory_tb where name='$name'")or die(mysqli_error($con));
$count = mysqli_num_rows($query2);

if ($count > 0) {
    echo "<script type='text/javascript'>alert('Record already exist!');</script>";
    echo "<script>document.location='inventory-list.php'</script>";
} else {

    mysqli_query($con, "INSERT INTO inventory_tb(name,quantity,added_by) 
				VALUES('$name','$quantity','$added_by')")or die(mysqli_error($con));
    $id = mysqli_insert_id($con);
   
    echo "<script type='text/javascript'>alert('Successfully added Record!');</script>";
    echo "<script>document.location='inventory-list.php'</script>";
}
?>