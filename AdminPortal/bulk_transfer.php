<?php session_start();

if (empty($_SESSION['id'])) :
    header('Location:../index.php');
endif;
if (empty($_SESSION['branch'])) :
    header('Location:../index.php');
endif;

// $branch_id = $_SESSION['branch'];
$branch_id = $_SESSION['branch_id_user'];
$user_id = $_SESSION['id'];
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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- <script src="../dist/js/jquery.min.js"></script> -->
    <!-- <script src="../dist/js/jquery.min.js"></script> -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <!-- <script src="script.js"></script> -->

    <!-- Multiselect -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="dist/css/bootstrap-multiselect.css" type="text/css">
    <script type="text/javascript" src="dist/js/bootstrap-multiselect.js"></script>


</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

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
                        <li class="active">Transfer Products</li>
                    </ol>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Product Transfer.</h3>

                                </div>
                                <div class="box-body">


                                    <form method="post" action="#transfer1">
                                        <div class="row">

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label for="date">Selec Items</label>
                                                    <br>
                                                    <!-- <div class="custom-select" style="width:200px;"> -->
                                                    <select id="select_prods" name="prr_id[]" multiple>
                                                        <?php
                                                        $q1 = mysqli_query($con, "SELECT * FROM ware_house_tb
                                                                order by prod_name") or die(mysqli_error($con));

                                                        while ($r1 = mysqli_fetch_array($q1)) {
                                                            $prr_id = $r1['prod_id'];
                                                            $prr_name = $r1['prod_name'];
                                                        ?>
                                                            <option value="<?php echo $prr_id; ?>"><?php echo $prr_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <!-- </div> -->
                                                    <script type="text/javascript">
                                                        // document.getElementById('"+ select_prods.Id + "').size = '8';
                                                        $(document).ready(function() {
                                                            $('#select_prods').multiselect({
                                                                enableFiltering: true,
                                                                includeSelectAllOption: true,
                                                                size: '1'
                                                            });
                                                        });
                                                    </script>
                                                </div><!-- /.form group -->
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="date"></label>
                                                    <div class="input-group">
                                                        <button class="btn btn-lg btn-primary" type="submit" tabindex="3" name="transfer_">Next</button>
                                                    </div>
                                                </div>
                                    </form>


                                </div>

                                <?php
                                if (isset($_POST['transfer_'])) {
                                    $products = $_POST['prr_id'];
                                    // $prr_names = $_POST['prr_name'];
                                    // $branch = $_POST['branch'];
                                    // $qty = $_POST['qty'];
                                    // return var_dump($products);

                                    foreach ($products as $key => $value) {
                                        $prod_id = $products[$key];

                                        $query1 = mysqli_query($con, "INSERT INTO trans_temp (`prod_id`, `user_id`) 
                                                                                VALUES ('$prod_id','$user_id')") or die(mysqli_error($con));
                                    }
                                    echo "<script>document.location='finish_bulk_transfer.php'</script>";
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