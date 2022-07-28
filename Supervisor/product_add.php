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
$barcode_scanned = $_POST['barcode_scanned'];

$query2 = mysqli_query($con, "select * from product where prod_name='$name' and branch_id='$branch'")or die(mysqli_error($con));
$count = mysqli_num_rows($query2);

if ($count > 0) {
    echo "<script type='text/javascript'>alert('Product already exist!');</script>";
    echo "<script>document.location='product.php'</script>";
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



    mysqli_query($con, "INSERT INTO product(barcode,prod_name,prod_price,prod_desc,prod_pic,cat_id,reorder,supplier_id,branch_id,serial,prod_qty,belongs_to,prod_sell_price,stock_branch_id)
			VALUES('$barcode_scanned','$name','$price','$desc','$pic','$category','$reorder','$supplier','$branch','$serial','$prod_qty','$belongs_to','$prod_sell_price','$stock_branch_id')")or die(mysqli_error($con));

    // get the store branch..

    $queryStores =  mysqli_query($con, "select * from stores_branch where id='$stock_branch_id'")or die(mysqli_error($con));   
    $storesRows = mysqli_fetch_array($queryStores);
    $storeBranch = $storesRows['branch_name'];
  
    mysqli_query($con, "INSERT INTO stock_audit_tb(prod_id,count,added_to,action)
			VALUES('$name','$prod_qty','$storeBranch','Added')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Successfully added new product!');</script>";
    echo "<script>document.location='product.php'</script>";
    
}
?>