<?php

session_start();
$id = $_SESSION['id'];
include('../dist/includes/dbcon.php');
include('Classes/DAO.php');
require_once('../PHPmailer/sendmail.php');

$discount = $_POST['discount'];
$amount_due = $_POST['amount_due'];
$dao = new DAO();
date_default_timezone_set("Africa/Lusaka");
$date = date("Y-m-d H:i:s");
$cid = 1;
$branch = $_SESSION['branch'];
$total = $amount_due - $discount;
$orderNumber = (rand(50, 5000));
$tendered = $_POST['tendered'];
$change = $_POST['change'];
$cust_id =  $_SESSION['selected_cust_id'];//$_POST['cust_id'];
$payment_mode_id = $_POST['payment_mode_id'];
$invoice_mode = $_POST['invoice_mode'];
$rate = $_POST['rate'];

// check thr type of invoice...

//echo '$amount_due'.$amount_due.' discount '.$discount;

if ($tendered >= $amount_due) {

    if ($cust_id == "none") {
        $cust_id = "0";
    }

    mysqli_query($con, "INSERT INTO invoices_tb(order_no) 
                                        VALUES('$orderNumber')")or die(mysqli_error($con));

    $invoice2 = mysqli_query($con, "SELECT MAX(id) AS id FROM invoices_tb")or die(mysqli_error($con));
    $rowss = mysqli_fetch_array($invoice2);
    $invoiceNo = $rowss['id'];

    $id = $_SESSION['id'];
    mysqli_query($con, "INSERT INTO sales(cust_id,user_id,discount,amount_due,total,date_added,modeofpayment,cash_tendered,cash_change,branch_id,order_no,customer_id,invoice_no,rate) 
	VALUES('$cid','$id','$discount','$amount_due','$total','$date','$payment_mode_id','$tendered','$change','$branch','$orderNumber','$cust_id','$invoiceNo','$rate')")or die(mysqli_error($con));

    $sales_id = mysqli_insert_id($con);
    $_SESSION['sid'] = $sales_id;
    $query = mysqli_query($con, "select * from temp_trans where branch_id='$branch' AND user_id='$id'   ")or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($query)) {
        $pid = $row['prod_id'];
        $qty = $row['qty'];
        $price = $row['price'];
        $discount = $row['amount'];
        $discount_type = $row['discount_type'];
        $description = $row['description'];

        // insert the open and close balances... 
        $dateis = date('Y-m-d');
        $openClose = mysqli_query($con, "SELECT * FROM open_close_tb WHERE prod_id='$pid' AND date='$dateis' ")or die(mysqli_error($con));
        if (mysqli_num_rows($openClose) > 0) {

            // product already exisits so just update the close balance.. 
            // get the stock count from inventory.. 
            $stockCount = mysqli_query($con, "SELECT * FROM product WHERE prod_id='$pid' ")or die(mysqli_error($con));
            $countRows = mysqli_fetch_array($stockCount);
            $stockOpenBalance = $countRows['prod_qty'];
            $prod_sell_price = $price;

            $dateis = date('Y-m-d');

            mysqli_query($con, "INSERT INTO sales_details(prod_id,qty,price,sales_id,order_no,user_id,discount,discount_type,description) "
                            . "VALUES('$pid','$qty','$price','$sales_id','$orderNumber','$id','$discount','$discount_type','$description')")or die(mysqli_error($con));
            mysqli_query($con, "UPDATE product SET prod_qty=prod_qty-'$qty' where prod_id='$pid' and branch_id='$branch'") or die(mysqli_error($con));

            // update the closing balance for the stock.. 
            mysqli_query($con, "UPDATE open_close_tb SET close_bal='$stockOpenBalance'  WHERE date='$dateis' AND prod_id='$pid' ")or die(mysqli_error($con));
        } else {
            // get the stock count from inventory.. 
            $stockCount = mysqli_query($con, "SELECT * FROM product WHERE prod_id='$pid' ")or die(mysqli_error($con));
            $countRows = mysqli_fetch_array($stockCount);
            $prod_sell_price = $countRows['price'];
            $stockOpenBalance = $countRows['prod_qty'];
            $dateis = date('Y-m-d');

            mysqli_query($con, "INSERT INTO open_close_tb(prod_id,open_bal,date) 
	VALUES('$pid','$stockOpenBalance','$dateis')")or die(mysqli_error($con));

            mysqli_query($con, "INSERT INTO sales_details(prod_id,qty,price,sales_id,order_no, user_id,discount, discount_type,description) "
                            . "VALUES('$pid','$qty','$price','$sales_id','$orderNumber','$id','$discount','$discount_type','$description')")or die(mysqli_error($con));

            mysqli_query($con, "UPDATE product SET prod_qty=prod_qty-'$qty' where prod_id='$pid' and branch_id='$branch'") or die(mysqli_error($con));
        }

        // update the inventory counts.. 
    }

    $query1 = mysqli_query($con, "SELECT or_no FROM payment NATURAL JOIN sales WHERE modeofpayment =  'cash' ORDER BY payment_id DESC LIMIT 0 , 1")or die(mysqli_error($con));

    $row1 = mysqli_fetch_array($query1);
    $or = $row1['or_no'];

    if ($or == 0) {
        $or = 1901;
    } else {
        $or = $or + 1;
    }

    mysqli_query($con, "INSERT INTO payment(cust_id,user_id,payment,payment_date,branch_id,payment_for,due,status,sales_id,or_no) 
	VALUES('$cid','$id','$total','$date','$branch','$date','$total','paid','$sales_id','$or')")or die(mysqli_error($con));

    if ($invoice_mode == "download") {

        echo "<script>document.location='new_reciept.php?cid=$cid'</script>";
        $result = mysqli_query($con, "DELETE FROM temp_trans where branch_id='$branch' AND user_id='$id'") or die(mysqli_error($con));
    }elseif ($invoice_mode == "note") {
         echo "<script>document.location='delivery-note-new.php?cid=$cid'</script>";
          $result = mysqli_query($con, "DELETE FROM temp_trans where branch_id='$branch' AND user_id='$id'") or die(mysqli_error($con));
    } else if ($invoice_mode == "whatsapp") {

        $itemString = "";
        $total_sales = 0;
        $query = mysqli_query($con, "select * from temp_trans where branch_id='$branch' AND user_id='$id' ")or die(mysqli_error($con));

        while ($row = mysqli_fetch_array($query)) {

            $pid = $row['prod_id'];
            $qty = $row['qty'];
            $price = $row['price'];

            $stockCount = mysqli_query($con, "SELECT * FROM product WHERE prod_id='$pid' ")or die(mysqli_error($con));
            $countRows = mysqli_fetch_array($stockCount);
            $prod_name = $countRows['prod_name'];

            $total_sales += $qty * $price;

            $itemString .= $qty . ' ' . $prod_name . ' , ';
        }

        //$image = '<img src="shazz_logo.jpg" width="200px" height="200px" class="img-thumbnail" />';
        //$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        //$validURL = str_replace("&", "&amp", $url)."/invoice";

        $validURL = "http://localhost/Accounting/user/invoice?sales_id=" . $sales_id;

        $recieptURL = $msg = "Dear " . $dao->getCustomerNames($cust_id, $con) . ",please find your Reciept of payment at :  " . $validURL . "  from " . $dao->getCompanyName($con) . "  .Thank you for your business. Feel free to contact us on " . $dao->getCompanyContact($con) . " for any queries.";

        $result = mysqli_query($con, "DELETE FROM temp_trans where branch_id='$branch' AND user_id='$id'") or die(mysqli_error($con));
        echo "<script>document.location='http://api.whatsapp.com/send?phone=26" . $dao->getCustomerPhoneNo($cust_id, $con) . "&text=" . urlencode($msg) . " '</script>";
    } else if ($invoice_mode == "email") {
        $itemString = "";
        $total_sales = 0;
        $query = mysqli_query($con, "select * from temp_trans where branch_id='$branch' AND user_id='$id' ")or die(mysqli_error($con));

        while ($row = mysqli_fetch_array($query)) {

            $pid = $row['prod_id'];
            $qty = $row['qty'];
            $price = $row['price'];

            $stockCount = mysqli_query($con, "SELECT * FROM product WHERE prod_id='$pid' ")or die(mysqli_error($con));
            $countRows = mysqli_fetch_array($stockCount);
            $prod_name = $countRows['prod_name'];

            $total_sales += $qty * $price;

            $itemString .= $qty . ' ' . $prod_name . ' , ';
        }

        $em = new email();
        //$dao->getCustomerEmail($cust_id, $con)
        $validURL = "http://localhost/Accounting/user/invoice?sales_id=" . $sales_id;
        $image = '<img src="shazz_logo.jpg" width="200px" height="200px" class="img-thumbnail" />';

        $msg = "Dear " . $dao->getCustomerNames($cust_id, $con) . ", <br> </br> <br> </br>
        please find your Reciept of payment at : " . $validURL . "  from " . $dao->getCompanyName($con) . " .         
        Thank you for shopping with us. Feel free to contact us on 0967962090 for any queries." . "<br>" . "<br>"
        ."© 2021 Chesco-Tech. All rights reserved. This invoice was sent through Chesco-Tech Accounting Software.";

        $em->send_mail($dao->getCustomerEmail($cust_id, $con), $msg, "PAYMENT RECIEPT",$dao->getCompanyName($con));

        //$result = mysqli_query($con, "UPDATE requisitions_tb SET sale_status='Sold' where customer_name='$customer_id' AND requester_id='$id'") or die(mysqli_error($con));
        $result = mysqli_query($con, "DELETE FROM temp_trans where branch_id='$branch' AND user_id='$id'") or die(mysqli_error($con));
        echo "<script type='text/javascript'>alert('Successfully Transacted');</script>";
        echo "<script>document.location='select_customer.php'</script>";
    }
} else {
    echo "<script type='text/javascript'>alert(' Error !!, Cash Tendered cannot be less than amount due..');</script>";
    echo "<script>document.location='cash_transaction.php'</script>";
}
?>