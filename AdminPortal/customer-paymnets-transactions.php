<?php
session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Customer | <?php include('../dist/includes/title.php'); ?></title>
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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="../plugins/datatables/table-exporter.js"></script>
        <style>

        </style>
    </head>

    <body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav">
        <div class="wrapper">
            <?php
            include('../dist/includes/header_admin.php');
            include('../dist/includes/dbcon.php');
            ?>
            <div class="content-wrapper">
                <div class="container">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">                     
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Customer Payment History</li>
                        </ol>
                    </section>

                    <section class="content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        
                                        <a href="customer.php"> Back to Customers</a>
                                        <br></br>
                                        <h3 class="box-title">Customer Payment History</h3>
                                    </div>
                                    <div class="box-body">
                                        <button id="btnExport" onclick="javascript:xport.toCSV('example1');"> Export to CSV</button>
                                        <br></br>
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Transaction Date</th>

                                                    <th>Customers Names</th>
                                                    <th>Account #</th>
                                                    <th>Amount Paid</th>                                                                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $branch = $_SESSION['branch'];
                                                $customerId = $_GET['cust_id'];

                                                $query = mysqli_query($con, "SELECT * FROM `customer` INNER JOIN customer_payments "
                                                        . "ON customer_payments.customer_id=customer.cust_id AND customer.cust_id='$customerId' ")or die(mysqli_error($con));
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($query)) {
                                                    $cid = $row['cust_id'];
                                                    ?>
                                                    <tr>                                                       
                                                        <td><?php echo $row['date_paid']; ?></td>                                                       
                                                        <td><?php echo $row['cust_first'] . ' ' . $row['cust_last']; ?></td>
                                                        <td><?php echo $row['account_no']; ?></td>
                                                        <td><?php echo number_format($row['amount'], 2); ?></td>
                                                        

                                                    </tr>

                                                    <tr>                                                       
                                                        <td></td>                                                       
                                                        <td></td>
                                                        <td>Balance To be Paid</td>
                                                        <td> <?php echo number_format($row['balance'],2); ?> </td>
                                                       
                                                    </tr>

                                                <div id="update_payment<?php echo $row['cust_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content" style="height:auto">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title">Update Payment Details for Client <?php
                                                                    echo $row['cust_first'];
                                                                    ;
                                                                    ?>
                                                                </h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" method="post" action="update-payment-customer.php" enctype='multipart/form-data'>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-3" for="price">Amount Paid</label>
                                                                        <div class="col-lg-9">
                                                                            <input id="price" name="id" value="<?php echo $row['cust_id'];
                                                                    ; ?>" hidden="">  
                                                                            <input type="text" class="form-control" id="price" name="amount" required>  
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
                                                </div>

                                                <div id="updateordinance<?php echo $row['cust_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content" style="height:auto">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title">Update Customer Details</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" method="post" action="customer_update.php" enctype='multipart/form-data'>

                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-3" for="name">Last Name</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['cust_id']; ?>" required>  
                                                                            <input type="text" class="form-control" id="name" name="last" value="<?php echo $row['cust_last']; ?>" required>  
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-3" for="name">First Name</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" class="form-control" id="name" name="first" value="<?php echo $row['cust_first']; ?>" required>  
                                                                        </div>
                                                                    </div>				
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-3" for="file">Address</label>
                                                                        <div class="col-lg-9">
                                                                            <textarea class="form-control" id="name" name="address" required><?php echo $row['cust_address']; ?></textarea>  
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-3" for="price">Contact Number</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" class="form-control" id="price" name="contact" value="<?php echo $row['cust_contact']; ?>" required>  
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-3" for="price">Email</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" class="form-control" id="price" name="email" value="<?php echo $row['email']; ?>" required>  
                                                                        </div>
                                                                    </div>
                                                            </div><br><br><br><hr>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="delete<?php echo $row['cust_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content" style="height:auto">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title">Are u sure you want to delete this Customer Record??                                                                    
                                                                </h4>
                                                            </div>
                                                            <div class="modal-body" hidden="">
                                                                <form class="form-horizontal" method="post" action="delete-customer.php" enctype='multipart/form-data'>
                                                                    <div class="form-group" hidden="hidden">
                                                                        <label class="control-label col-lg-3" for="price">Serial #</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" class="form-control" id="price" name="cust_id" value="<?php echo $row['cust_id']; ?>" required>  
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Delete</button>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div><!--end of modal-dialog-->
                                                </div>
                                                <!--end of modal-->   	  

                                                <?php
                                                $i++;
                                            }
                                            ?>					  
                                            </tbody>

                                        </table>
                                    </div><!-- /.box-body -->

                                </div><!-- /.col -->


                            </div><!-- /.row -->


                    </section><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.content-wrapper -->
<?php include('../dist/includes/footer.php'); ?>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
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
                                               $('#example1').DataTable({
                                                    "paging": false,
                                                    "lengthChange": false,
                                                    "searching": false,
                                                    "ordering": false,
                                                    "info": true,
                                                    "autoWidth": false,
                                                    buttons: [
                                                        'copy', 'csv', 'excel', 'pdf', 'print'
                                                    ]
                                                });
                                                $('#example2').DataTable({
                                                    "paging": false,
                                                    "lengthChange": false,
                                                    "searching": false,
                                                    "ordering": false,
                                                    "info": true,
                                                    "autoWidth": false,
                                                    buttons: [
                                                        'copy', 'csv', 'excel', 'pdf', 'print'
                                                    ]
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
