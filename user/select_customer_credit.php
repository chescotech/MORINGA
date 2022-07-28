<?php session_start();
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
                <section class="content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Select Customer to Proceed.</h3>
                                    <?php
                                    $userId = $_SESSION['id'];
                                    $today = date("Y-m-d H:i:s");
                                    $totalAmountCollected = 0;
                                    $openSalesQuery = mysqli_query($con, "SELECT login FROM open_close_cashout_tb WHERE user_id='$userId' AND status=''");
                                    $openrows = mysqli_fetch_array($openSalesQuery);
                                    $loginTime = $openrows['login'];

                                    $query2 = mysqli_query($con, "SELECT SUM(qty) AS qty, prod_sell_price  "
                                        . "FROM sales_details INNER JOIN sales ON sales.sales_id=sales_details.sales_id INNER JOIN user ON user.user_id = sales.user_id "
                                        . "INNER JOIN product ON product.prod_id = sales_details.prod_id"
                                        . " AND sales.date_added >= '$loginTime' AND sales.date_added <= '$today' AND user.user_id='$userId' GROUP BY prod_name,stock_branch_id") or die(mysqli_error($con));

                                    while ($row = mysqli_fetch_array($query2)) {
                                        $totalSold = $row['qty'] * $row['prod_sell_price'];
                                        $totalAmountCollected += $totalSold;
                                    }

                                    $cahsoutLimitQuery = mysqli_query($con, " SELECT * FROM cashout_limits_tb WHERE status ='Active' ") or die(mysqli_error($con));
                                    $row2 = mysqli_fetch_array($cahsoutLimitQuery);
                                    $limit = $row2['cashoutlimit'];
                                    $found = mysqli_num_rows($cahsoutLimitQuery);
                                    ?>
                                    <br>
                                    <?php

                                    if ($found != "0") {
                                        if ($totalAmountCollected > $limit) {
                                            echo ' <h2 class="box-title" style=" color: red"><b>You have exceeded your Selling Limit of : ' . number_format($limit, 2) . ' please cashout !!
                  </b></h2>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="box-body">
                                    <?php
                                    if (isset($_POST['addtocart'])) {
                                        $barcode = $_POST['barcode'];
                                        //$query = mysql_query(" INSERT INTO barcode VALUES ('','$barcode',now())");
                                        echo $barcode . '<br>';
                                        //header("LOCATION:test-barcode.php");6001068379101
                                    }
                                    ?>
                                    <form method="post" action="draft-order.php">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="tendered">
                                                    <label for="date">Select Customer</label><br>
                                                    <select class="form-control select2" name="selected_cust_id" tabindex="1">
                                                        <option value="none">-- Select Customer --</option>
                                                        <?php
                                                        include('../dist/includes/dbcon.php');
                                                        $query2 = mysqli_query($con, "select * from customer ") or die(mysqli_error($con));
                                                        while ($row = mysqli_fetch_array($query2)) {
                                                        ?>
                                                            <option value="<?php echo $row['cust_first'] . '' . $row['cust_last']; ?>"><?php echo " ( " . $row['cust_first'] . ' - ' . $row['cust_last'] . " ) "; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div><!-- /.form group -->

                                                <a style=" color: blue" href="cust_new.php?type=cash"><b>Add New Customer</b></a><br></br>

                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="date"></label>
                                                    <div class="input-group">
                                                        <button class="btn btn-lg btn-primary" type="submit" tabindex="3" name="addtocart">Next</button>
                                                    </div>
                                                </div>
                                    </form>


                                    <div id="add_service" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="height:auto">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Add Item To Bill.</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" method="post" action="add-item-to-bill.php" enctype='multipart/form-data'>
                                                        <div class="col-md-12">
                                                        </div>

                                                        <label>Description:</label>
                                                        <input type="text" class="form-control" id="price" name="description" required autocomplete="off">

                                                        <label>Price:</label>
                                                        <input type="text" class="form-control" id="price" name="price" required autocomplete="off">

                                                        <label>Quantity:</label>
                                                        <input type="text" class="form-control" id="price" name="qty" required autocomplete="off">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--end of modal-dialog-->

                                    </div>

                                </div>


                            </div>



                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
            </div><!-- /.col (right) -->



            <div id="discount_all" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content" style="height:auto">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title"> Apply Discount to
                                <?php echo ' K ' . number_format($grand, 2); ?></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post" action="add-discount-all.php" enctype='multipart/form-data'>
                                <table>
                                    <tr id="service">
                                        <td> <span>Discount Type:</span>
                                        </td>
                                        <td>
                                            <select class="form-control select4" name="discount_type" tabindex="1">
                                                <option value="Percentage">
                                                    Percentage
                                                </option>
                                            </select>
                                        </td>

                                        <td> <span>Value :</span>
                                        </td>

                                        <td>
                                            <input type="text" name="amount" class="amount" autocomplete="off" />
                                        </td>
                                    </tr>
                                </table>
                        </div><br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Apply</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.row -->


        </section><!-- /.content -->
    </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
    <?php include('../dist/includes/footer.php'); ?>
    </div><!-- ./wrapper -->
    <script>
        $(function() {

            $(".btn_delete").click(function() {
                var element = $(this);
                var id = element.attr("id");
                var dataString = 'id=' + id;
                if (confirm("Sure you want to delete this item?")) {
                    $.ajax({
                        type: "GET",
                        url: "temp_trans_del.php",
                        data: dataString,
                        success: function() {

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
        $(function() {
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
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {
                "placeholder": "dd/mm/yyyy"
            });
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {
                "placeholder`": "mm/dd/yyyy"
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
                function(start, end) {
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