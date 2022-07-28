<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$cashout_limit = $_POST['cashout_limit'];
$status = $_POST['status'];

mysqli_query($con, "update cashout_limits_tb set cashoutlimit='$cashout_limit',status='$status' ")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Updated details!');</script>";
echo "<script>document.location='cashout-limits.php'</script>";
?>
