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
        <body onload="window.print()">
            <div class="wrapper" title="">
            <div class="body"></div>            
            <div class="body">
                <div class="name"></div>
                <div class="name_">

                    <?php include('../dist/includes/dbcon.php'); ?>
                    <?php
                    /*
                      $regId = $_GET['reg_id'];
                      $query = mysql_query("SELECT * FROM client_partners_tb WHERE id ='$regId' ")or die(mysql_error());
                      $row = mysql_fetch_array($query);
                     */
                    ?>

                    <form method="post" action="entry.php" onSubmit="return proceed()">
                        <table border="0" align="center" width="150000" class="top1" >
                            ####################################################
                            <h3 style="color: black ">
                                <b>
                                    <?php
                                    $id = $_SESSION['id'];
                                    $queryb = mysqli_query($con, "select * from branch")or die(mysqli_error($con));
                                    $rowb = mysqli_fetch_array($queryb);
                                    echo $rowb['branch_name'] . '<br>' . $rowb['branch_address'] . '<br>' . $rowb['branch_contact'].'<br>';
                                    ?>                                
                                </b></h3>
                            ####################################################
                            <?php
                            $branch = $_SESSION['branch'];
                            $query = mysqli_query($con, "SELECT * FROM `sales` WHERE sales_id = (SELECT MAX(sales_id) FROM sales )")or die(mysqli_error($con));

                            $row = mysqli_fetch_array($query);

                            $sales_id = $row['sales_id'];
                            $sid = $row['sales_id'];
                            $due = $row['amount_due'];
                            $discount = $row['discount'];
                            $grandtotal = $due - $discount;
                            $tendered = $row['cash_tendered'];
                            $change = $row['cash_change'];

                            $query1 = mysqli_query($con, "select * from payment where sales_id='$sales_id'")or die(mysqli_error($con));

                            $row1 = mysqli_fetch_array($query1);
                            ?>

                            <?php
                            $query = mysqli_query($con, "select * from sales_details natural join product where sales_id='$sid'")or die(mysqli_error($con));
                            $grand = 0;

                            while ($row = mysqli_fetch_array($query)) {
                                $prodName = $row['prod_name'];
                                $price = number_format($row['prod_sell_price'], 2);
                                $total = $row['qty'] * $row['prod_sell_price'];
                                $grand = $grand + $total;

                                echo ' <tr>
                                <td class="box" width="" style=" color: black"><b><h2><u></u>
                                            ' . $row['qty'] . ' ' . $prodName . ' - @ K ' . $price . ' / item = K ' . number_format($total, 2) . '
                                        </h2></b></td>
                            </tr>';
                            }
                           
                            $total = number_format($grand - $discount, 2);
                            echo '<tr>
                                <td class="box" width="" style=" color: black"><b><h2><u></u>
                                           ......................................................................................</br> 
                                           Total Amount K ' . $total . '<br>
                                           Cash Tendered : '.number_format($tendered, 2).'<br>
                                           Change : '.number_format($change, 2).'    
                                           <br>......................................................................................</br>    
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
                                            <?php echo '<br></br>'.date("M d, Y"); ?> Time <?php echo date("h:i A"); ?>
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
