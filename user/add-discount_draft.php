<?php

include("../dist/includes/dbcon.php");

$cid = $_POST['cid'];
$password = md5($_POST['password']);
$amount = $_POST['amount'];
$discount_type = $_POST['discount_type'];

$passwordChecker = mysqli_query($con, " select * from user natural join branch where password='$password' and status='active' and ( user_type='Admin' OR  user_type='Supervisor') ")
        or die(mysqli_error($con));

if (mysqli_num_rows($passwordChecker) == 0) {

    // update the data to show the discounts..

    $itemChecker = mysqli_query($con, " select * from draft_temp_trans WHERE temp_trans_id ='$cid' ")
            or die(mysqli_error($con));

    $itemRows = mysqli_fetch_array($itemChecker);

    $price = $itemRows['price'];

    if ($discount_type == "Percentage") {
        $computedPrice = ($amount / 100) * $price;
        $newPrice = $price - $computedPrice;
    } else {
        $newPrice = $price - $amount;
    }

    $result = mysqli_query($con, "UPDATE draft_temp_trans SET amount='$amount', discount_type='$discount_type'  WHERE temp_trans_id ='$cid'") or die(mysqli_error($con));

    echo "<script>document.location='draft-order.php'</script>";
    
} else {
      echo "<script type='text/javascript'>alert('Invalid Username or Password!');
      document.location='draft-order.php'</script>";
       }
?>