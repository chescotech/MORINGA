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
$discount_price = $_POST['discount_price'];
$wholesale_price = $_POST['wholesale_price'];
$special_price = $_POST['special_price'];
$pack_size = $_POST['pack_size'];

if ($_POST['expire_date'] == "") {
    $expire_date = "";
} else {
    $date = explode('/', $_POST['expire_date']);

    $month = $date[0];
    $day = $date[1];
    $year = $date[2];

    $expire_date = $year . "-" . $month . "-" . $day;
}

if ($_POST['manufactor_date'] == "") {
    $manufactor_date = "";
} else {

    $date2 = explode('/', $_POST['manufactor_date']);

    $month2 = $date2[0];
    $day2 = $date2[1];
    $year2 = $date2[2];

    $manufactor_date = $year2 . "-" . $month2 . "-" . $day2;
}

//$manufactor_date = $_POST['manufactor_date'];

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



    mysqli_query($con, "INSERT INTO product(expire_date,manufactor_date,barcode,prod_name,prod_price,prod_desc,prod_pic,cat_id,
        reorder,supplier_id,branch_id,serial,prod_qty,belongs_to,prod_sell_price,stock_branch_id,wholesale_price,discount_price,special_price,pack_size)
			VALUES('$expire_date','$manufactor_date','$barcode_scanned','$name','$price','$desc','$pic','$category',"
            . "'$reorder','$supplier','$branch','$serial','$prod_qty','$belongs_to','$prod_sell_price','$stock_branch_id',"
            . "'$wholesale_price','$discount_price','$special_price','$pack_size')")or die(mysqli_error($con));

    // get the store branch..

    $queryStores = mysqli_query($con, "select * from stores_branch where id='$stock_branch_id'")or die(mysqli_error($con));
    $storesRows = mysqli_fetch_array($queryStores);
    $storeBranch = $storesRows['branch_name'];

    mysqli_query($con, "INSERT INTO stock_audit_tb(prod_id,count,added_to,action)
			VALUES('$name','$prod_qty','$storeBranch','Added')")or die(mysqli_error($con));

    echo "<script type='text/javascript'>alert('Successfully added new product!');</script>";
    echo "<script>document.location='product.php'</script>";
}
?>