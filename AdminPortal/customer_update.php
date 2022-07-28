<?php session_start();
if (empty($_SESSION['id'])) :
	header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
$id = $_POST['id'];
$last = $_POST['last'];
$first = $_POST['first'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$price_tag = $_POST['price_tag'];

mysqli_query($con, "update customer set cust_last='$last',cust_first='$first',"
	. "cust_address='$address',email='$email' ,cust_contact='$contact',price_tag='$price_tag' where cust_id='$id'") or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully updated customer details!');</script>";
echo "<script>document.location='customer.php'</script>";
