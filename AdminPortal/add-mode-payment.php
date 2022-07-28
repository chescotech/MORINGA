<?php

include('../dist/includes/dbcon.php');

$name = $_POST['name'];

mysqli_query($con, "INSERT INTO modes_of_payment_tb(name) 
				VALUES('$name')")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully Added Record !!!');</script>";
echo "<script>document.location='modes-of-payment.php'</script>";
?>