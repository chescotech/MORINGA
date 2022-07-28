<?php

session_start();
$id = $_SESSION['id'];
include('../dist/includes/dbcon.php');

$prod_id = $_POST['prod_id'];
$qty = $_POST['qty'];
$reason = $_POST['reason'];

mysqli_query($con, "INSERT INTO  sale_reversals_tb(prod_id,qty,reason)
			VALUES('$prod_id','$qty','$reason')")or die(mysqli_error($con));


// update the stock count.. 

mysqli_query($con, "UPDATE product SET prod_qty=prod_qty-'$qty' WHERE prod_id='$prod_id'");


echo "<script type='text/javascript'>alert('Record Added Successfully !!!');</script>";
echo "<script>document.location='sales-returned.php'</script>";
?>