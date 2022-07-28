<?php

include("../dist/includes/dbcon.php");
$id = $_REQUEST['id'];
$cid = $_POST['cid'];
$result = mysqli_query($con, "DELETE FROM quotation_tb WHERE quote_id ='$id'")
        or die(mysqli_error($con));

if (isset($_GET['type'])) {
    $quote_id = $_POST['quote_id'];
    echo "<script>document.location='edit-quotation.php?quote_id=$quote_id'</script>";
} else {
    echo "<script>document.location='quotation.php'</script>";
}


?>