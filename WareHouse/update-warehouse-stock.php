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
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <script src="../dist/js/jquery.min.js"></script>
        <script language="JavaScrip    t"><!--
        javascript:window.hist    ory.forward(1);
            //--></script>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav" onload="myFunction()">
            <div class="wrapper">
<?php include('../dist/includes/header_warehouse.php'); ?>
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
                                            <h3 class="box-title"> DATA .</h3>              
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
                                            <form method="post" action="add-warehouse-update.php">
                                                <div class="row" >

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="date">Product Name</label>							 
                                                            <select class="form-control select2" name="prod_name" tabindex="1">
                                                                <?php
                                                                $branch = $_SESSION['branch'];
                                                                $cid = $_REQUEST['cid'];
                                                                $branch_id_user = $_SESSION['branch_id_user'];
                                                                include('../dist/includes/dbcon.php');
                                                                $query2 = mysqli_query($con, "SELECT id,description FROM `rawdata_tb` ")or die(mysqli_error($con));
                                                                while ($row = mysqli_fetch_array($query2)) {
                                                                    ?>
                                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['description']; ?></option>
<?php } ?>d.

                                                            </select>
                                                            <input type="hidden" class="form-control" name="cid" value="<?php echo $cid; ?>" >   
                                                        </div><!-- /.form group -->
                                                    </div>
                                                    <div class=" col-md-2">
                                                        <div class="form-group">
                                                            <label for="date">Quantity</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control pull-right" id="date" name="qty" placeholder="Quantity" tabindex="2" value="1"  required>
                                                            </div><!-- /.input group -->
                                                        </div><!-- /.form group -->
                                                    </div>

                                                    <div class=" col-md-2">
                                                        <div class="form-group">
                                                            <label for="date">JOB</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control pull-right" id="date" name="job" placeholder="Job" tabindex="2"  required>
                                                            </div><!-- /.input group -->
                                                        </div><!-- /.form group -->
                                                    </div>

                                                    <div class=" col-md-2">
                                                        <div class="form-group">
                                                            <label for="date">Source</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control pull-right" id="date" name="source" placeholder="Source" tabindex="2"  required>
                                                            </div><!-- /.input group -->
                                                        </div><!-- /.form group -->
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="date"></label>
                                                            <div class="input-group">
                                                                <button class="btn btn-lg btn-primary" type="submit" tabindex="3" name="in">IN</button>
                                                            </div>
                                                        </div>	
                                                        </form>	
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="date"></label>
                                                            <div class="input-group">
                                                                <button class="btn btn-lg btn-primary" type="submit" tabindex="3" name="out">OUT</button>
                                                            </div>
                                                        </div>	
                                                        </form>	
                                                    </div>
                                                    <div class="col-md-12">
                                                        <?php
                                                        $queryb = mysqli_query($con, "select balance from customer where cust_id='$cid'")or die(mysqli_error($con));
                                                        $rowb = mysqli_fetch_array($queryb);
                                                        $balance = $rowb['balance'];

                                                        if ($balance > 0)
                                                            $disabled = "disabled=true";else {
                                                            $disabled = "";
                                                        }
                                                        ?>
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Quantity</th>		       
                                                                    <th>Item Name</th>
                                                                    <th>Item Type</th>
                                                                    <th>In / Out</th> 
                                                                    <th>JOB</th>
                                                                    <th>Source</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $user_id = $_SESSION['id'];
                                                                $query = mysqli_query($con, "SELECT source,job,rawdata_updates_tb.id AS id,SUM(value) AS value,description, type, status"
                                                                        . "  FROM `rawdata_updates_tb` INNER JOIN rawdata_tb ON rawdata_tb.id=rawdata_updates_tb.item_id"
                                                                        . " AND rawdata_updates_tb.action_status='' GROUP BY status,item_id,job,source    ")or die(mysqli_error($con));
                                                                $grand = 0;
                                                                while ($row = mysqli_fetch_array($query)) {
                                                                    $id = $row['id'];
                                                                    ?>
                                                                    <tr >
                                                                        <td><?php echo $row['value']; ?></td>
                                                                        <td class="record"><?php echo $row['description']; ?></td>
                                                                        <td class="record"><?php echo $row['type']; ?></td>
                                                                        <td><?php echo $row['status'] ?></td>	
                                                                        <td><?php echo $row['job'] ?></td>
                                                                        <td><?php echo $row['source'] ?></td>
                                                                        <td>
                                                                            <a href="#delete<?php echo $row['id']; ?>" data-target="#delete<?php echo $row['id']; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>
                                                                        </td>
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
                                                                                    <br>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-lg-3" for="price">Update Price</label>
                                                                                        <div class="col-lg-5">
                                                                                            <select class="form-control select2" name="price_tag" tabindex="1">
                                                                                                <option value="none">--Select Price --</option>
                                                                                                <option value="special_price">Special Price</option>
                                                                                                <option value="retail">Retail</option>
                                                                                                <option value="wholesale">Whole Sale</option>
                                                                                                <option value="Discount">Discount</option>
                                                                                            </select>


                                                                                        </div>
                                                                                    </div>
                                                                                    <br>

                                                                                    </div><br>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>

                                                                        </div><!--end of modal-dialog-->
                                                                    </div>
                                                                    <!--end of modal-->  
                                                                    <div id="delete<?php echo $row['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                                                                        <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['id']; ?>" required>  
                                                                                        <p>Are you sure you want to remove this Item ?</p>

                                                                                </div><br>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                                </form>
                                                                            </div>

                                                                        </div><!--end of modal-dialog-->
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
                                            <form method="post" name="autoSumForm" action="save-warehouse.php">
                                                <div class="row">
                                                    <div class="col-md-12">					


                                                        <button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="cash" type="submit"  tabindex="7">
                                                            SAVE
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



                        $(function() {

                        $(".btn_delete").click(function(){
                        var element = $(this);
                        var id = element.attr("id");
                        var dataString = 'id=' + id;
                        if (confirm("Sure you want to delete this item?"))
                        {
                        $.ajax({
                        type: "GET",
                                url: "temp_trans_del.php",
                                data: dataString,
                                success: functi                        on(){

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

                            <sc                                ript>
      $(function () {
                                        $("#example1").DataTable();
                                         $('#example2').DataTable(                                  {
          "paging": true,
                                       "lengthChange": false,
                                    "searching": false,
                                    "ordering": true                                  ,x`
          "info": true,
                                 "au                              toWidth":                                 false
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
