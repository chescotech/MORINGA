<?php

session_start();
$branch = $_SESSION['branch'];
include('../dist/includes/dbcon.php');

$class = $_POST['class'];
$description = $_POST['description'];

$colour = $_POST['colour'];
$origin = $_POST['origin'];
$category = $_POST['category'];
$qty = $_POST['qty'];

//$manufactor_date = $_POST['manufactor_date'];

$query2 = mysqli_query($con, "select * from rawdata_tb where description='$description' AND type='RAW' ")or die(mysqli_error($con));
$count = mysqli_num_rows($query2);

if ($count > 0) {
    echo "<script type='text/javascript'>alert('Product already exist!');</script>";
    echo "<script>document.location='product.php'</script>";
} else {

    mysqli_query($con, "INSERT INTO rawdata_tb(class,description,colour,category_id,origin,qty,type )
			VALUES('$class','$description','$colour','$category','$origin','$qty','RAW')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Successfully added new product!');</script>";
    echo "<script>document.location='raw-data.php'</script>";
}
?>