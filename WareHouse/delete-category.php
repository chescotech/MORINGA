<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$id = $_POST['cat_id'];
mysqli_query($con, "DELETE FROM category where cat_id='$id'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Deleted Category !!');</script>";
echo "<script>document.location='category.php'</script>";
?>
