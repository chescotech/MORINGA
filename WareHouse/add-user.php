<?php

session_start();
$branch = $_SESSION['branch'];
include('../dist/includes/dbcon.php');

$username = $_POST['username'];
$password = md5($_POST['password']);
$names = $_POST['names'];
$user_type = $_POST['user_type'];

mysqli_query($con, "INSERT INTO user(username,password,name,user_type,status,branch_id)
			VALUES('$username','$password','$names','$user_type','active','1')")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully added new user!');</script>";
echo "<script>document.location='users.php'</script>";

?>