<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$description = $_POST['description'];

mysqli_query($con, "update expense_types_tb set exp_name='$description' where expense_id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully updated details!');</script>";
echo "<script>document.location='expense_types'</script>";
?>
