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
        <title>Draft Report | <?php include('../dist/includes/title.php'); ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
        <script src="../plugins/datatables/table-exporter.js"></script>
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="../plugins/iCheck/all.css">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="../plugins/select2/select2.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <script type="text/javascript" src="../dist/js/jquery.min.js"></script>
        <script type="text/javascript" src="../dist/js/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css" />

        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="../plugins/daterangepicker/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="../plugins/daterangepicker/daterangepicker.css" />

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(line_chart);

            function line_chart()
            {
                var jsonData = $.ajax({
                    url: 'get-sales-revenue-stats.php',
                    dataType: "json",
                    async: false,
                    success: function (jsonData)
                    {
                        var options =
                                {
                                    legend: 'none',
                                    hAxis: {minValue: 0, maxValue: 9},
                                    curveType: 'function',
                                    pointSize: 7,
                                    dataOpacity: 0.3
                                };
                        var data = new google.visualization.arrayToDataTable(jsonData);
                        var chart = new google.visualization.LineChart(document.getElementById('line_chart'));
                        chart.draw(data, options);
                    }
                }).responseText;
            }
        </script>

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
                .angel{
                    display:none !important;
                }

            }
        </style>
    </head>

    <body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav">
        <div class="wrapper">
            <?php
            include('../dist/includes/header_admin.php');
            include ('../Objects/Objects.php');
            $Objects = new InvObjects();
            ?>           
            <div class="content-wrapper">              
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title" style=" color: black"><b>Credit Sales Report</b></h3>
                                </div>
                                <?php
                                if (isset($_POST['display'])) {
                                    $_SESSION['sales_date'] = $_POST['date'];
                                } else {
                                    unset($_SESSION['sales_date']);
                                }
                                ?>
                                <div class="box-body">
                                    <button id="btnExport" onclick="javascript:xport.toCSV('example2');"> Export to CSV</button>
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>                                                   
                                                <th>Customers Name</th>                                                    
                                                <th>Order Number</th>
                                                <th>Entered By</th>
                                                <th>Credit Duration</th>
                                                <th>Transaction Date / Modified</th>  
                                                <th>View Order</th>  
                                                <th>Partial Payment</th>
                                                <th>Manage Order</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $totalAmountCollected = 0;
                                            $query = mysqli_query($con, "SELECT date,customer_name,order_no,SUM(qty) AS totalqty,SUM(price) AS total,name FROM `draft_temp_trans` INNER JOIN user ON user.user_id=draft_temp_trans.user_id  GROUP BY order_no")or die(mysqli_error($con));
                                            while ($row = mysqli_fetch_array($query)) {
                                                $totalAmountCollected += $row['total'];
                                                $orderNo = $row['order_no'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['customer_name']; ?></td>                                                        
                                                    <td><?php echo $row['order_no']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php
                                                        $date1 = new DateTime($row['date']);
                                                        $date2 = new DateTime(date('Y-m-d H:i:s'));
                                                        ;
                                                        $diff = $date1->diff($date2);

                                                        echo $diff->m . " months, " . $diff->d . " days ";
                                                        ?></td>
                                                    <td><?php echo $row['date']; ?></td> 
                                                    <td>
                                                        <a href="view-draft-order.php?orderno=<?php echo $row['order_no']; ?>" style="color: #003eff "><b>View Order</b></i></a>
                                                    </td>

                                                    <td>
                                                        <a href="partial_payment_add.php?orderno=<?php echo $row['order_no']; ?>" style="color: #003eff "><b>
                                                                <?php
                                                                $query2 = mysqli_query($con, "SELECT COUNT(*) AS nopayments FROM  part_payments_tb WHERE order_no='$orderNo' ")or die(mysqli_error($con));
                                                                $row2 = mysqli_fetch_array($query2);
                                                                echo '( ' . $row2['nopayments'] . ' ) Partial Payments';
                                                                ?>                                                                
                                                            </b></i></a>
                                                    </td>

                                                    <td>
                                                        <a href="manage-order.php?orderno=<?php echo $row['order_no']; ?>" style="color: #003eff "><b>Manage Order</b></i></a>
                                                    </td>
                                                </tr>                  
                                            <?php } ?>
                                            <tr>  
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total Amount</td>
                                                <td><?php echo 'K ' . number_format($totalAmountCollected, 2); ?></td>
                                            </tr>

                                        </tbody>                                        
                                    </table>
                                </div><!-- /.box-body -->
                            </div>
                        </div>
                </section><!-- /.content -->
                </section><!-- /.content -->
            </div>
        </div>
        <?php include('../dist/includes/footer.php'); ?>
    </div>
    <script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>       
    <script src="../bootstrap/js/bootstrap.min.js"></script>      
    <script src="../plugins/select2/select2.full.min.js"></script>       
    <script src="../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.js"></script>
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
                                                "paging": false,
                                                buttons: [
                                                    'csv', 'excel', 'pdf', 'print'
                                                ],
                                                "lengthChange": false,
                                                "searching": true,
                                                "ordering": false,
                                                "info": true,
                                                "autoWidth": false
                                            });
                                            //Initialize Select2 Elements
                                            $(".select2").select2();
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
                                                        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                                                    }
                                            );

                                            //Date picker
                                            $('#datepicker').datepicker({
                                                autoclose: true
                                            });

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
                                        }
                                        );
    </script>
</body>
</html>
