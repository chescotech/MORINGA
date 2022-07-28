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
        <title>Product | <?php include('../dist/includes/title.php'); ?></title>
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
        <script src="../plugins/datatables/table-exporter.js"></script>
        <style>
        </style>
        <script>
            $(function () {
                $("#datepicker3").datepicker();
                $("#datepicker4").datepicker();
                $("#date_expire").datepicker();
                $("#datepicker2").datepicker();
            });
        </script>
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav">
        <div class="wrapper">
            <?php
            include('../dist/includes/header_admin.php');
            include ('../Objects/Objects.php');
            $Objects = new InvObjects();
            ?>
            <div class="content-wrapper">
                <div class="container">
                    <section class="content-header">
                        <div class="box box-primary angel">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div>
                            <div class="box-body">
                                <form enctype="multipart/form-data" method="post">                                        
                                    <div class="col-lg-4">
                                        <label>Upload Stock</label>
                                        <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="amount" required>  
                                            <input type="file" class="form-control" name="file" autocomplete="off" required="">  
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="upload"> Upload Bulk Stock</button>

                                    <a href="templates/product_import_template.csv" download=""> Download Upload Template</a>

                                </form>
                            </div>                               
                        </div>                               
                </div>

                <?php
                if (isset($_POST['upload'])) {
                    $filename = $_FILES["file"]["tmp_name"];

                    $file = fopen($filename, "r");

                    while (($emapData = fgetcsv($file, 10000, ","))) {
                        if ($emapData[0] !== "") {

                            $prodName = $emapData[0];
                            $prod_price = $emapData[1];
                            $prod_sell_price = $emapData[2];
                            $catName = $emapData[3];
                            $prodQty = $emapData[4];
                            $Supplier = $emapData[5];
                            $barcode = $emapData[6];

                            $expireDate = $emapData[8];
                            $vat_status = $emapData[9];
                            $branch = $emapData[10];

                            $failedCount = 0;
                            $sucessCount = 0;

                            $categoryCheck = mysqli_query($con, " SELECT * FROM category WHERE cat_name LIKE '%' '$catName' '%' ")or die(mysqli_error($con));
                            $supplierCheck = mysqli_query($con, " SELECT * FROM supplier WHERE supplier_name LIKE '%' '$Supplier' '%' ")or die(mysqli_error($con));

                            $branchChecker = mysqli_query($con, " SELECT * FROM stores_branch WHERE branch_name LIKE '%' '$branch' '%' ")or die(mysqli_error($con));

                            if (mysqli_num_rows($categoryCheck) > 0 && mysqli_num_rows($supplierCheck) > 0 && mysqli_num_rows($branchChecker) > 0) {

                                $supplier_row = mysqli_fetch_array($supplierCheck);
                                $category_rows = mysqli_fetch_array($categoryCheck);
                                $branch_rows = mysqli_fetch_array($branchChecker);
                                $category = $category_rows['cat_id'];
                                $supplier_id = $supplier_row['supplier_id'];
                                $branchName = $branch_rows['id'];

                                $date2 = str_replace('/', '-', $emapData[8]);

                                if ($emapData[8] == "") {
                                    $expire_date = "";
                                } else {
                                    $expire_date = date("Y-m-d", strtotime($date2));
                                }
                                $date3 = str_replace('/', '-', $emapData[7]);



                                if ($emapData[7] == "") {
                                    $manufactor_date = "";
                                } else {
                                    $manufactor_date = date("Y-m-d", strtotime($date3));
                                }

                                /*
                                  $branchIds= mysqli_query($con, "SELECT * FROM `stores_branch` WHERE id=(SELECT MIN(id) FROM stores_branch)")or die(mysqli_error($con));
                                  $branch_rows = mysqli_fetch_array($branchIds);
                                  $stock_branch_id = $branch_rows['id'];
                                 */
                                mysqli_query($con, "INSERT INTO product(expire_date,manufactor_date,barcode,prod_name,prod_price,prod_desc,prod_pic
        ,cat_id,reorder,supplier_id,branch_id,serial,prod_qty,belongs_to,prod_sell_price,stock_branch_id,vat_status,currency_id)
			VALUES('$expire_date','$manufactor_date','$barcode','$prodName','$prod_price'"
                                                . ",'$prodName','','$category','','$supplier_id','1','','$prodQty'"
                                                . ",'1','$prod_sell_price','$branchName','$vat_status','2')")or die(mysqli_error($con));

                                $sucessCount ++;
                            } else {

                                $failedCount ++;
                            }
                        }
                    }

                    echo "<script type='text/javascript'>alert('Uploaded " . $sucessCount . " records, " . $failedCount . " failed !');</script>";
                }
                ?>

                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Bulk Upload</li>
                </ol>
                </section>

            </div><!-- /.container -->
        </div><!-- /.content-wrapper -->
<?php include('../dist/includes/footer.php'); ?>
    </div><!-- ./wrapper -->

    <!--end of modal--> 
    <!-- jQuery 2.1.4 -->
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
                $('#example1').DataTable({
                    "paging": true,
                    buttons: [
                        'csv', 'excel', 'pdf', 'print'
                    ],
                    "lengthChange": false,
                    "searching": true,
                    "ordering": false,
                    "info": true,
                    "autoWidth": false
                });
                $('#example2').DataTable({
                    "paging": true,
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
