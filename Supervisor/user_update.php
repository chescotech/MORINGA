<?php

session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$usersbranch = "";
$id = $_POST['user_id'];
$name = $_POST['name'];
$password = md5($_POST['password']);
$repassword = md5($_POST['repassword']);
$status = $_POST['status'];
$user_type = $_POST['user_type'];
$branch_id_user = $_POST['branch_id_user'];


if ($password != $repassword) {
    echo "<script type='text/javascript'>alert('Passwords do not match , please re enter passwords');</script>";
    echo "<script>document.location='users.php'</script>";
} else if ($_POST['password'] != "") {
    if ($branch_id_user != "0") {       
        mysqli_query($con, "update user set name='$name',password='$password',status='$status', user_type='$user_type', branch_id_user='$branch_id_user' where user_id='$id'")or die(mysqli_error($con));
    } else {
        $usersbranch = "0";
        mysqli_query($con, "update user set name='$name',password='$password',status='$status', user_type='$user_type' where user_id='$id'")or die(mysqli_error($con));
    }
    echo "<script type='text/javascript'>alert('Successfully updated user details!');</script>";
    echo "<script>document.location='users.php'</script>";
} else {
    if ($branch_id_user != "0") {
        echo "first";
        mysqli_query($con, "update user set name='$name',status='$status', user_type='$user_type',branch_id_user='$branch_id_user' where user_id='$id'")or die(mysqli_error($con));
    } else {
        echo "second";
        mysqli_query($con, "update user set name='$name',status='$status', user_type='$user_type' where user_id='$id'")or die(mysqli_error($con));
    }
    //echo $branch_id_user;
    echo "<script type='text/javascript'>alert('Successfully updated user details!');</script>";
    echo "<script>document.location='users.php'</script>";
}
?>
