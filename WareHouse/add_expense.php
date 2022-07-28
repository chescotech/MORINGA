<?php

include('../dist/includes/dbcon.php');

$description = $_POST['description'];
$amount = $_POST['amount'];
$date =  date('Y-m-d H:i:s');

mysqli_query($con, "INSERT INTO expenses_tb(description,amount,date) 
				VALUES('$description','$amount','$date')")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully added new Expense!');</script>";
echo "<script>document.location='expenses.php'</script>";
?>