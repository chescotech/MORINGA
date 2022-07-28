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
        <title>Home | <?php include('../dist/includes/title.php'); ?></title>
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
        <script src="../dist/js/jquery.min.js"></script>
        <script language="JavaScrip    t"><!--
        javascript:window.hist    ory.forward(1);
            //--></script>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav" onload="myFunction()">
            <div class="wrapper">
            <?php include('../dist/includes/header.php'); ?>
                <!-- Full Width Column -->
                <div class="content-wrapper">
                    <div class="container">
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                            <h1>
                                <a class="btn btn-lg btn-warning" href="sold-items.php">Back</a>
                            </h1>
                            <ol class="breadcrumb">
                                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                                <li class="active">Product</li>
                            </ol>
                        </section>

                        <!-- Main content -->
                        <section class="content">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h3 class="box-title">Payment History</h3>
                                        </div>
                                        <div class="box-body">
                                            <form method="post" action="add-complete-draft.php">
                                                <div class="row" style="min-height:400px">

                                                    <div class="col-md-6" hidden="">
                                                        <div class="form-group">
                                                            <label for="date">Product Name</label>
                                                            <select class="form-control select2" name="prod_name" tabindex="1" autofocus required>
                                                                <?php
                                                                $branch = $_SESSION['branch'];
                                                                $cid = $_REQUEST['cid'];
                                                                include('../dist/includes/dbcon.php');
                                                                $query2 = mysqli_query($con, "select * from product where branch_id='$branch' AND prod_qty >0 order by prod_name")or die(mysqli_error($con));
                                                                while ($row = mysqli_fetch_array($query2)) {
                                                                    ?>
                                                                        <option value="<?php echo $row['prod_id']; ?>"><?php echo $row['prod_name'] . " Available(" . $row['prod_qty'] . ")"; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <input type="hidden" class="form-control" name="cid" value="<?php echo $cid; ?>" required>   
                                                        </div><!-- /.form group -->
                                                    </div>


                                                    <div class="col-md-12">
                                                        <?php
                                                        $queryb = mysqli_query($con, "select balance from customer where cust_id='$cid'")or die(mysqli_error($con));
                                                        $rowb = mysqli_fetch_array($queryb);
                                                        $balance = $rowb['balance'];

                                                        if ($balance > 0)
                                                            $disabled = "disabled=true";else {
                                                            $disabled = "";
                                                        }
                                                        ?>
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>


                                                                    <th>Date Payment</th>
                                                                    <th>Entered By User</th>						           
                                                                    <th>Amount Paid</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $orderNumber = $_GET['orderno'];
                                                                $query = mysqli_query($con, "SELECT * FROM `part_payments_tb` INNER JOIN user ON user.user_id=part_payments_tb.user_id AND order_no='$orderNumber'  ")or die(mysqli_error($con));

                                                                $totalPaid = 0;
                                                                while ($row = mysqli_fetch_array($query)) {
                                                                    $id = $row['amount'];
                                                                    $totalPaid += $row['amount'];
                                                                    $unitPrice = $row['name'];
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $row['date_added']; ?></td>
                                                                            <td class="record"><?php echo $row['name']; ?></td>
                                                                            <td><?php echo number_format($row['amount'], 2); ?></td>


                                                                        </tr>


                                                                        <!--end of modal-->  
                                                                <?php } ?>	  <tr>
                                                                    <td> </td>
                                                                    <td class="record">Total Amount Paid</td>
                                                                    <td><?php
                                                                        echo number_format($totalPaid, 2);
                                                                        ?></td>


                                                                </tr>	
                                                                <tr>
                                                                    <td> </td>
                                                                    <td class="record">Total Amount Due</td>
                                                                    <td><?php
                                                                        $query2 = mysqli_query($con, "select * from draft_temp_trans LEFT JOIN product ON product.prod_id=draft_temp_trans.prod_id where draft_temp_trans.branch_id='$branch' AND draft_temp_trans.order_no='$orderNumber'  ")or die(mysqli_error($con));
                                                                        $grand = 0;
                                                                        $newPrice = 0;
                                                                        $totalDiscount = 0;
                                                                        while ($row2 = mysqli_fetch_array($query2)) {
                                                                            $total = $row2['price'] * $row2['qty'];
                                                                            $unitPrice = $row['price'] / $row2['qty'];
                                                                            $grand = $grand + $total;

                                                                            $amount = $row2['amount'];
                                                                            $discount_type = $row2['discount_type'];
                                                                            //echo '$new' . $amount;
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
                                                                        }
                                                                        $grand =$grand - $totalDiscount;
                                                                        echo number_format($grand, 2);
                                                                        ?></td>


                                                                </tr>

                                                                <tr>
                                                                    <td> </td>
                                                                    <td class="record">Balance</td>
                                                                    <td><?php
                                                                        $balance = $grand - $totalPaid;
                                                                        echo number_format($balance, 2);
                                                                        ?></td>


                                                                </tr>

                                                            </tbody>

                                                        </table>
                                                    </div><!-- /.box-body -->

                                                </div>	



                                            </form>	
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </div><!-- /.col (right) -->

                                <div class="col-md-3">
                                    <div class="box box-primary">

                                        <div class="box-body">
                                            <!-- Date range -->
                                            <form method="post" name="autoSumForm" action="add-partial-payment.php">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        $query2 = mysqli_query($con, "select * from draft_temp_trans LEFT JOIN product ON product.prod_id=draft_temp_trans.prod_id"
                                                                . " where draft_temp_trans.branch_id='$branch' AND draft_temp_trans.order_no='$orderNumber'  ")or die(mysqli_error($con));
                                                        $grand = 0;
                                                        while ($row2 = mysqli_fetch_array($query2)) {
                                                            $total = $row2['price'] * $row2['qty'];
                                                            $unitPrice = $row['price'] / $row2['qty'];
                                                            $grand = $grand + $total;
                                                        }
                                                        ?>

                                                        <div class="form-group" hidden="ds">
                                                            <label for="date">Discount</label>

                                                            <input type="text" class="form-control text-right" id="discount" name="discount" value="0" tabindex="6" placeholder="Discount                                                                    (Php)" onFocus="startCalc();" onBlur="stopCalc();">
                                                                   <input type="hidden" class="form-control text-right" id="cid" name="order_no" value="<?php echo $orderNumber; ?>">
                                                        </div><!-- /.form group -->
                                                        <div class="form-group">
                                                            <label for="date">Amount Due</label>

                                                            <input type="text" style="text-align:right" class="form-control" id="amount_due" name="amount_due" placeholder="Amount Due" value="<?php echo number_format($grand-$totalDiscount, 2); ?>" readonly>

                                                        </div><!-- /.form group -->


                                                        <div class="form-group" id="tendered">
                                                            <label for="date">Amount Paid</label><br>
                                                            <input type="text" style="text-align:right" class="form-control" onFocus="startCalc();" onBlur="stopCalc();"  id="cash" name="tendered" placeholder="Amo                                                        unt Paid"  autocomplete="off"  required="">                                                        
              </div><!--                                                             /.form group -->

 <div class="form-group">
							<label for="date">Mode Payment</label>       
          
                                                            <select class="form-control select2" name="payment_mode_id" tabindex="1">
                                                                <?php
                                                                $query2 = mysqli_query($con, "select * from modes_of_payment_tb")or die(mysqli_error($con));
                                                                while ($row = mysqli_fetch_array($query2)) {
                                                                    ?>
                                                                            <option value="<?php echo $row['payment_mode_id']; ?>"><?php echo $row['name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input type="hidden" class="form-control" name="cid" value="<?php echo $cid; ?>" >   
                                                                </div><!-- /.form group -->


                                                                </div>



                                                                </div>	



                                                                <button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="cash" type="submit"  tabindex="7">
                                                                    + Add Payment
                                                                </button>
                                                                <button class="btn btn-lg btn-block" id="daterange-btn" type="reset"  tabindex="8">
                                                                    <a href="cancel.php">Cancel Sale</a>
                                                                </button>

                                                                </form>	
                                                        </div><!-- /.box-body -->
                                                    </div><!-- /.box -->
                                                </div><!-- /.col (right) -->


                                        </div><!-- /.row -->


                                        </section><!-- /.content -->
                                    </div><!-- /.container -->
                                </div><!-- /.content-wrapper -->
                                <?php include('../dist/includes/footer.php'); ?>
                            </div><!-- ./wrapper -->
                            <script>



                                $(function () {

                                    $(".btn_delete").click(function () {
                                        var element = $(this);
                                        var id = element.attr("id");
                                        var dataString = 'id=' + id;
                                        if (confirm("Sure you want to delete this item?"))
                                        {
                                            $.ajax({
                                                type: "GET",
                                                url: "temp_trans_del.php",
                                                data: dataString,
                                                success: function () {

                                                }
                                            });
                                        }
                                        return false;
                                    });
                                });
    </script>
	
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

                                    <                                            script>
            $(function () {
                                                $("#example1").DataTable();
                                               $('#example2').Data                                                    Table({
            "paging": true,
                                                           "lengthChange": false,
                                                        "searching": false,
                                               "ordering                                          ": true, x`
          "info":                                        true,
                                           "auto                                        Width": false
                                        });
      });
    </script>
                                <script>
                                $(function () {
                                    //Initialize Select2 Elements
                                    $(".select2").select2();

                                    //Datemask dd/mm/yyyy
                                    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                                    //Datemask2 mm/dd/yyyy
                                    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                                    //Money Euro
                                    $("[data-mask]").inputmask();

                                    //Date range picker
                                    $('#reservation').daterangepicker();
                                    //Date range picker with time picker
                                    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                                    //Date range as a button
                                    $('#daterange-btn').daterangepicker(
                                            {
                                                ranges: {
                                                    'Today': [moment(), moment()],
                                                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                                                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                                },
                                                startDate: moment().subtract(29, 'days'),
                                                endDate: moment()
                                            },
                                            function (start, end) {
                                                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                                            }
                                    );

                                    //iCheck for checkbox and radio inputs
                                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                                        checkboxClass: 'icheckbox_minimal-blue',
                                        radioClass: 'iradio_minimal-blue'
                                    });
                                    //Red color scheme for iCheck
                                    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                                        checkboxClass: 'icheckbox_minimal-red',
                                        radioClass: 'iradio_minimal-red'
                                    });
                                    //Flat red color scheme for iCheck
                                    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                                        checkboxClass: 'icheckbox_flat-green',
                                        radioClass: 'iradio_flat-green'
                                    });

                                    //Colorpicker
                                    $(".my-colorpicker1").colorpicker();
                                    //color picker with addon
                                    $(".my-colorpicker2").colorpicker();

                                    //Timepicker
                                    $(".timepicker").timepicker({
                                        showInputs: false
                                    });
                                });
                                            </script>
                                            </body>
                                            </html>
