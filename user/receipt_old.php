<?php
session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;
if (empty($_SESSION['branch'])):
    header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Receipt | <?php include('../dist/includes/title.php'); ?></title>
        <!-- Tell the browser to be responsive to screen width -->
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
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-blue layout-top-nav" onload="window.print()" style=" background-color: white ">
        <div class="wrapper">
            <div class="content-wrapper">
                <div class="container">
                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                </div>
                                <div class="box-body">
                                    <!-- Date range -->
                                    <form method="post" action="">
                                        <?php
                                        include('../dist/includes/dbcon.php');
                                        $id = $_SESSION['id'];
                                        $branch = $_SESSION['branch'];
                                        $queryb = mysqli_query($con, "select * from branch where branch_id='$branch'")or die(mysqli_error($con));

                                        $rowb = mysqli_fetch_array($queryb);
                                        ?>			

                                        <?php
                                        $branch = $_SESSION['branch'];
                                        $query = mysqli_query($con, "SELECT * FROM `sales` WHERE sales_id = (SELECT MAX(sales_id) FROM sales ) AND branch_id='$branch'")or die(mysqli_error($con));

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
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="3"><h5><b><?php echo $rowb['branch_name']; ?></b></h5></th>
                                                    <th><b>SALES INVOICE</b></th>
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <th>Order Number</th>
                                                    <th><?php echo $row['order_no'] ?></th>
                                                    <th>Date</th>
                                                    <th><?php echo date("M d, Y"); ?> Time <?php echo date("h:i A"); ?></th>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <th><?php echo $rowb['branch_address']; ?></th>
                                                    <th>Contact</th>
                                                    <th><?php echo $rowb['branch_contact']; ?></th>
                                                </tr>                                                
                                            </thead>
                                        </table>
                                        <table class="table">
                                            <thead>
                                                <tr style="border: solid 1px #000">
                                                    <th>QTY</th>
                                                    <th>UNIT</th>
                                                    <th>Item</th>
                                                    <th>Unit Price</th>
                                                    <th class="text-right">AMOUNT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($con, "select * from sales_details natural join product where sales_id='$sid'")or die(mysqli_error($con));
                                                $grand = 0;
                                                while ($row = mysqli_fetch_array($query)) {
                                                    //$id=$row['temp_trans_id'];
                                                    $total = $row['qty'] * $row['prod_sell_price'];
                                                    $grand = $grand + $total;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['qty']; ?></td>
                                                        <td>pc/s</td>
                                                        <td class="record"><?php echo $row['prod_name']; ?></td>
                                                        <td><?php echo number_format($row['prod_sell_price'], 2); ?></td>
                                                        <td style="text-align:right"><?php echo number_format($total, 2); ?></td>
                                                    </tr>
                                                <?php } ?>					
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">Subtotal</td>
                                                    <td style="text-align:right"><?php echo number_format($grand, 2); ?></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">VAT Inc</td>
                                                    <td style="text-align:right"> @ 16%</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><b>TOTAL AMOUNT DUE</b></td>
                                                    <td style="text-align:right"><b><?php echo number_format($grand - $discount, 2); ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right">Cash Tendered</td>
                                                    <td style="text-align:right"><?php echo number_format($tendered, 2); ?></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><b>Change</b></td>
                                                    <td style="text-align:right"><b><?php echo number_format($change, 2); ?></b></td>
                                                </tr> 
                                                <tr>
                                                    <th>Prepared by:</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr> 
                                                <?php
                                                $query = mysqli_query($con, "select * from user where user_id='$id'")or die(mysqli_error($con));
                                                $row = mysqli_fetch_array($query);
                                                ?>                      
                                                <tr>
                                                    <th><?php echo $row['name']; ?></th>
                                                    <th></th>
                                                    <th></th><br></br>
                                                <th><u><?php echo $rowb['reciept_footer_text'] ?></u></th>
                                                </tr>  
                                            </tbody>
                                        </table>
                                </div>
                            </div>  
                            </form>	
                        </div><!-- /.box-body -->
                        <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
                        <a class = "btn btn-primary btn-print" href = "cash_transaction.php"><i class ="glyphicon glyphicon-arrow-left"></i>NEXT SALE</a>
                </div><!-- /.box -->
            </div><!-- /.col (right) -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.container -->
</div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->


<script type="text/javascript" src="autosum.js"></script>
<!-- jQuery 2.1.4 -->
<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../dist/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/select2/select2.full.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

</body>
</html>
