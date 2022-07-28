<?php

include("../dist/includes/dbcon.php");
$id = $_REQUEST['id'];
$cid = $_POST['cid'];
$result = mysqli_query($con, "DELETE FROM advance_payments_tb WHERE advace_id ='$id'")
        or die(mysqli_error($con));

echo "<script>document.location='advance-sale.php'</script>";

?>