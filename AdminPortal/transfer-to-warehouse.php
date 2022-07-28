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
$warehouse_id = $_POST['warehouse_id'];

$query2 = mysqli_query($con, "select * from ware_house_tb where prod_name='$name' AND warehouse_id='$stock_branch_id'")or die(mysqli_error($con));
$count = mysqli_num_rows($query2);

if ($count > 0) {
    // update the inventory stock..

   // mysqli_query($con, "UPDATE product SET prod_qty=prod_qty + '$prod_qty' where prod_name='$name' AND stock_branch_id='$stock_branch_id' ")or die(mysqli_error($con));

    // Update the warehouse stock where it is going to...
    mysqli_query($con, "UPDATE ware_house_tb SET prod_qty=prod_qty-'$prod_qty' where prod_id='$ware_id' ")or die(mysqli_error($con));
    
    // Update the warehouse stock where it is coming from......
    mysqli_query($con, "UPDATE ware_house_tb SET prod_qty=prod_qty+'$prod_qty' where prod_name='$name' AND warehouse_id='$stock_branch_id' ")or die(mysqli_error($con));
   
    // update the stock transfers log.. 
    mysqli_query($con, "INSERT INTO stock_trasfers_tb(prod_id,qty,user_id,moved_to)
			VALUES('$ware_id','$prod_qty','$userid','$stock_branch_id')")or die(mysqli_error($con));
    
    
      mysqli_query($con, "INSERT INTO stock_audit_tb(prod_id,count,added_to,action)
			VALUES('$name','$prod_qty','Warehouse','Transfer')")or die(mysqli_error($con));

 //echo '1'.' - $ware_id'.$ware_id.' $name '.$name.' $warehouse_id '.$warehouse_id;
    echo "<script type='text/javascript'>alert('Product Updated Successfully!');</script>";
    echo "<script>document.location='ware-house-stock.php'</script>";
} else {

    // insert stock to the stock counts..

    mysqli_query($con, "INSERT INTO ware_house_tb(barcode,prod_name,prod_price,prod_desc,prod_pic,cat_id,supplier_id,branch_id,serial,prod_qty,belongs_to,prod_sell_price,stock_branch_id,warehouse_id)
			VALUES('$barcode','$name','$price','$desc','','$category','$supplier','$branch','$serial','$prod_qty','$belongs_to','$prod_sell_price','$stock_branch_id','$stock_branch_id')")or die(mysqli_error($con));

    // update the warehouse with the correct stock count.. 

    mysqli_query($con, "UPDATE ware_house_tb SET prod_qty=prod_qty-'$prod_qty' where prod_id='$ware_id' ")or die(mysqli_error($con));

    mysqli_query($con, "INSERT INTO stock_trasfers_tb(prod_id,qty,user_id,moved_to)
			VALUES('$ware_id','$prod_qty','$userid','$stock_branch_id')")or die(mysqli_error($con));
    
    mysqli_query($con, "INSERT INTO stock_audit_tb(prod_id,count,added_to,action)
			VALUES('$name','$prod_qty','Warehouse','Transfer')")or die(mysqli_error($con));
    
     //echo '2'.' - '.$stock_branch_id;

   echo "<script type='text/javascript'>alert('Successfully Transfered Product !!');</script>";
   echo "<script>document.location='ware-house-stock.php'</script>";
}
?><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

