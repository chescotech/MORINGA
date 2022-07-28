<?php
session_start();
include('../dist/includes/dbcon.php');

$description = $_POST['description'];
//$amount = $_POST['amount'];
$date =  date('Y-m-d H:i:s');
$userId = $_SESSION['id'];

mysqli_query($con, "INSERT INTO expense_types_tb(exp_name,added_by) 
				VALUES('$description','$userId')")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully added new Expense Type!');</script>";
echo "<script>document.location='expense_types'</script>";
?>