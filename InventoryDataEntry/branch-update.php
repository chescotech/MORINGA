<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$branch_name = $_POST['branch_name'];

mysqli_query($con, "update stores_branch set branch_name='$branch_name' where id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully updated Branch Record !!');</script>";
echo "<script>document.location='branch-setup.php'</script>";
?>
