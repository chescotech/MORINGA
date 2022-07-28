<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$branch_name = $_POST['branch_name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$reciept_footer_text = $_POST['reciept_footer_text'];
$notification_count = $_POST['notification_count'];

mysqli_query($con, "update branch set branch_name='$branch_name',branch_address='$address',"
        . "branch_contact='$contact', reciept_footer_text='$reciept_footer_text' ,notification_count='$notification_count'")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Updated Company details!');</script>";
echo "<script>document.location='company-setup.php'</script>";
?>
