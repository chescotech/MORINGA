<?php session_start();

if (empty($_SESSION['id'])) :
    header('Location:../index.php');
endif;
if (empty($_SESSION['branch'])) :
    header('Location:../index.php');
endif;
// $branch = $_SESSION['branch'];
$branch_id = $_SESSION['branch_id_user'];
$user_id = $_SESSION['id'];

include_once('Classes/DAO.php');
$DAO = new DAO;

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

    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

    <!-- Multiselect -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="dist/css/bootstrap-multiselect.css" type="text/css">
    <script type="text/javascript" src="dist/js/bootstrap-multiselect.js"></script>
</head>

<body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav" onload="myFunction()">
    <div class="wrapper">
        <?php include('../dist/includes/header_admin.php'); ?>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <a class="btn btn-lg btn-warning" href="sold-items.php">Back</a>
                        <a class="btn btn-lg btn-primary" href="quotations.php" style="color:#fff;" class="small-box-footer">Product Transfer </a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Finish Products Transfer</li>
                    </ol>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Add Quantity</h3>

                                </div>
                                <div class="box-body">


                                    <form method="POST" action="#transfer">
                                        <?php
                                        var_dump($branch_id);
                                        $q1 = mysqli_query($con, "SELECT * FROM trans_temp 
                                            INNER JOIN product WHERE product.prod_id = trans_temp.prod_id
                                            GROUP BY trans_temp.prod_id") or die(mysqli_error($con));

                                        while ($r1 = mysqli_fetch_array($q1)) {
                                            $prr_id = $r1['prod_id'];
                                            $prr_name = $r1['prod_name'];
                                        ?>
                                            <div class="form-group">
                                                <div class="col-lg-12 col-md-12">
                                                    <input type="hidden" id="<?php echo $prr_id ?>" name="prr[]" value="<?php echo $prr_id ?>">
                                                    <label for="<?php echo $prr_id ?>"> <?php echo $prr_name ?> </label>
                                                    <input type="number" style="width:60px!important" value="1" id="<?php echo $prr_name ?>" name="qty[]">
                                                    <br>
                                                    <input type="hidden" name="prr_name[]" value="<?php echo $prr_name ?>">
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <br> </br>
                                        <hr>
                                        <div class="form-group">
                                            <br> </br>
                                            <hr>
                                            <h4 class="modal-title">Transfer To</h4>
                                            <div class="col-lg-12 col-md-12">
                                                <select class="form-control select2" style="width: 100%;" name="stock_branch_id" required>
                                                    <?php
                                                    $queryc1 = mysqli_query($con, "SELECT * FROM stores_branch WHERE id != '$branch_id' ") or die(mysqli_error($con));
                                                    while ($rowc1 = mysqli_fetch_array($queryc1)) {
                                                    ?>
                                                        <option value="<?php echo $rowc1['id']; ?>"><?php echo $rowc1['branch_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" name="transfer_" class="btn btn-primary">Transfer</button>
                                    </form>



                                </div>

                                <?php
                                if (isset($_POST['transfer_'])) {
                                    $products = $_POST['prr'];
                                    $prr_names = $_POST['prr_name'];
                                    $qtys = $_POST['qty'];
                                    $stock_branch_id = $_POST['stock_branch_id'];
                                    // return var_dump($products);
                                        // Get Branch name
                                        $query_store = mysqli_query($con, "SELECT * FROM stores_branch where id ='$stock_branch_id' ") or die(mysqli_error($con));
                                        $store_rows = mysqli_fetch_array($query_store);
                                        $branch_name = $store_rows['branch_name'];

                                    array_map(function ($prod_id, $prr_name, $qty) {
                                        global $con, $stock_branch_id, $user_id, $branch_id,$branch_name, $DAO;
                                        //    return var_dump($prod_id,$prr_name,$qty);
                                        $query1 = mysqli_query($con, "SELECT * from product where prod_name='$prr_name' and stock_branch_id='$stock_branch_id' ") or die("00 " . mysqli_error($con));
                                        $count = mysqli_num_rows($query1);
                                        $r11 = mysqli_fetch_array($query1);
                                        $ex_prod_id = $r11['prod_id'];
                                        // return var_dump($count);

                                        if ($count > 0) {
                                            mysqli_query($con, "UPDATE product set prod_qty=prod_qty+'$qty' where prod_id='$ex_prod_id' and stock_branch_id='$stock_branch_id' ") or die("11 " . mysqli_error($con));
                                        } else {
                                            mysqli_query($con, "INSERT INTO product(prod_desc,prod_name, prod_qty,stock_branch_id,branch_id) 
                                                          VALUES('$prr_name','$prr_name','$qty','$stock_branch_id','$stock_branch_id')") or die("22 " . mysqli_error($con));
                                            $ex_prod_id = mysqli_insert_id($con);
                                        }
                                        // Update product qty
                                        $chek = mysqli_query($con, "UPDATE product set prod_qty=prod_qty-'$qty' where prod_name='$prr_name' AND stock_branch_id = '$branch_id' ") or die("33 " . mysqli_error($con));
                                        // return var_dump(" UPDATE product set prod_qty=prod_qty-'$qty' where prod_name='$prr_name' AND stock_branch_id = '$branch_id' ");
                                        // Add to reports and logs
                                        $DAO->addToTransferLogs($con, $ex_prod_id, $qty, $stock_branch_id, $branch_name, $user_id);
                                    }, $products, $prr_names, $qtys);
                                    // And delete
                                    mysqli_query($con, "DELETE FROM trans_temp");


                                    echo "<script>document.location='product.php'</script>";
                                }
                                ?>


                                </form>
                            </div>
                        </div><!-- /.box -->
                    </div><!-- /.col (right) -->




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

    <!-- jQuery 2.1.4 -->
    <!-- <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
    <!-- <script src="../dist/js/jquery.min.js"></script> -->
    <script type="text/javascript" src="autosum.js"></script>
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