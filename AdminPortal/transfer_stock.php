<?php

session_start();
$branch = $_SESSION['branch'];
include('../dist/includes/dbcon.php');

$name = $_POST['prod_name'];
$price = $_POST['prod_price'];
$desc = $_POST['prod_desc'];
$supplier = $_POST['supplier'];
$reorder = "Non";
$category = $_POST['category'];
$serial = "Non";
$prod_qty = $_POST['prod_qty'];
$belongs_to = $_POST['belongs_to'];
$prod_sell_price = $_POST['prod_sell_price'];
$stock_branch_id = $_POST['stock_branch_id'];
$ware_id = $_POST['ware_id'];
$userid = $_SESSION['id'];
$barcode = $_POST['barcode'];

$discount_price = $_POST['discount_price'];
$wholesale_price = $_POST['wholesale_price'];
$special_price = $_POST['special_price'];

$query2 = mysqli_query($con, "select * from product where prod_name='$name' and branch_id='$branch' AND stock_branch_id='$stock_branch_id'")or die(mysqli_error($con));
$count = mysqli_num_rows($query2);

if ($count > 0) {
    // update the inventory stock..

    mysqli_query($con, "UPDATE product SET prod_qty=prod_qty + '$prod_qty' where prod_name='$name' AND stock_branch_id='$stock_branch_id' ")or die(mysqli_error($con));

    // Update the warehouse stock..

    mysqli_query($con, "UPDATE ware_house_tb SET prod_qty=prod_qty-'$prod_qty' where prod_id='$ware_id' ")or die(mysqli_error($con));

    // update the stock transfers log.. 

    mysqli_query($con, "INSERT INTO stock_trasfers_tb(prod_id,qty,user_id,moved_to)
			VALUES('$ware_id','$prod_qty','$userid','$stock_branch_id')")or die(mysqli_error($con));


    echo "<script type='text/javascript'>alert('Product Updated Successfully!');</script>";
    echo "<script>document.location='ware-house-stock.php'</script>";
} else {

    $pic = $_FILES["image"]["name"];
    if ($pic == "") {
        $pic = "default.gif";
    } else {
        $pic = $_FILES["image"]["name"];
        $type = $_FILES["image"]["type"];
        $size = $_FILES["image"]["size"];
        $temp = $_FILES["image"]["tmp_name"];
        $error = $_FILES["image"]["error"];

        if ($error > 0) {
            die("Error uploading file! Code $error.");
        } else {
            if ($size > 100000000000) { //conditions for the file
                die("Format is not allowed or file size is too big!");
            } else {
                move_uploaded_file($temp, "../dist/uploads/" . $pic);
            }
        }
    }

    // insert stock to the stock counts..

    mysqli_query($con, "INSERT INTO product(barcode,prod_name,prod_price,prod_desc,prod_pic,cat_id,reorder,supplier_id,branch_id,serial,prod_qty,belongs_to,prod_sell_price,stock_branch_id,wholesale_price,discount_price,special_price)
			VALUES('$barcode','$name','$price','$desc','$pic','$category','$reorder','$supplier','$branch','$serial','$prod_qty','$belongs_to','$prod_sell_price','$stock_branch_id','$wholesale_price','$discount_price','$special_price')")or die(mysqli_error($con));

    // update the warehouse with the correct stock count.. 

    echo 'whole sale'.$discount_price;
    mysqli_query($con, "UPDATE ware_house_tb SET prod_qty=prod_qty-'$prod_qty' where prod_id='$ware_id' ")or die(mysqli_error($con));

    mysqli_query($con, "INSERT INTO stock_trasfers_tb(prod_id,qty,user_id,moved_to)
			VALUES('$ware_id','$prod_qty','$userid','$stock_branch_id')")or die(mysqli_error($con));
    
    mysqli_query($con, "INSERT INTO stock_audit_tb(prod_id,count,added_to,action)
			VALUES('$name','$prod_qty','Warehouse','Transfer')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Successfully Transfered Product !!');</script>";
    echo "<script>document.location='ware-house-stock.php'</script>";
}
?>