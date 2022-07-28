<?php

session_start();
$id = $_SESSION['id'];
$branch = $_SESSION['branch'];

include('../dist/includes/dbcon.php');

$cid = $_POST['cid'];
$name = $_POST['prod_name'];
$qty = $_POST['qty'];
$job = $_POST['job'];
$source = $_POST['source'];

$user_id = $_SESSION['id'];

$qtyChecker = mysqli_query($con, "select * FROM rawdata_updates_tb WHERE item_id='$name' AND action_status='' ")or die(mysqli_error($con));
$qtyRows = mysqli_fetch_array($qtyChecker);
$count = mysqli_num_rows($qtyChecker);

if (isset($_POST['in'])) {
   
        mysqli_query($con, "INSERT INTO rawdata_updates_tb(user_id,status,item_id,value, job,source) "
                        . "VALUES('$user_id','IN','$name','$qty','$job','$source')")or die(mysqli_error($con));
    
} else {
   
        mysqli_query($con, "INSERT INTO rawdata_updates_tb(user_id,status,item_id,value,job,source) "
                        . "VALUES('$user_id','OUT','$name','$qty','$job','$source')")or die(mysqli_error($con));
    
}

echo "<script>document.location='update-warehouse-stock.php'</script>";
?>
 