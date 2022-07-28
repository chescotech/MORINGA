<?php

include('../dist/includes/dbcon.php');

$total_amount = $_POST['total_amount'];
$amount_paid = $_POST['amount_paid'];
$supplier_id = $_POST['supplier'];
$invoice_no = $_POST['invoice_no'];

mysqli_query($con, "INSERT INTO supplier_payments_tb(total_amount,amount_paid,supplier_id,invoice_no) 
				VALUES('$total_amount','$amount_paid','$supplier_id','$invoice_no')")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully added Record!');</script>";
echo "<script>document.location='supplier_payments.php'</script>";
?>