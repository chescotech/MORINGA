<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['id'];
$name = $_POST['prod_name'];
$supplier = $_POST['supplier'];
$price = $_POST['prod_price'];
$prod_qty = $_POST['prod_qty'];
$category = $_POST['category'];
$serial = "0";
$desc = $_POST['desc'];
$belongs_to = $_POST['belongs_to'];
$prod_sell_price = $_POST['prod_sell_price'];
$discount_price = $_POST['discount_price'];
$wholesale_price = $_POST['wholesale_price'];
$special_price = $_POST['special_price'];

$pic = $_FILES["image"]["name"];
if ($pic == "") {
    if ($_POST['image1'] <> "") {
        $pic = $_POST['image1'];
    } else
        $pic = "default.gif";
}
else {
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

mysqli_query($con, "update product set prod_name='$name',prod_price='$price',
	prod_qty ='$prod_qty',supplier_id='$supplier',cat_id='$category',"
                . "prod_pic='$pic',serial='$serial',prod_desc='$desc',belongs_to ='$belongs_to',stock_branch_id='$belongs_to',"
        . " prod_sell_price='$prod_sell_price', wholesale_price='$wholesale_price',discount_price='$discount_price', special_price='$special_price'  where prod_id='$id'")or die(mysqli_error($con));

// check the stock branch ID.. 

$productChecker = mysqli_query($con, "select * from product where prod_id='$id'")or die(mysqli_error($con));
$checkerResults = mysqli_fetch_array($productChecker);
$stock_branch_id = $checkerResults['stock_branch_id'];

$queryStores = mysqli_query($con, "select * from stores_branch where id='$stock_branch_id'")or die(mysqli_error($con));
$storesRows = mysqli_fetch_array($queryStores);
$storeBranch = $storesRows['branch_name'];

mysqli_query($con, "INSERT INTO stock_audit_tb(prod_id,count,added_to,action)
			VALUES('$name','$prod_qty','$storeBranch','Edited')")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully updated product details!');</script>";
echo "<script>document.location='product.php'</script>";

?>
