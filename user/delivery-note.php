
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
error_reporting(0);
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
        <title>Delivery Note</title>
        <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
        <a class = "btn btn-primary btn-print" href = "cash_transaction.php"><i class ="glyphicon glyphicon-arrow-left"></i>NEXT SALE</a>
    </head>
    <style type="text/css">
        tr td{
            padding-top:-10px!important;
            border: 1px solid #000;
        }
        @media print {
            .btn-print {
                display:none !important;
            }
        }
    </style>
    <style type="text/css">
        body{
            background-color:#999;}
        .wrapper{
            background-color:#FFF;
            width:900px;
            height:600px;
            margin:auto;
        }
        .name{
            background-color:#fff;
            height:40px;
            width:900px;
            float:left;

        }
        .name_{
            background-color:#fff;
            height:90px;
            width:450px;
            float:left;
        }
        .payslip{
            background-color:#fff;
            height:90px;
            width:450px;
            float:right;
        }
        .payslip2{
            background-color:#fff;
            width:900px;
            float:left;
        }
        .payslip2_{
            padding-left:25px;
        }
        td{
            font-size:10px;}
        .box{	font-family:Tahoma, Geneva, sans-serif;}
        .box1{
            font-weight:bold;
            opacity:0;
            font-size:1px;}
        </style>

        <?php include('../dist/includes/dbcon.php'); ?>
        <?php
        $id = $_SESSION['id'];
        $queryb = mysqli_query($con, "select * from branch")or die(mysqli_error($con));
        $rowb = mysqli_fetch_array($queryb);
        ?>
        <body class="hold-transition skin-blue layout-top-nav" onload="window.print()" style=" background-color: white ">
        <div class="wrapper">
            <div class="body">
                <center>
                    
                    <img src="../dist/img/my-logo.png" width="100px" height="100px"></img>
                    <br> <br>
                  
                    <p style="font-size: 15px; font-family: Arial; color: blue">
                        <b>
                            <?php
                            echo $rowb['branch_address'] . '<br>' . $rowb['branch_contact'] . '';
                            ?> 
                        </b>
                    </p>

                    <?php
                    $branch = $_SESSION['branch'];
                    $query = mysqli_query($con, "SELECT * FROM `sales` INNER JOIN modes_of_payment_tb on modes_of_payment_tb.payment_mode_id=sales.modeofpayment WHERE sales_id = (SELECT MAX(sales_id) FROM sales WHERE user_id='$id' ) AND user_id='$id'  ")or die(mysqli_error($con));

                    $row = mysqli_fetch_array($query);

                    $sales_id = $row['sales_id'];
                    $sid = $row['sales_id'];
                    $due = $row['amount_due'];
                    $cust_order_no = $row['order_no'];

                    $discount = $row['discount'];
                    $grandtotal = $due - $discount;
                    $tendered = $row['cash_tendered'];
                    $change = $row['cash_change'];
                    $customer_id = $row['customer_id'];
                    $mode_payment = $row['name'];

                    $invoice2 = mysqli_query($con, "SELECT MAX(id) AS id FROM invoices_tb")or die(mysqli_error($con));
                    $rowss = mysqli_fetch_array($invoice2);
                    $invoiceNo = $rowss['id'];

                    $customer = mysqli_query($con, "SELECT * FROM `customer` WHERE cust_id ='$customer_id' ")or die(mysqli_error($con));

                    $customerRows = mysqli_fetch_array($customer);
                    ?>

                </center>   
                <center><a style=" color: black; font-size: 15px; font-family: Arial"><b> Delivery Note # <?php
                            echo $invoiceNo;
                            ?>
                        </b></a></center>  
                <p style=" margin-left: 25px">          ____________________________________________________________________________________________________________</p>
                <div class="name"></div>                           
                <div class="payslip2">
                    <div class="payslip2_">       
                        <div class="payslip">                            
                            <p style="font-size: 15px; font-family: Arial"><b>Invoice Number:</b> 
                                <?php
                                echo $cust_order_no;
                                ?>                            
                            </p></td>
                            <p style="font-size: 15px; font-family: Arial"><b>Delivery Note Date: </b><?php
                                echo date("M d, Y");
                                ?></p>
                            <p style="font-size: 15px; font-family: Arial"><b>Mode Of Payment:</b> 
                            
                                <?php
                                
                                                                echo $mode_payment;
                                ?>
                                
                            </p>
                        </div>                        
                                 
                        
                        <style type="">
                            .align{
                                word-spacing:285px;}.align1{
                                word-spacing:300px;}.align3{
                                float:right;}.net{
                               
                                margin-top: -200px;
                                }
                            </style>           

                            <p style="font-size: 15px; font-family: Arial">
                            To: 
                        </p>  

                        <p style="font-size: 15px; font-family: Arial">
                            <b>
                                <?php echo $customerRows['cust_first'] . '  ' . $customerRows['cust_last'] ?>
                            </b>
                        </p>  
                        <p style="font-size: 15px; font-family: Arial"><b>
                                Address: <?php echo substr($customerRows['cust_address'], 0, 40); ?>
                            </b>
                        </p>  
                        <p style="font-size: 15px; font-family: Arial"><b>
                                Contact #: <?php echo $customerRows['cust_contact'] ?>
                            </b>
                        </p> 
                        <br>

                            <style type="">
                                .align{
                                    word-spacing:285px;}.align1{
                                    word-spacing:300px;}.align3{
                                    float:right;}.net{
                                    margin-right:99px;}
                                td {
                                    vertical-align: top;
                                }
                            </style>
                            <style>
                                table, td, th {
                                    border: 1px solid black;
                                }

                                table {
                                    border-collapse: collapse;
                                    width: 100%;
                                }

                                td {
                                    height: 50px;
                                    vertical-align: bottom;
                                }
                            </style>
                            <table style=" margin-left: -10px">
                                <tr>
                                    <th style="font-size: 15px; font-family: Arial">PRODUCT CODE</th>
                                    <th style="font-size: 15px; font-family: Arial">DESCRIPTION</th> 
                                    <th style="font-size: 15px; font-family: Arial">QTY</th>                                    
                                   
                                </tr>
                                <tr>
                                    <?php
                                    $query = mysqli_query($con, "select * from sales_details LEFT join product on product.prod_id=sales_details.prod_id where sales_id='$sid'")or die(mysqli_error($con));
                                    $grand = 0;

                                    while ($row = mysqli_fetch_array($query)) {
                                        $order_no = $row['order_no'];
                                        
                                        if($row['prod_name']==''){
                                            $prodName = $row['description'];
                                        }else{
                                            $prodName = $row['prod_name'];
                                        }
                                        
                                        $price = $row['price'];
                                        $total = $row['qty'] * $row['price'];
                                        $subTotal += $row['qty'] * $row['price'];
                                        $pack_size = $row['pack_size'];
                                        $grand = $grand + $total;
                                        if($row['barcode']==""){
                                            $prodCode = '0.00';
                                        } else {
                                            $prodCode = $row['barcode'];
                                        }
                                        

                                        echo ' <tr>
                                                                           <td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                           ' . $prodCode . '
                                        </td style="vertical-align:middle;font-size: 18px; font-family: Arial">
                                <td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                           ' . $prodName . '
                                        </td>
                                        <td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                           ' . $row['qty'] . '
                                        </td>
                                       
                            </tr>';
                                    }

                                    ?>
                                </tr>                                   
                            </table>

                            <?php
                            $query = mysqli_query($con, "select * from user where user_id='$id'")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query);
                            
                            $company= $customerRows['cust_first'] . '  ' . $customerRows['cust_last'];

                            echo '<br></br> <b>Prepared By:</b> ' . $row['name'] . '. ';
                            echo '<br></br> <b>Signature: ...................................</b> ';
                            echo '<br></br> <b>Recieved By: ................................... </b>';
                            echo '<br></br> <b>Authorized by ( '.$company.' ) Signature: ................................... </b>';
                            ?>

                            <br></br> <br></br> <br></br> <br></br>

                        </form></div>
                </div>
            </div>
        </div>
    </body>
</html>
<br></br> <br></br> <br></br> <br></br>



