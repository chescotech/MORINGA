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
            <a class="btn btn-lg btn-primary" href="quotations.php"  style="color:#fff;" class="small-box-footer">View Quotations </a>
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
                  <h3 class="box-title">Quotation Generation.</h3>

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

                  <form method="post" action="add-quotation.php">
                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="date">Product Name</label>
                          <select class="form-control select2" name="prod_name" tabindex="1">
                            <?php
                            $branch = $_SESSION['branch'];
                            $cid = $_REQUEST['cid'];
                            $branch_id_user = $_SESSION['branch_id_user'];
                            include('../dist/includes/dbcon.php');
                            $query2 = mysqli_query($con, "select * from product where branch_id='$branch' AND stock_branch_id='$branch_id_user' AND prod_qty >0 order by prod_name") or die(mysqli_error($con));
                            while ($row = mysqli_fetch_array($query2)) {
                            ?>
                              <option value="<?php echo $row['prod_id']; ?>"><?php echo $row['prod_name'] . " Available(" . $row['prod_qty'] . ")"; ?></option>
                            <?php } ?>
                          </select>
                          <input type="hidden" class="form-control" name="cid" value="<?php echo $cid; ?>">
                        </div><!-- /.form group -->
                      </div>
                      <div class=" col-md-2">
                        <div class="form-group">
                          <label for="date">Quantity</label>
                          <div class="input-group">
                            <input type="number" class="form-control pull-right" id="date" name="qty" placeholder="Quantity" tabindex="2" value="1" required>
                          </div><!-- /.input group -->
                        </div><!-- /.form group -->
                      </div>

                      <div class=" col-md-2">
                        <div class="form-group">
                          <label for="date">Barcode</label>
                          <div class="input-group">
                            <input type="number" class="form-control pull-right" id="date" name="barcode" placeholder="Barcode" tabindex="2" value="" name="barcode" autofocus>
                          </div><!-- /.input group -->
                        </div><!-- /.form group -->
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="date"></label>
                          <div class="input-group">
                            <button class="btn btn-lg btn-primary" type="submit" tabindex="3" name="addtocart">+</button>
                          </div>
                        </div>
                  </form>

                  <a href="#add_service" data-target="#add_service" data-toggle="modal" style="color:#3c8dbc;" class="small-box-footer"> <b>Add Item </b> <i class="glyphicon glyphicon-plus-sign text-red"></i></a>
                  <div id="add_service" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content" style="height:auto">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                          <h4 class="modal-title">Add Item To Bill.</h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" method="post" action="add-to-quote.php" enctype='multipart/form-data'>
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
                <div class="col-md-12">
                  <?php
                  $queryb = mysqli_query($con, "select balance from customer where cust_id='$cid'") or die(mysqli_error($con));
                  $rowb = mysqli_fetch_array($queryb);
                  $balance = $rowb['balance'];

                  if ($balance > 0) $disabled = "disabled=true";
                  else {
                    $disabled = "";
                  }
                  ?>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Qty</th>

                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $user_id = $_SESSION['id'];
                      $query = mysqli_query($con, "select * from quotation_tb LEFT join product on product.prod_id=quotation_tb.prod_id "
                              . "where quotation_tb.branch_id='$branch' AND quotation_tb.user_id='$user_id' AND status='' ") or die(mysqli_error($con));
                      $grand = 0;
                      while ($row = mysqli_fetch_array($query)) {
                        $id = $row['quote_id'];
                        $total = $row['price'] * $row['qty'];
                        $unitPrice = $row['price'] / $row['qty'];
                        $grand = $grand + $total;

                      ?>
                        <tr>
                          <td><?php echo $row['qty']; ?></td>
                          <td class="record"><?php
                                              if ($row['prod_name'] == "") {
                                                echo $row['description'];
                                              } else {
                                                echo $row['prod_name'];
                                              }

                                              ?></td>
                          <td><?php
                              $priceTage = $row['price_tag'];
                              if ($priceTage == "") {
                                $priceTage = "Retail Price";
                              }
                              echo number_format($row['price'], 2); ?></td>
                          <td><?php echo number_format($total, 2); ?></td>
                          <td>

                            <a href="#updateordinance<?php echo $row['quote_id']; ?>" data-target="#updateordinance<?php echo $row['quote_id']; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>

                            <a href="#delete<?php echo $row['quote_id']; ?>" data-target="#delete<?php echo $row['quote_id']; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>

                          </td>
                        </tr>
                        <div id="updateordinance<?php echo $row['quote_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog">
                            <div class="modal-content" style="height:auto">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Update Sales Details</h4>
                              </div>
                              <div class="modal-body">
                                <form class="form-horizontal" method="post" action="update-quotation-price.php" enctype='multipart/form-data'>
                                  <input type="hidden" class="form-control" name="cid" value="<?php echo $cid; ?>" required>
                                  <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['quote_id']; ?>" required>
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

                          </div>
                          <!--end of modal-dialog-->
                        </div>
                        <!--end of modal-->
                        <div id="delete<?php echo $row['quote_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                          <div class="modal-dialog">
                            <div class="modal-content" style="height:auto">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Delete Item</h4>
                              </div>
                              <div class="modal-body">
                                  <form class="form-horizontal" method="post" action="delete-quote.php" enctype='multipart/form-data'>
                                  <input type="hidden" class="form-control" name="cid" value="<?php echo $cid; ?>" required>
                                  <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $id; ?>" required>
                                  <p>Are you sure you want to remove <?php echo $row['prod_name']; ?>?</p>

                              </div><br>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Delete</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                              </form>
                            </div>

                          </div>
                          <!--end of modal-dialog-->
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
            <form method="post" name="autoSumForm" action="quote-preview-new.php">
              <div class="row">
                <div class="col-md-12">

                  <div class="form-group">
                    <label for="date">Quotation Amount</label>
                    <input type="text" style="text-align:right" class="form-control" id="amount_due" name="amount_due" placeholder="Amount Due" value="<?php echo $grand; ?>" readonly>
                  </div><!-- /.form group -->

                  <div class="form-group">
                    <div class="form-group">
                      <label for="price">Discount Percent</label>
                      <input type="number" class="form-control" style="text-align:right" id="discount" name="discount" placeholder="Discount">
                    </div>
                  </div>
                  <!--<div class="form-group">
                    <label for="date">Discount Type</label><br>
                    <div class="col-md-6">
                      <label class="radio-inline"><input type="radio" id="dis_type" name="dis_type" value="cash" checked>Cash</label>
                    </div>
                    <div class="col-md-6">
                      <label class="radio-inline"><input type="radio" id="dis_type" name="dis_type" value="percent">Percentage</label>
                    </div><br>
                  </div> /.form group -->

                  <script>
                    $(document).ready(function() {
                      $("#discount").change(function() {
                        var amount_due = parseFloat($("#amount_due").val());
                        var discount = parseFloat($("#discount").val());
                        var discount_type = $("#dis_type").val();
                        var total_discount = discount
                        // if (discount_type == "cash") {
                        //  console.log(total_discount);
                        // } else {
                        //   var total_discount = (discount / 100) * amount_due;
                        // }
                        console.log(amount_due, total_discount);
                        var new_amount_due = amount_due- ((amount_due/100) * total_discount);

                        $('#new_amount_due').val(new_amount_due);
                      });
                    });
                  </script>


                  <div class="form-group">
                    <label for="date">New Amount After Discount</label>
                    <input type="text" style="text-align:right" class="form-control" id="new_amount_due" name="new_amount_due" value="" readonly>
                  </div><!-- /.form group -->

                  <div class="form-group" id="tendered" hidden="">
                    <div class="form-group" id="change">
                      <label for="date">Quotation Description Details</label><br>
                      <input type="text" style="text-align:right" class="form-control" id="changed" name="quote_description" autocomplete="off" placeholder="Quotation Description Details">
                    </div>
                  </div>


                  <div class="form-group" id="tendered" hidden="">
                    <div class="form-group" id="change">
                      <label for="date">Quotation Validity</label><br>
                      <input type="number" style="text-align:right" class="form-control" id="changed" name="validity" autocomplete="off" placeholder="Quotation Validity">
                    </div>
                  </div>
                  <div class="form-group" id="tendered">
                    <div class="form-group" id="change">
                      <label for="date">Select Customer</label><br>
                      <select class="form-control select2" name="customer" tabindex="1">
                        <option value="none">-- Select Customer --</option>
                        <?php
                        include('../dist/includes/dbcon.php');
                        $query2 = mysqli_query($con, "select * from customer ") or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($query2)) {
                        ?>
                          <option value="<?php echo $row['cust_first']; ?>"><?php echo " ( " . $row['cust_first'] . ' - ' . $row['cust_last'] . " ) "; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group" id="tendered">
                    <div class="form-group" id="change">
                      <label for="date">Select Currency</label><br>
                      <select class="form-control select2" name="exchange_id" tabindex="1">                       
                        <?php                        
                        $query3 = mysqli_query($con, "select * from exchange_rates_tb order by name DESC ") or die(mysqli_error($con));
                        while ($row = mysqli_fetch_array($query3)) {
                        ?>
                          <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <a style=" color: blue" href="cust_new.php?type=quote" target="blank_" ><b>Add New Customer</b></a><br></br>	

                </div>

                <button class="btn btn-lg btn-block btn-primary" id="daterange-btn" name="cash" type="submit" tabindex="7">
                  Generate Quotation
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

      //Datemask dd/mm/yyyy
      // $("#datemask").inputmask("dd/mm/yyyy", {
      //   "placeholder": "dd/mm/yyyy"
      // });
      // //Datemask2 mm/dd/yyyy
      // $("#datemask2").inputmask("mm/dd/yyyy", {
      //   "placeholder": "mm/dd/yyyy"
      // });
      //Money Euro
      // $("[data-mask]").inputmask();

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