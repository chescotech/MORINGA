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
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <style>
            .col-lg-3{
                margin:50px 0px;
            }
        </style>
    </head>
    <body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav" onload="myFunction()">
        <div class="wrapper">
            <?php include('../dist/includes/header_warehouse.php'); ?>           
            <div class="content-wrapper">
                <div class="container">
                    <section class="content">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title" style=" color: black"><b>Home Dashboard</b></h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="row">
                                            <a href="users.php" style=" color: white">
                                                <div class="col-lg-4 col-xs-6">
                                                    <!-- small box -->
                                                    <div class="small-box bg-green">
                                                        <div class="inner">
                                                            <h3>Users</h3>
                                                            <p>Users</p>
                                                        </div>
                                                        <div class="icon" style="margin-top:10px">
                                                            <i class="glyphicon glyphicon-user"></i>
                                                        </div>
                                                        <a href="users.php" class="small-box-footer">
                                                            Go <i class="fa fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="products-in-stock.php" style=" color: white">
                                                <div class="col-lg-4 col-xs-6">
                                                    <!-- small box -->
                                                    <div class="small-box bg-fuchsia">
                                                        <div class="inner">
                                                            <h3>Stock</h3>
                                                            <p>Products</p>
                                                        </div>
                                                        <div class="icon" style="margin-top:10px">
                                                            <i class="glyphicon glyphicon-share-alt"></i>
                                                        </div>
                                                        <a href="products-in-stock.php" class="small-box-footer">
                                                            Go <i class="fa fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="profile.php" style=" color: white">
                                                <div class="col-lg-4 col-xs-6">
                                                    <!-- small box -->
                                                    <div class="small-box bg-red">
                                                        <div class="inner">
                                                            <h3>My</h3>
                                                            <p>Account</p>
                                                        </div>
                                                        <div class="icon" style="margin-top:10px">
                                                            <i class="glyphicon glyphicon-user"></i>
                                                        </div>
                                                        <a href="profile.php" class="small-box-footer">
                                                            Go <i class="fa fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div><!-- ./col -->
                                            </a>
                                       
                                          
                                        </div>
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

                        $(this).parents(".record").animate({backgroundColor: "#fbc7c7"}, "fast")
                                .animate({opacity: "hide"}, "slow");
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
