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
    <script language="JavaScript">
        // <!--
        // javascript: window.hist ory.forward(1);
        // //
        // -->
    </script>
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
                        <a class="btn btn-lg btn-warning" href="purchase-orders.php">Back</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Stock Purchase Order</li>
                    </ol>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                <hr style="height:10px">
                                    <div class="row">
                                        <div class="col-md-8"> <h3 class="box-title">Stock Purchase Order</h3> </div>
                                        <div class="pull-right" style="font-size:x-large">
                                            <a href="#add_p_order" data-target="#add_p_order" data-toggle="modal" style="color:#fff;" class="small-box-footer">
                                            <i class="glyphicon glyphicon-plus text-blue"></i></a>

                                        </div>
                                    </div>
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
                                    <form method="post" action="insert_purchase.php">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <?php
                                                $queryb = mysqli_query($con, "SELECT balance from customer where cust_id='$cid'") or die(mysqli_error($con));
                                                $rowb = mysqli_fetch_array($queryb);
                                                $balance = $rowb['balance'];
                                                if ($balance > 0)
                                                    $disabled = "disabled=true";
                                                else {
                                                    $disabled = "";
                                                }
                                                ?>

                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="date">Select Prefered Supplier</label>
                                                        <SELECT class="form-control select2" name="supplier_id" tabindex="1">
                                                            <?php
                                                            $branch = $_SESSION['branch'];
                                                            $cid = $_REQUEST['cid'];
                                                            $branch_id_user = $_SESSION['branch_id_user'];

                                                            $query2 = mysqli_query($con, "SELECT * from supplier order by supplier_name") or die(mysqli_error($con));
                                                            while ($row = mysqli_fetch_array($query2)) {
                                                            ?>
                                                                <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
                                                            <?php } ?>
                                                        </SELECT>
                                                    </div>
                                                </div>
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Quantity</th>
                                                            <th>Product Name</th>
                                                            <th>Cost Price</th>
                                                            <th>Current Supplier</th>
                                                             <th>Currency</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $user_id = $_SESSION['id'];
                                                        $query = mysqli_query($con, "SELECT ware_house_tb.prod_id,ware_house_tb.prod_name,ware_house_tb.prod_price AS cost_price,
                                                                temp_purchases.id AS temp_id, supplier.supplier_name FROM `temp_purchases` 
                                                                INNER JOIN ware_house_tb on ware_house_tb.prod_id=temp_purchases.prod_id
                                                                INNER JOIN supplier on supplier.supplier_id=ware_house_tb.supplier_id") or die(mysqli_error($con));
                                                        $grand = 0;
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $id = $row['temp_id'];
                                                        ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control" id="price" name="qty[]" required autocomplete="off">
                                                                    <div hidden="">
                                                                        <input type="text" class="form-control" id="price" name="prod_id[]" value="<?php echo $row['prod_id'] ?>" required autocomplete="off">
                                                                    </div>
                                                                </td>
                                                                <td class="record"><?php echo $row['prod_name']; ?></td>
                                                                <td>
                                                                    <div>
                                                                        <input type="text" class="form-control" id="price" name="cost_price[]" value="<?php echo $row['cost_price'] ?>" required autocomplete="off">
                                                                    </div>
                                                                </td>
                                                                <td><?php echo $row['supplier_name']; ?></td>
                                                                 <td>
                                                                    <div>
                                                                        <input type="text" class="form-control" id="price" name="currency[]" value="ZMW" required autocomplete="off">
                                                                    </div>
                                                                </td>
                                                                <th> 
                                                                    <!-- <form method="GET" action="#">
                                                                        <input type="submit" name="remove" value="<?php echo $id ?>">
                                                                    </form> -->
                                                                    <a href="purchase-preview.php?delete=<?php echo $id; ?>" onclick="return 
                                                                    confirm('Are you sure you want to remove this item?');" class="btn btn-sm btn-danger"> Remove </a>
                                                                </th>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="cash" type="submit" tabindex="3">
                                                    Generate Purchase Order
                                                </button>

                                    </form>
                                </div><!-- /.box-body -->
                            </div>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
            </div><!-- /.col (right) -->






            <?php
                // Logic for the cancel btn
                if (isset($_REQUEST['delete'])) {
                    $temp_id = $_REQUEST['delete'];
                    echo "<script>alert('Are you sure you want do delect this item?'); </script>";
                    delete_temp_purchases($con, $temp_id);
                }

                function delete_temp_purchases($con, $temp_id){
                    mysqli_query($con, "DELETE FROM temp_purchases WHERE id = '$temp_id' ")or die("Can't Delete! ".mysqli_error($con));
                    echo "<script>document.location='purchase-preview.php'</script>";
                }

                if (isset($_POST['save'])) {
                    $checkbox = $_POST['check'];
                    for ($i = 0; $i < count($checkbox); $i++) {
                        $prod_id = $checkbox[$i];
                        // mysqli_query($conn, "DELETE FROM employee WHERE userid='" . $del_id . "'");

                        mysqli_query($con, "INSERT INTO temp_purchases(prod_id) VALUES('$prod_id')")or die(mysqli_error($con));

                        //$message = "Data deleted successfully !";
                        
                        echo "<script>document.location='purchase-preview.php'</script>";
                    }
                }
            ?>
            <div id="add_p_order" class="modal fadein" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content" style="height:auto; width:150%">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Add Stock Purchase Order</h4>
                        </div>
                        <div class="modal-body">

                            <div class="box-body">  
                                <br></br>
                                <form method="post" action="">
                                    <p align="center"><button type="submit" class="btn btn-success" name="save"> Add Items</button></p>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Picture</th>
                                                <th>Product Code</th>
                                                <th>Product Name</th>                                                   
                                                <th>Supplier</th>
                                                <th>Qty</th>
                                                <th>Re Order Level</th>
                                                <th>Buy Price</th>
                                                <th>Sell Price</th>
                                                <th>Item Category</th>                                                 
                                                <th><input type="checkbox" id="checkAl"> Select All</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = mysqli_query($con, "SELECT * from ware_house_tb INNER join supplier on supplier.supplier_id=ware_house_tb.supplier_id  INNER join category
                                            on category.cat_id=ware_house_tb.cat_id ")or die(mysqli_error($con));
                                            // $query = mysqli_query($con, "SELECT * from ware_house_tb ")or die(mysqli_error($con));
                                            while ($row = mysqli_fetch_array($query)) {
                                                $prod_id = $row['prod_id'];
                                                ?>
                                                <tr>
                                                    <td><img style="width:80px;height:60px" src="../dist/uploads/pos.png"></td>
                                                    <td><?php echo $row['serial']; ?></td>
                                                    <td><?php echo $row['prod_name']; ?></td>
                                                    <td><?php echo $row['supplier_name']; ?></td>
                                                    <td><?php
                                                        $productQuantity = $row['prod_qty'];
                                                        if ($productQuantity > 0) {
                                                            echo "<span class='label label-success'>" . $productQuantity . "</span>";
                                                        } else {
                                                            echo "<span class='label label-danger'>" . $productQuantity . "</span>";
                                                        }
                                                        ?>
                                                    </td> 
                                                    <td><?php echo number_format($row['reorder'], 2); ?></td>
                                                    <td><?php echo number_format($row['prod_qty'], 2); ?></td>
                                                    <td><?php echo number_format($row['prod_sell_price'], 2); ?></td>
                                                    <td><?php echo $row['cat_name']; ?></td>                                                       
                                                    <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $prod_id; ?>"></td>

                                                </tr>                                             

                                            <?php } ?>					  
                                        </tbody>                                           
                                    </table>

                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>



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

    
    <script>
        $("#checkAl").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
</body>

</html>