<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$description = $_POST['description'];
$amount = $_POST['amount'];

mysqli_query($con, "update expenses_tb set description='$description',amount='$amount' where id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully updated details!');</script>";
echo "<script>document.location='expenses.php'</script>";
?>
