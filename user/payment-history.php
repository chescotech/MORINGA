<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
error_reporting(0);
session_start();

include('Classes/Company.php');
$company = new Company();
?>
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Invoice</title>
    </head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
                <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
                    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
                        <!-- AdminLTE Skins. Choose a skin from the css/skins
                                                     folder instead of downloading all of them to reduce the load. -->
                        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
                            <script src="../dist/js/jquery.min.js"></script>

                            <style type="text/css">
                                body {
                                    background-color: #999;
                                }

                                .wrapper {
                                    background-color: #FFF;
                                    width: 100%;

                                    margin: auto;
                                }

                                .name {
                                    background-color: #fff;

                                    width: 100%;
                                    float: left;

                                }

                                .name_ {
                                    background-color: #fff;

                                    width: 100%;
                                    float: left;
                                }

                                .payslip {
                                    background-color: #fff;

                                    width: 100%;
                                    float: left;
                                }

                                .payslip2 {
                                    background-color: #fff;
                                    width: 900px;
                                    float: left;
                                }

                                .payslip2_ {
                                    padding-left: 25px;
                                }

                                td {
                                    font-size: 10px;
                                }

                                .box {
                                    font-family: Tahoma, Geneva, sans-serif;
                                }

                                .box1 {
                                    font-weight: bold;
                                    opacity: 0;
                                    font-size: 1px;
                                }
                            </style>

                            <style type="text/css">
                                h5,
                                h6 {
                                    text-align: center;
                                }

                                @media print {
                                    .btn-print {
                                        display: none !important;
                                    }

                                    .main-footer {
                                        display: none !important;
                                    }

                                    .box.box-primary {
                                        border-top: none !important;
                                    }


                                }
                            </style>
                            <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
                                <a class="btn btn-success btn-print" href="" onclick="window.print()"><i class="glyphicon glyphicon-print"></i> <button style=" background-color: blue">Print</button></a>
                                <a class="btn btn-primary btn-print" href="draft-sale.php"><i class="glyphicon glyphicon-arrow-left"></i><button style=" background-color: green ">NEXT SALE</button></a>

                                <body class="hold-transition skin-blue layout-top-nav" onload="print()" onfocus="window.close()" style=" background-color: white ">
                                    <div class="wrapper" title="">
                                        <div class="body"></div>
                                        <div class="body">
                                            <div class="name"></div>
                                            <div class="name_">

                                                <?php include('../dist/includes/dbcon.php'); ?>

                                                <form method="post" action="entry.php" onSubmit="return proceed()">
                                                    <table border="0" align="center" width="10000" class="top1">

                                                        <center>
                                                            <h3 style="color: black ">
                                                                <img width="170" src="../dist/uploads/comp/<?php echo $company->logo($con); ?>" />
                                                                <br> <br>
                                                                        <?php
                                                                        $orderNumber = $_GET['orderno'];
                                                                        $id = $_SESSION['id'];
                                                                        $queryb = mysqli_query($con, "select * from branch") or die(mysqli_error($con));
                                                                        $rowb = mysqli_fetch_array($queryb);
                                                                        $reciept_footer_text = $rowb['reciept_footer_text'];
                                                                        echo $rowb['branch_address'] . '<br>' . $rowb['branch_contact'] . '';
                                                                        ?>
                                                                        </h3>
                                                                        </center>
                                                                        <?php
                                                                        $customer = mysqli_query($con, "select customer.cust_first,customer.cust_last,temp_trans_id,prod_name,prod_sell_price,SUM(qty) AS qty,customer_name from draft_temp_trans left join product on product.prod_id=draft_temp_trans.prod_id
inner join customer on customer.cust_id=draft_temp_trans.cust_id where order_no='$orderNumber' AND is_printed='0' group by prod_name  ") or die(mysqli_error($con));

                                                                        $customerRows = mysqli_fetch_array($customer);
                                                                        $names = $customerRows['cust_first'] . ' ' . $customerRows['cust_last'];

                                                                        echo ' <tr>
                                <td class="box" width=""><h4><u></u>
                                            ATTN : ' . $names . '
                                   
                                        </h4></td>
                            </tr>';
                                                                        echo '<center><u><h4><b>STATEMENT</b></h4></u></center>';


                                                                        echo ' <tr>
                                <td class="box" width=""><h6>
                                            Dear Customer, please find out statements as follows :                                   
                                        </h6></td>
                            </tr>';
                                                                        ;

                                                                        $query1 = mysqli_query($con, "select * from payment where sales_id='$sales_id'") or die(mysqli_error($con));

                                                                        $row1 = mysqli_fetch_array($query1);
                                                                        ?>

                                                                        <table class="table table-bordered table-striped" style="border:2px solid black">

                                                                            <thead>
                                                                                <tr>
                                                                                    <th>PAYMENT DATE</th>
                                                                                    <th>CUSTOMER</th>
                                                                                    <th>AMOUNT PAID</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                                <?php
                                                                                $query = mysqli_query($con, "SELECT * FROM `part_payments_tb` INNER JOIN user ON user.user_id=part_payments_tb.user_id AND order_no='$orderNumber'") or die(mysqli_error($con));
                                                                                $grand = 0;

                                                                                while ($row = mysqli_fetch_array($query)) {
                                                                                    $total += $row['amount'];


                                                                                    echo ' <tr>
                                <td>
                                           ' . $row['date_added'] . '
                                        </td>
                                         <td>
                                           ' . $customerRows['customer_name'] . '
                                        </td>
                                        <td>
                                           ' . number_format($row['amount'], 2) . '
                                      
                            </tr>';
                                                                                }
                                                                                ?>


                                                                            </tbody>
                                                                        </table>


                                                                        <?php ?>

                                                                        <?php
                                                                        $query2 = mysqli_query($con, "select * from draft_temp_trans LEFT JOIN product ON product.prod_id=draft_temp_trans.prod_id where order_no='$orderNumber'  ") or die(mysqli_error($con));
                                                                        $grand = 0;
                                                                        while ($row2 = mysqli_fetch_array($query2)) {
                                                                            $total = $row2['price'] * $row2['qty'];
                                                                            $unitPrice = $row['price'] / $row2['qty'];

                                                                            $amount = $row2['amount'];
                                                                            $discount_type = $row2['discount_type'];
                                                                            if ($amount != "") {
                                                                                if ($discount_type == "Percentage") {
                                                                                    $newPrice = ($amount / 100) * ($row2['price'] * $row2['qty']);
                                                                                    //$newPrice = $price - $computedPrice;
                                                                                } else {
                                                                                    $newPrice = $amount;
                                                                                }
                                                                                $total = ($row2['price'] * $row2['qty']) - $newPrice;
                                                                            } else {
                                                                                $total = ($row2['price'] * $row2['qty']);
                                                                            }

                                                                            //$unitPrice = $row['price'] / $row['qty'];
                                                                            //$grand = $grand + $total;
                                                                            $totalDiscount += $newPrice;


                                                                            $grand = $grand + $total;
                                                                        }
                                                                        ?>

                                                                        <?php
                                                                        $query2 = mysqli_query($con, "SELECT SUM(amount) AS amount FROM `part_payments_tb` INNER JOIN user ON user.user_id=part_payments_tb.user_id AND order_no='$orderNumber'  ") or die(mysqli_error($con));
                                                                        $row2 = mysqli_fetch_array($query2);

                                                                        $balance = $grand - $row2['amount'];

                                                                        echo '<tr>
                                <td class="box" width="" style="border:2px solid black"><b><h4><u></u>
                                           ____________________________________________________________________________________________</br> 
                                    <br>  
                                     Total Amount To be Paid : ' . number_format($grand, 2) . '<br>    
                                    <br>
                                     Total Amount Paid : ' . number_format($row2['amount'], 2) . '<br>    
                    Balance to be Paid : ' . number_format($balance, 2) . '<br>                                           
                                           ___________________________________________________________________________________________ 
                                        </h4></b></td>
                            </tr>';
                                                                        ?>


                                                                        <tr>
                                                                            <td class="box" width="" style=" color: black"><b>
                                                                                    <h4>Issued By :
                                                                                        <?php
                                                                                        $query = mysqli_query($con, "select * from user where user_id='$id'") or die(mysqli_error($con));
                                                                                        $row = mysqli_fetch_array($query);

                                                                                        echo $row['name'];
                                                                                        ?>
                                                                                        <?php echo '<br>' . date("M d, Y"); ?> Time <?php
                                                                                        echo date("h:i A");
                                                                                        ?>
                                                                                    </h4>
                                                                                </b>
                                                                        </tr>

                                                                        </table>


                                                                        </div>

                                                                        </form>
                                                                        <br>

                                                                            </table>
                                                                            </table>
                                                                            </form>
                                                                            </div>

                                                                            </div>

                                                                            </div>

                                                                            </div>
                                                                            </body>

                                                                            </html>