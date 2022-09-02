<?php
session_start();
if (empty($_SESSION['id'])) :
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
        <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <style>
        </style>
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

    <body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav">
        <div class="wrapper">
            <?php
            include('../dist/includes/header.php');
            include('../Objects/Objects.php');
            $Objects = new InvObjects();
            ?>
            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            <a class="btn btn-lg btn-warning" href="home.php">Back</a>
                            <a class="btn btn-lg btn-primary" href="select_customer_credit.php" style="color:#fff;" class="small-box-footer">New Invoice <i class="glyphicon glyphicon-plus text-blue"></i></a>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Product</li>
                        </ol>
                    </section>
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title" style=" color: black"><b>Invoice List</b></h3>
                                    </div>
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Customers Name</th>
                                                    <th>Invoice Number</th>
                                                    <th>Credit Duration</th>
                                                    <th>Date To Be Collected</th>
                                                    <th>Print Invoice</th>
                                                    <th>View / Update Order</th>
                                                    <th>View Payment History</th>
                                                    <th>Partial Payment</th>
                                                    <th>Close Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $totalAmountDue = 0;
                                                $query = mysqli_query($con, "SELECT date,customer_name,date2collect,order_no,qty,price,SUM(qty) AS totalqty,SUM(price) AS total FROM `draft_temp_trans` GROUP BY order_no") or die(mysqli_error($con));
                                                while ($row = mysqli_fetch_array($query)) {
                                                    $orderNo = $row['order_no'];
                                                    $customer_name = $row['customer_name'];
                                                    $date2collect = date('d M, Y', strtotime($row['date2collect']));
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['customer_name']; ?></td>
                                                        <td><?php echo $row['order_no']; ?></td>
                                                        <td><?php
                                                            $date1 = new DateTime($row['date']);
                                                            $date2 = new DateTime(date('Y-m-d H:i:s'));
                                                            ;
                                                            $diff = $date1->diff($date2);

                                                            echo $diff->m . " months, " . $diff->d . " days ";
                                                            ?></td>
                                                        <td><?php
                                                            if (strtotime($row['date2collect']) < strtotime(date('d-m-Y'))) {
                                                                echo "<p class='badge bg-danger' style='background-color:red;'>" . $date2collect . "</p>";
                                                            } elseif (strtotime($row['date2collect']) == strtotime(date('d-m-Y'))) {
                                                                echo "<p class='badge' style='background-color:orange;'>" . $date2collect . "</p>";
                                                            } else {
                                                                echo "<p class='badge' style='background-color:green;'>" . $date2collect . "</p>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>                                                       
                                                            <a href="incomplete-draft-reciept.php?orderno=<?php echo $row['order_no']; ?>" style="color: #003eff "><b>Print Invoice</b></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="update-order-draft.php?orderno=<?php echo $row['order_no']; ?>&customer_name=<?php echo $customer_name; ?>" style="color: #003eff "><b>View / Update Order</b></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="payment-history.php?orderno=<?php echo $row['order_no']; ?>" style="color: #003eff "><b>View Payment History</b></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="partial_payment_add.php?orderno=<?php echo $row['order_no']; ?>" style="color: #003eff "><b>
                                                                    <?php
                                                                    $query2 = mysqli_query($con, "SELECT COUNT(*) AS nopayments FROM  part_payments_tb WHERE order_no='$orderNo' ") or die(mysqli_error($con));
                                                                    $row2 = mysqli_fetch_array($query2);
                                                                    echo '( ' . $row2['nopayments'] . ' ) Partial Payments';
                                                                    ?>
                                                                </b></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="complete-draft-order.php?orderno=<?php echo $row['order_no']; ?>" style="color:green "><b>Close Invoice</b></i></a>
                                                        </td>
                                                    </tr>
<?php } ?>
                                            </tbody>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div>
                            </div>
                    </section><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.content-wrapper -->
<?php include('../dist/includes/footer.php'); ?>
        </div><!-- ./wrapper -->
        <div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content" style="height:auto">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Add Sold Item</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post" action="add_item_sales.php" enctype='multipart/form-data'>
                            <div class="form-group">
                                <label class="control-label col-lg-3" for="file">Item Sold</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" style="width: 100%;" name="item_sold_id" required>
                                        <?php
                                        $query2 = mysqli_query($con, "select * from product") or die(mysqli_error($con));
                                        while ($row2 = mysqli_fetch_array($query2)) {
                                            ?>
                                            <option value="<?php echo $row2['prod_id']; ?>"><?php echo $row2['prod_name']; ?></option>
<?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3" for="price">Quantity Sold</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="price" name="quantity" placeholder="Quantity Sold" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3" for="price">Price Per Item</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Price Sold Per Item" required>
                                </div>
                            </div>

                    </div>
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
        <!-- jQuery 2.1.4 -->
        <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="../bootstrap/js/bootstrap.min.js"></script>
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
    </body>

</html>