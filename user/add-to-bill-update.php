<?php

session_start();
$id = $_SESSION['id'];
$branch = $_SESSION['branch'];

include('../dist/includes/dbcon.php');


$name = $_POST['description'];
$price = $_POST['price'];
$qty = $_POST['qty'];
$orderNo = $_POST['order_no'];
$user_id = $_SESSION['id'];
$customer_name = $_POST['customer_name'];

$query1 = mysqli_query($con, "select * from draft_temp_trans where description='$name' and branch_id='$branch' AND order_no='$orderNo' ")or die(mysqli_error($con));
$count = mysqli_num_rows($query1);

if ($count > 0) {
    mysqli_query($con, "UPDATE draft_temp_trans SET qty=qty+'$qty' WHERE description='$name' ")or die(mysqli_error($con));
} else {
    mysqli_query($con, "INSERT INTO draft_temp_trans(prod_id,qty,price,branch_id,order_no,user_id,description,customer_name)"
                    . " VALUES('0','$qty','$price','$branch','$orderNo','$user_id','$name','$customer_name')")or die(mysqli_error($con));
}
echo "<script>document.location='update-order-draft.php?orderno=$orderNo'</script>";
?>