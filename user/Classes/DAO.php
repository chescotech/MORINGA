<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAO
 *
 * @author User
 */
class DAO {

    public function getExchan($param) {
        
    }
    
    public function getItemsBought($customer_id, $requester_id, $con) {
        $itemString = "";
        $total_sales = 0;
        $query = mysqli_query($con, "select * from requisitions_tb where customer_name='$customer_id' AND requester_id='$requester_id' AND sale_status!='Sold' ")or die(mysqli_error($con));

        while ($row = mysqli_fetch_array($query)) {

            $pid = $row['prod_id'];
            $qty = $row['qty'];
            $price = $row['price'];

            $stockCount = mysqli_query($con, "SELECT * FROM product WHERE prod_id='$pid' ")or die(mysqli_error($con));
            $countRows = mysqli_fetch_array($stockCount);
            $prod_name = $countRows['prod_name'];

            $total_sales += $qty * $price;

            $itemString .= $qty . ' ' . $prod_name . ' ';

            //$total_sales += 
        }

        echo $itemString;
    }

    public function getCompanyContact($con) {
        $getCustomerDataQuery = mysqli_query($con, "SELECT * FROM branch")or die(mysqli_error($con));
        $InfoRows = mysqli_fetch_array($getCustomerDataQuery);
        $branch_contact = $InfoRows['branch_contact'];
        return $branch_contact;
    }

    public function getCustomerType($con, $cust_id){
        $getCustomerDataQuery = mysqli_query($con, "SELECT * FROM customer WHERE cust_id='$cust_id'")or die(mysqli_error($con));
        $InfoRows = mysqli_fetch_array($getCustomerDataQuery);
        $price_tag= $InfoRows['price_tag'];
        return $price_tag;

    }

    public function getProductPrice($prodid,$con,$price_tag){
        $getCustomerDataQuery = mysqli_query($con, "SELECT * FROM customer WHERE cust_id='$cust_id'")or die(mysqli_error($con));
        $InfoRows = mysqli_fetch_array($getCustomerDataQuery);
        $price_tag= $InfoRows['price_tag'];
        return $price_tag;

    }

    public function getCompanyName($con) {
        $getCustomerDataQuery = mysqli_query($con, "SELECT * FROM branch")or die(mysqli_error($con));
        $InfoRows = mysqli_fetch_array($getCustomerDataQuery);
        $branch_name = $InfoRows['branch_name'];
        return $branch_name;
    }

    public function getCustomerNames($cust_id,$con) {
        $getCustomerDataQuery = mysqli_query($con, "SELECT * FROM customer WHERE cust_id='$cust_id'")or die(mysqli_error($con));
        $InfoRows = mysqli_fetch_array($getCustomerDataQuery);
        $customer_names = $InfoRows['cust_first'] . ' ' . $InfoRows['cust_last'];
        return $customer_names;
    }

    public function SendSMS($phoneNumber, $msg) {
        $reply_msg = urlencode($msg);
        $message_type = "1";
        $sender_id = "Shaarz";
        //$etopupURL = "https://sms.chesco-tech.com/third-party-send-sms.php?sender_id=" . $sender_id . "&mobile_to=26" . $phoneNumber . "&message_type=" . $message_type . "&message=" . $reply_msg;

        $etopupURL = "https://sms.chesco-tech.com/third-party-send-sms-merchant.php?sender_id=Shaarz&mobile_to=26" . $phoneNumber . "&message_type=1&message=" . $reply_msg . "&username=shaarz&password=shaarz123";

        $ch = curl_init(); // initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $etopupURL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        return $result;
    }

    public function SendWhatsupMessage($phoneNo, $message) {
        
    }

    public function getCustomerPhoneNo($cust_id, $con) {
        $getCustomerDataQuery = mysqli_query($con, "SELECT * FROM customer WHERE cust_id='$cust_id'")or die(mysqli_error($con));
        $InfoRows = mysqli_fetch_array($getCustomerDataQuery);
        $cust_contact = $InfoRows['cust_contact'];
        return $cust_contact;
    }

    public function getCustomerEmail($cust_id, $con) {
        $getCustomerDataQuery = mysqli_query($con, "SELECT * FROM customer WHERE cust_id='$cust_id'")or die(mysqli_error($con));
        $InfoRows = mysqli_fetch_array($getCustomerDataQuery);
        $email = $InfoRows['email'];
        return $email;
    }

    //  

}
