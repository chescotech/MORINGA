<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['expense_id'];
mysqli_query($con, "DELETE FROM expense_types_tb where expense_id ='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Deleted Record !!');</script>";
echo "<script>document.location='expense_types'</script>";
?>
