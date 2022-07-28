<?php

session_start();
include('../dist/includes/dbcon.php');
$branch_id = $_POST['belongs_to'];
$prod_id = $_POST['prod_id'];
$quantity = $_POST['quantity'];
$branch = $_SESSION['branch'];

$name = $_POST['prod_name'];
$price = $_POST['prod_price'];
$desc = $_POST['prod_desc'];
$supplier = $_POST['supplier'];
$reorder = "Non";
$category = $_POST['category'];
$serial = "Non";
//$prod_qty = $_POST['prod_qty'];
$belongs_to = $_POST['belongs_to'];
$prod_sell_price = $_POST['prod_sell_price'];
$stock_branch_id = $branch_id;
$ware_id = $_POST['ware_id'];
$userid = $_SESSION['id'];
$barcode = $_POST['barcode'];
$prod_qty = $quantity;
$transfer_to = $_POST['transfer_to'];

$query2 = mysqli_query($con, "select * from product where prod_name='$name' AND stock_branch_id='$transfer_to'") or die(mysqli_error($con));
$count = mysqli_num_rows($query2);

// get the details of the store where the stock is going to...

$query_store = mysqli_query($con, "SELECT * FROM stores_branch where id ='$transfer_to' ") or die(mysqli_error($con));
$store_rows = mysqli_fetch_array($query_store);
$branch_name = $store_rows['branch_name'];

if ($count > 0) {
    // update the inventory stock..

    mysqli_query($con, "UPDATE product SET prod_qty=prod_qty + '$prod_qty' where prod_name='$name' AND stock_branch_id='$transfer_to' ") or die(mysqli_error($con));

    // Update the warehouse stock..

    mysqli_query($con, "UPDATE product SET prod_qty=prod_qty-'$prod_qty' where prod_id='$ware_id' ") or die(mysqli_error($con));

    // update the stock transfers log.. 

    mysqli_query($con, "INSERT INTO stock_trasfers_tb(prod_id,qty,user_id,moved_to)
			VALUES('$ware_id','$prod_qty','$userid','$transfer_to')") or die(mysqli_error($con));

    mysqli_query($con, "INSERT INTO stock_audit_tb(prod_id,count,added_to,action)
    VALUES('$name','$prod_qty','$branch_name','Transfer')") or die(mysqli_error($con));

    //echo 'branch'.$branch_name;

    echo "<script type='text/javascript'>alert('Product Updated Successfully!');</script>";
    echo "<script>document.location='product.php'</script>";
} else {

    // insert stock to the stock counts..

    mysqli_query($con, "INSERT INTO product(barcode,prod_name,prod_price,prod_desc,cat_id,supplier_id,branch_id,serial,prod_qty,belongs_to,prod_sell_price,stock_branch_id,currency_id,vat_status)
			VALUES('$barcode','$name','$price','$desc','$category','$supplier','$branch','$serial','$prod_qty','$belongs_to','$prod_sell_price','$transfer_to','2','inclusive' )") or die(mysqli_error($con));

    // update the warehouse with the correct stock count.. 

    mysqli_query($con, "UPDATE product SET prod_qty=prod_qty-'$prod_qty' where prod_id='$ware_id' ") or die(mysqli_error($con));

    mysqli_query($con, "INSERT INTO stock_trasfers_tb(prod_id,qty,user_id,moved_to)
			VALUES('$ware_id','$prod_qty','$userid','$stock_branch_id')") or die(mysqli_error($con));

    mysqli_query($con, "INSERT INTO stock_audit_tb(prod_id,count,added_to,action)
			VALUES('$name','$prod_qty','$branch_name ','Transfer')") or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Successfully Transfered Product !!');</script>";
    echo "<script>document.location='product.php'</script>";
}
