<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home | <?php include('../dist/includes/title.php');?></title>
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
    <!--
    javascript: window.history.forward(1);
    //
    -->
    </script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav" onload="myFunction()">
    <div class="wrapper">
        <?php include('../dist/includes/header.php');?>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <a class="btn btn-lg btn-warning" href="draft-sale.php">Back</a>
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
                                    <form method="post" action="transaction-modifyadd-draft.php">
                                        <div class="row" style="min-height:400px">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="date">Product Name</label>

                                                    <select class="form-control select2" name="prod_name" tabindex="1"
                                                        autofocus required>
                                                        <?php
                                                                $branch=$_SESSION['branch'];
                                                                $cid=$_REQUEST['cid'];
								  include('../dist/includes/dbcon.php');
									 $query2=mysqli_query($con,"select * from product where branch_id='$branch' AND prod_qty >0 order by prod_name")or die(mysqli_error($con));
									    while($row=mysqli_fetch_array($query2)){
								?>
                                                        <option value="<?php echo $row['prod_id'];?>">
                                                            <?php echo $row['prod_name']." Available(".$row['prod_qty'].")";?>
                                                        </option>
                                                        <?php }?>
                                                    </select>
                                                    <input type="hidden" class="form-control" name="cid"
                                                        value="<?php echo $cid;?>" required>
                                                </div><!-- /.form group -->
                                            </div>
                                            <div class=" col-md-2">
                                                <div class="form-group">
                                                    <label for="date">Quantity</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control pull-right" id="date"
                                                            name="qty" placeholder="Quantity" tabindex="2" value="1"
                                                            required>
                                                    </div><!-- /.input group -->
                                                </div><!-- /.form group -->
                                            </div>

                                            <div class=" col-md-2" hidden="">
                                                <div class="form-group">
                                                    <label for="date">Quantity</label>
                                                    <div class="input-group">
                                                        <input type="order_no" class="form-control pull-right" id="date"
                                                            name="order_no" placeholder="Quantity" tabindex="2"
                                                            value="<?php echo $_GET['orderno']; ?>" hidden="hidden">
                                                    </div><!-- /.input group -->
                                                </div><!-- /.form group -->
                                            </div>

                                            <div hidden="">
                                                <input hidden="" type="text" class="form-control" id="price"
                                                    name="customer_name" value="<?php echo $_GET['customer_name']; ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="date"></label>
                                                    <div class="input-group">
                                                        <button class="btn btn-lg btn-primary" type="submit"
                                                            tabindex="3" name="addtocart">+</button>
                                                    </div>
                                                </div>

                                    </form>
                                    <a href="#add_service" data-target="#add_service" data-toggle="modal"
                                        style="color:#3c8dbc;" class="small-box-footer"> <b>
                                            <h4>Add Item</h4>
                                        </b> <i class="glyphicon glyphicon-plus-sign text-red"></i></a>
                                    <div id="add_service" class="modal fade in" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="height:auto">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Add Item To Bill.</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" method="post"
                                                        action="add-to-bill-update" enctype='multipart/form-data'>
                                                        <div class="col-md-12">
                                                        </div>
                                                        <label>Description:</label>
                                                        <input type="text" class="form-control" id="price"
                                                            name="description" required autocomplete="off">

                                                        <label>Price:</label>
                                                        <input type="text" class="form-control" id="price" name="price"
                                                            required autocomplete="off">

                                                        <label>Quantity:</label>
                                                        <input type="text" class="form-control" id="price" name="qty"
                                                            required autocomplete="off">
                                                        <div hidden="">
                                                            <input hidden="" type="text" class="form-control" id="price"
                                                                name="order_no" value="<?php echo $_GET['orderno']; ?>">
                                                        </div>

                                                        <div hidden="">
                                                            <input hidden="" type="text" class="form-control" id="price"
                                                                name="customer_name"
                                                                value="<?php echo $_GET['customer_name']; ?>">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--end of modal-dialog-->
                                    </div>
                                </div>





                                <div class="col-md-12">
                                    <?php 
$queryb=mysqli_query($con,"select balance from customer where cust_id='$cid'")or die(mysqli_error($con));
     $rowb=mysqli_fetch_array($queryb);
        $balance=$rowb['balance'];

        if ($balance>0) $disabled="disabled=true";else{$disabled="";}
?>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>

                                                <th>Product Name</th>
                                                <th>Unit Price</th>
                                                <th>Total</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
  $orderno = $_GET['orderno'];
		
		$query=mysqli_query($con,"select * from draft_temp_trans LEFT JOIN product ON product.prod_id=draft_temp_trans.prod_id where draft_temp_trans.branch_id='$branch' AND draft_temp_trans.order_no='$orderno' ")or die(mysqli_error($con));
			$grand=0;
		while($row=mysqli_fetch_array($query)){
				$id=$row['temp_trans_id'];
				$total= $row['price'] * $row['qty'];
                                $unitPrice = $row['price'] / $row['qty'];
				$grand=$grand+$total;
                                $customer_name = $row['customer_name'];
		
?>
                                            <tr>
                                                <td><?php echo $row['qty'];?></td>
                                                <td class="record"><?php 
                        if($row['prod_name']==''){
                             echo $row['description'];
                        }else{
                             echo $row['prod_name'];
                        } ?></td>
                                                <td><?php echo number_format($row['price'],2);?></td>
                                                <td><?php echo number_format($total,2);?></td>
                                                <td>
                                                    <a href="#updateordinance<?php echo $row['temp_trans_id']; ?>"
                                                        data-target="#updateordinance<?php echo $row['temp_trans_id']; ?>"
                                                        data-toggle="modal" style="color:#fff;"
                                                        class="small-box-footer"><i
                                                            class="glyphicon glyphicon-edit text-blue"></i></a>


                                                </td>
                                            </tr>
                                            <div id="updateordinance<?php echo $row['temp_trans_id'];?>"
                                                class="modal fade in" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel" aria-hidden="true"
                                                style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="height:auto">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Update Sales Details</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" method="post"
                                                                action="update_credit_invoice.php"
                                                                enctype='multipart/form-data'>
                                                                <input type="hidden" class="form-control" name="cid"
                                                                    value="<?php echo $cid;?>" required>
                                                                <input type="hidden" class="form-control" id="price"
                                                                    name="id"
                                                                    value="<?php echo $row['temp_trans_id'];?>"
                                                                    required>
                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3"
                                                                        for="price">Qty</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="text" class="form-control"
                                                                            id="price" name="qty"
                                                                            value="<?php echo $row['qty'];?>" required>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3"
                                                                        for="price">Price</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="text" class="form-control"
                                                                            id="price" name="price"
                                                                            value="<?php echo $row['price'];?>" required>
                                                                    </div>
                                                                </div>

                                                        </div><br>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                <!--end of modal-dialog-->
                                            </div>
                                            <!--end of modal-->
                                            <div id="delete<?php echo $row['temp_trans_id'];?>" class="modal fade in"
                                                tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="height:auto">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Delete Item</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" method="post"
                                                                action="delete-modified-draft-order.php"
                                                                enctype='multipart/form-data'>
                                                                <input type="hidden" class="form-control" name="cid"
                                                                    value="<?php echo $cid;?>" required>
                                                                <input type="hidden" class="form-control" id="price"
                                                                    name="id"
                                                                    value="<?php echo $row['temp_trans_id'];?>"
                                                                    required>
                                                                <input type="hidden" class="form-control" id="price"
                                                                    name="order_no"
                                                                    value="<?php echo $_GET['orderno'];?>" required>
                                                                <p>Are you sure you want to remove
                                                                    <?php echo $row['prod_name'];?>?</p>
                                                        </div><br>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary">Delete</button>
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                <!--end of modal-dialog-->
                                            </div>
                                            <!--end of modal-->
                                            <?php }?>
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
                        <form method="post" name="autoSumForm" action="draft-sales-add.php">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="date">Total</label>

                                        <input type="text" style="text-align:right" class="form-control" id="total"
                                            name="total" placeholder="Total" value="<?php echo $grand;?>"
                                            onFocus="startCalc();" onBlur="stopCalc();" tabindex="5" readonly>

                                    </div><!-- /.form group -->
                                    <div class="form-group" hidden="ds">
                                        <label for="date">Discount</label>

                                        <input type="text" class="form-control text-right" id="discount" name="discount"
                                            value="0" tabindex="6" placeholder="Discount (Php)" onFocus="startCalc();"
                                            onBlur="stopCalc();">
                                        <input type="hidden" class="form-control text-right" id="cid" name="cid"
                                            value="<?php echo $cid;?>">
                                    </div><!-- /.form group -->
                                    <div class="form-group">
                                        <label for="date">Amount Due</label>

                                        <input type="text" style="text-align:right" class="form-control" id="amount_due"
                                            name="amount_due" placeholder="Amount Due"
                                            value="<?php echo number_format($grand,2);?>" readonly>

                                    </div><!-- /.form group -->


                                    <div class="form-group" id="tendered" hidden="">
                                        <label for="date">Customers Name</label><br>
                                        <input type="text" style="text-align:right" class="form-control"
                                            onFocus="startCalc();" onBlur="stopCalc();" id="cash" name="customer_name"
                                            placeholder="Customers Name" value="<?php echo $customer_name; ?>"
                                            required="">
                                    </div><!-- /.form group -->

                                </div>

                            </div>

                            <button class="btn btn-lg btn-block" id="daterange-btn" type="reset" tabindex="8">
                                <a href="draft-sale.php">Done</a>
                            </button>

                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col (right) -->


        </div><!-- /.row -->


        </section><!-- /.content -->
    </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
    <?php include('../dist/includes/footer.php');?>
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
                            x `
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
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'));
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