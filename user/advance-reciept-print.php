<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
error_reporting(0);
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Invoice</title>
    </head>

    <style type="text/css">
        body{
            background-color:#999;}
        .wrapper{
            background-color:#FFF;
            width:100%;

            margin:auto;
        }
        .name{
            background-color:#fff;

            width:100%;
            float:left;

        }
        .name_{
            background-color:#fff;

            width:100%;
            float:left;
        }
        .payslip{
            background-color:#fff;

            width:100%;
            float:left;
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

        <style type="text/css">
        h5,h6{
            text-align:center;
        }

        @media print {
            .btn-print {
                display:none !important;
            }
            .main-footer	{
                display:none !important;
            }
            .box.box-primary {
                border-top:none !important;
            }


        }
    </style>
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

        <body class="hold-transition skin-blue layout-top-nav"  onload="window.print()" onfocus="window.close()" style=" background-color: white ">
            <div class="wrapper" title="">
                <div class="body"></div>            
                <div class="body">
                    <div class="name"></div>
                    <div class="name_">

                        <?php include('../dist/includes/dbcon.php'); ?>

                        <form method="post" action="entry.php" onSubmit="return proceed()">
                            <table border="0" align="center" width="150000" class="top1" >
                                ####################################################
                                <h3 style="color: black ">
                                    <b>
                                        <?php
                                        $id = $_SESSION['id'];
                                        $branch = $_SESSION['branch'];
								$orderNumber = $_GET['orderno'];
                                        $queryb = mysqli_query($con, "select * from branch")or die(mysqli_error($con));
                                        $rowb = mysqli_fetch_array($queryb);
                                        echo $rowb['branch_name'] . '<br>' . $rowb['branch_address'] . '<br>' . $rowb['branch_contact'] . '<br>';
                                        ?>                                
                                    </b></h3>
                                ####################################################
                                
                         
                                <?php
                                $query = mysqli_query($con, "select prod_name,prod_sell_price,SUM(qty) AS qty,amount,customer_name from advance_payments_tb INNER JOIN product ON product.prod_id=advance_payments_tb.prod_id AND advance_payments_tb.order_no='$orderNumber'  group by prod_name ")or die(mysqli_error($con));
                                $grand = 0;
                                
                                 $query2 = mysqli_query($con, "select prod_name,prod_sell_price,SUM(qty) AS qty,amount,customer_name from advance_payments_tb INNER JOIN product ON product.prod_id=advance_payments_tb.prod_id AND advance_payments_tb.order_no='$orderNumber'  group by prod_name ")or die(mysqli_error($con));
                               
                                $row2 = mysqli_fetch_array($query2);
                                $customer_name = $row2['customer_name'];
                                
                                echo '<h3><u>Payment Reciept To : '.$customer_name.' </u></h3>';
                                
                                echo '<h3><u>Items Bought</u></h3>';
                                
                                while ($row = mysqli_fetch_array($query)){                                   
                                    //$temp_trans_id = $row['temp_trans_id'];
                                    $prodName = $row['prod_name'];
                                    $price = number_format($row['prod_sell_price'], 2);
                                    $total = $row['qty'] * $row['prod_sell_price'];
                                    $grand = $grand + $total;
                                    $advanceAmount= $row['amount'];
                                    
                                    //mysqli_query($con, "update draft_temp_trans set is_printed='1' where temp_trans_id='$temp_trans_id'")or die(mysqli_error($con));

                                    echo ' <tr>
                                <td class="box" width="" style=" color: black"><b><h2><u></u>
                                            ' . $row['qty'] . ' ' . substr($prodName, 0, 20)  . ' - @ K ' . $price . ' / item = K ' . number_format($total, 2) . '
                                        </h2></b></td>
                            </tr>';
                                }

                                $total = number_format($grand - $discount, 2);
                                echo '<tr>
                                <td class="box" width="" style=" color: black"><b><h2><u></u>
                                           ........................................................................................</br> 
                                           Total Amount Due K ' . number_format($total,2) . '<br>    
                                           Advance Amount Paid K ' . number_format($advanceAmount,2) . '        
                                           <br>.........................................................................................</br>    
                                        </h2></b></td>
                            </tr>';
                                ?>


                                <tr>
                                    <td class="box" width="" style=" color: black"><b><h2><u>ISSUED BY USER: </u> 
                                                <?php
                                                $query = mysqli_query($con, "select * from user where user_id='$id'")or die(mysqli_error($con));
                                                $row = mysqli_fetch_array($query);

                                                echo $row['name'];
                                                ?> 
                                               
											   
											   <?php echo '<br></br>' . date("M d, Y"); ?> Time <?php echo date("h:i A"); ?>
											   
											   
                                            </h2></b></td>
                                </tr>

                            </table>


                    </div>

                    </form>
                    <br>

                        </table>
                        </table>
                    </form></div>

            </div>

            </div>

            </div>
        </body>
</html>

<a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> <button style=" background-color: blue">Print</button></a>
<a class = "btn btn-primary btn-print" href = "advance-payment.php"><i class ="glyphicon glyphicon-arrow-left"></i><button style=" background-color: green ">BACK</button></a>