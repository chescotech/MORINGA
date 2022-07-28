<?php
session_start();
if (empty($_SESSION['id'])) :
    header('Location:../index.php');
endif;
if (empty($_SESSION['branch'])) :
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
                                        <h3 class="box-title">Sales Transaction</h3>
                                    </div>
                                    <div class="box-body">
                                        <!-- Date range -->
                                        <form method="post" action="add-complete-draft.php">
                                            <div class="row" style="min-height:400px">

                                                <div class="col-md-12">

                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Qty</th>
                                                                <th>Product Name</th>
                                                                <th>Unit Price</th>
                                                                <th>Total</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $orderNumber = $_GET['orderno'];
                                                            $query = mysqli_query($con, "select * from draft_temp_trans LEFT JOIN product ON product.prod_id=draft_temp_trans.prod_id "
                                                                    . "where draft_temp_trans.branch_id='$branch' AND draft_temp_trans.order_no='$orderNumber'  ") or die(mysqli_error($con));
                                                            $grand = 0;
                                                            $totalDiscount = 0;
                                                            $newPrice = 0;
                                                            while ($row = mysqli_fetch_array($query)) {

                                                                $id = $row['temp_trans_id'];
                                                                $total = $row['price'] * $row['qty'];
                                                                $unitPrice = $row['price'] / $row['qty'];
                                                                $grand = $grand + $total;
                                                                $customer_name = $row['customer_name'];
                                                                $cust_id = $row['cust_id'];

                                                                $amount = $row['amount'];
                                                                $discount_type = $row['discount_type'];
                                                                if ($amount != "") {
                                                                    if ($discount_type == "Percentage") {
                                                                        $newPrice = ($amount / 100) * ($row['price'] * $row['qty']);
                                                                        //$newPrice = $price - $computedPrice;
                                                                    } else {
                                                                        $newPrice = $amount;
                                                                    }
                                                                    $total = ($row['price'] * $row['qty']) - $newPrice;
                                                                } else {
                                                                    $total = ($row['price'] * $row['qty']);
                                                                }

                                                                //$unitPrice = $row['price'] / $row['qty'];
                                                                //$grand = $grand + $total;
                                                                $totalDiscount += $newPrice;
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $row['qty']; ?></td>
                                                                    <td class="record"><?php
                                                                        if ($row['prod_name'] == '') {
                                                                            echo $row['description'];
                                                                        } else {
                                                                            echo $row['prod_name'];
                                                                        }
                                                                        ?></td>
                                                                    <td><?php echo number_format($row['price'], 2); ?></td>
                                                                    <td><?php echo number_format($total, 2); ?></td>

                                                                </tr>
                                                            <div id="updateordinance<?php echo $row['temp_trans_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="height:auto">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span></button>
                                                                            <h4 class="modal-title">Update Sales Details</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="form-horizontal" method="post" action="transaction_update.php" enctype='multipart/form-data'>
                                                                                <input type="hidden" class="form-control" name="cid" value="<?php echo $cid; ?>" required>
                                                                                <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['temp_trans_id']; ?>" required>
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-lg-3" for="price">Qty</label>
                                                                                    <div class="col-lg-9">
                                                                                        <input type="text" class="form-control" id="price" name="qty" value="<?php echo $row['qty']; ?>" required>
                                                                                    </div>
                                                                                </div>

                                                                        </div><br>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                                <!--end of modal-dialog-->
                                                            </div>
                                                            <!--end of modal-->
                                                            <div id="delete<?php echo $row['temp_trans_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="height:auto">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span></button>
                                                                            <h4 class="modal-title">Delete Item</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="form-horizontal" method="post" action="transaction_del.php" enctype='multipart/form-data'>
                                                                                <input type="hidden" class="form-control" name="cid" value="<?php echo $cid; ?>" required>
                                                                                <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['temp_trans_id']; ?>" required>
                                                                                <p>Are you sure you want to remove <?php echo $row['prod_name']; ?>?</p>

                                                                        </div><br>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Delete</button>
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                                <!--end of modal-dialog-->
                                                            </div>
                                                            <!--end of modal-->
<?php } ?>
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
                                        <form method="post" name="autoSumForm" action="add-complete-draft.php">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php
                                                    // giftps 2045.. Get the amount paid on order
                                                    $gt_q = mysqli_query($con, "SELECT SUM(amount) AS amount FROM part_payments_tb WHERE order_no = '$orderNumber' ")or die(mysqli_error($con));
                                                    $gt_r = mysqli_fetch_array($gt_q);
                                                    $paid_so_far = $gt_r['amount'];
                                                    $amount_total = $grand - $totalDiscount;
                                                    $amount_due = $amount_total - $paid_so_far;
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="date">Total</label>

                <!-- <input type="text" style="text-align:right" class="form-control" id="old_total" name="total" value="20" onFocus="startCalc();" onBlur="stopCalc();" tabindex="5" readonly> -->
                                                        <input type="text" style="text-align:right" class="form-control" id="old_total" name="total" value="<?php echo $amount_due; ?>" onFocus="startCalc();" onBlur="stopCalc();" tabindex="5" readonly>

                                                    </div>

                                                    <div class="form-group" hidden="">
                                                        <label for="date">Total</label>
                                                        <input type="text" style="text-align:right" class="form-control" name="orderno" placeholder="Total" value="<?php echo $_GET['orderno']; ?>" tabindex="5" readonly>
                                                        <input type="text" style="text-align:right" class="form-control" name="cust_name" placeholder="Total" value="<?php echo $cust_id; ?>" tabindex="5" readonly>
                                                    </div>

                                                    <div class="form-group" hidden="ds">
                                                        <label for="date">Discount</label>
                                                        <input type="text" class="form-control text-right" id="discount" name="discount" value="0" tabindex="6" placeholder="Discount (Php)" onFocus="startCalc();" onBlur="stopCalc();">
                                                        <input type="hidden" class="form-control text-right" id="cid" name="cid" value="<?php echo $cid; ?>">
                                                    </div><!-- /.form group -->



                                                    <div class="form-group">
                                                        <label for="date">Amount Due</label>

                                                        <input type="text" style="text-align:right" class="form-control" id="amount_due" name="amount_due" placeholder="Amount Due" value="<?php echo $amount_due; ?>" readonly>

                                                    </div><!-- /.form group -->

                                                    <div class="form-group">
                                                        <label for="date">Discount</label>
                                                        <input type="text" style="text-align:right" class="form-control" id="amount_due" name="discount" placeholder="Amount Due" value="<?php echo $totalDiscount; ?>" readonly>
                                                    </div><!-- /.form group -->


                                                    <div class="form-group" id="tendered">
                                                        <label for="date">Cash Tendered</label><br>
                                                        <input type="text" style="text-align:right" class="form-control" onFocus="startCalc();" onBlur="stopCalc();" id="cash_paid" name="tendered" placeholder="Cash Tendered" autocomplete="off" required="">
                                                    </div><!-- /.form group -->

                                                    <div class="form-group" id="tendered">
                                                        <label for="date">New Total</label><br>
                                                        <input type="text" style="text-align:right" class="form-control" id="new_total" name="new_total" value="<?php echo $amount_due; ?>" readonly>
                                                    </div><!-- /.form group -->

                                                    <script>
                                                        // giftps 1124
                                                        $('#cash_paid').change(function () {
                                                            var old_total = $('#amount_due').val();
                                                            var cash_paid = $('#cash_paid').val();
                                                            var new_total = old_total - cash_paid;
                                                            $('#new_total').val(new_total);
                                                            // alert(new_total);
                                                        });
                                                        // var new_total = $('#new_total').val();
                                                    </script>

                                                    <div class="form-group" id="change">
                                                        <label for="date">Change</label><br>
                                                        <input type="text" style="text-align:right" class="form-control" id="changed" name="change" placeholder="Change">
                                                    </div><!-- /.form group -->

                                                    <div class="form-group">
                                                        <label for="date">Mode Payment</label>

                                                        <select class="form-control select2" name="payment_mode_id" tabindex="1">
                                                            <?php
                                                            $query2 = mysqli_query($con, "select * from modes_of_payment_tb") or die(mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($query2)) {
                                                                ?>
                                                                <option value="<?php echo $row['payment_mode_id']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <input type="hidden" class="form-control" name="cid" value="<?php echo $cid; ?>">
                                                    </div><!-- /.form group -->
                                                </div>

                                            </div>

                                            <button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="cash" type="submit" tabindex="7">
                                                Complete Sales
                                            </button>
                                            <button class="btn btn-lg btn-block" id="daterange-btn" type="reset" tabindex="8">
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
                    if (confirm("Sure you want to delete this item?")) {
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

        <script>
            $(function () {
                $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
        </script>
        <script>
            $(function () {
                //Initialize Select2 Elements
                $(".select2").select2();

                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {
                    "placeholder": "dd/mm/yyyy"
                });
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {
                    "placeholder": "mm/dd/yyyy"
                });
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    format: 'MM/DD/YYYY h:mm A'
                });
                //Date range as a button
                $('#daterange-btn').daterangepicker({
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