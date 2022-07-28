<?php
include('../dist/includes/dbcon.php');
$qtyChecker = mysqli_query($con, "select * FROM rawdata_updates_tb WHERE action_status='' ")or die(mysqli_error($con));

while ($qtyRows = mysqli_fetch_array($qtyChecker)) {

    //update the status of the itemss..
    $id = $qtyRows['id'];
    $status = $qtyRows['status'];
    $itemID = $qtyRows['item_id'];
    $value = $qtyRows['value'];

    mysqli_query($con, "update rawdata_updates_tb set action_status='updated' WHERE id='$id' ")or die(mysqli_error($con));

    // deduct or add items to the sub and raw depending on the action type. 

    if ($status == "IN") {
        mysqli_query($con, "update rawdata_tb set qty=qty+'$value' WHERE id='$itemID' ")or die(mysqli_error($con));
    } else {
        mysqli_query($con, "update rawdata_tb set qty=qty-'$value' WHERE id='$itemID' ")or die(mysqli_error($con));
    }
}

echo "<script type='text/javascript'>alert('Successfully Added Items !!');</script>";
echo "<script>document.location='update-warehouse-stock.php'</script>";


