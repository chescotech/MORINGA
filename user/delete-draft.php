<?php

include("../dist/includes/dbcon.php");
$id = $_REQUEST['id'];
$cid = $_POST['cid'];
$result = mysqli_query($con, "DELETE FROM draft_temp_trans WHERE temp_trans_id ='$id'")
        or die(mysqli_error($con));

echo "<script>document.location='draft-order.php'</script>";

?>