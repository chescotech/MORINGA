<?php

include("../dist/includes/dbcon.php");

$id = $_REQUEST['id'];
$cid = $_POST['cid'];
$order_no = $_POST['order_no'];

echo 'order no'.$order_no;

$result = mysqli_query($con, "DELETE FROM draft_temp_trans WHERE temp_trans_id ='$id'")
        or die(mysqli_error($con));

echo "<script>document.location='update-order-draft.php?orderno=$order_no'</script>";

?>
