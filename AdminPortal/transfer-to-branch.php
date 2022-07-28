<?php
include('../dist/includes/dbcon.php');
session_start();

$branch_id = $_POST['branch_id'];
$prod_id = $_POST['prod_id'];
$prod_name = $_POST['prod_name'];
$quantity = $_POST['quantity'];
$from = $_POST['from'];
$userid = $_SESSION['id'];

mysqli_query($con, "update product set prod_qty =prod_qty-'$quantity' where prod_id='$prod_id'")or die(mysqli_error($con));

mysqli_query($con, "INSERT INTO transfer_branch(from_store,to_store,user_id,qty,product)
			VALUES('$from','$branch_id','$userid','$quantity','$prod_name')")or die(mysqli_error($con));

  echo "<script type='text/javascript'>alert('Product Updated Moved!');</script>";
    echo "<script>document.location='product.php'</script>";

