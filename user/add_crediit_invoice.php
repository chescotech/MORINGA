<?php

session_start();
include('../dist/includes/dbcon.php');
$branch = $_SESSION['branch'];
$invoice_no = $_POST['invoice_no'];
$amount = $_POST['amount'];
$id = $_SESSION['id'];

$query2 = mysqli_query($con, "select * from  sales where invoice_no='$invoice_no'")or die(mysqli_error($con));
$count = mysqli_num_rows($query2);
$rows = mysqli_fetch_array($query2);


if ($count > 0) {
    $invoiced_amount = $rows['amount_due'];
    if ($amount <= $invoiced_amount) {
        mysqli_query($con, "INSERT INTO credit_payments(amount,invoice_no,user_id) 
				VALUES('$amount','$invoice_no','$id')")or die(mysqli_error($con));
        $id = mysqli_insert_id($con);
        echo "<script type='text/javascript'>alert('Successfully added new Record!');</script>";
        echo "<script>document.location='credit_invoice.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error, Credit Amount is more than amount Invoiced !!!');</script>";
        echo "<script>document.location='credit_invoice.php'</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('Error, Invoice number not found !!!');</script>";
    echo "<script>document.location='credit_invoice.php'</script>";
}
?>