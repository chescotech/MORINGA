<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['id'];
mysqli_query($con, "DELETE FROM stores_branch where id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Deleted Branch !!');</script>";
echo "<script>document.location='branch-setup.php'</script>";
?>
