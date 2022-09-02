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
        include('Classes/DAO.php');

        $Objects = new InvObjects();
        $dao = new DAO();
        ?>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <a class="btn btn-lg btn-warning" href="home.php">Back</a>
                        <a class="btn btn-lg btn-primary" href="quotation.php" style="color:#fff;" class="small-box-footer">New Quotation <i class="glyphicon glyphicon-plus text-blue"></i></a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Quotation</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title" style=" color: black"><b>Quotations List</b></h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Quotation Number</th>
                                                <th>Date Created</th>
                                                <th>Customer</th>                                              
                                                <th>Edit</th>
                                                <th>Print Quotation</th>                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $totalAmountDue = 0;
                                            $query = mysqli_query($con, "SELECT quote_identity AS quote_id,customer,date_added FROM `quotation_tb` GROUP BY quote_identity ORDER BY quote_identity DESC ") or die(mysqli_error($con));
                                            while ($row = mysqli_fetch_array($query)) {
                                                $customer = $row['customer'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['quote_id']; ?></td>
                                                    <td><?php echo $row['date_added']; ?></td>
                                                    <td><?php
                                                        echo $row['customer'];
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <a href="edit-quotation?customer=<?php echo $customer; ?>&quote_id=<?php echo $row['quote_id']; ?>" style="color: #003eff "><b>Edit Quotation</b></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="quotation-reprint-new.php?quote_id=<?php echo $row['quote_id']; ?>" style="color: #003eff "><b>Print Quotation</b></i></a>
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
</body>

</html>

<?php

if (isset($_GET['wp_quote_id'])) {
    $wp_quote_id = $_GET['wp_quote_id'];
    $itemString = "";
    $total_sales = 0;
    $query = mysqli_query($con, "SELECT * FROM quotation_tb WHERE quote_id='$wp_quote_id' ") or die(mysqli_error($con));

    while ($row = mysqli_fetch_array($query)) {

        $pid = $row['prod_id'];
        $qty = $row['qty'];
        $price = $row['price'];

        $stockCount = mysqli_query($con, "SELECT * FROM product WHERE prod_id='$pid' ") or die(mysqli_error($con));
        $countRows = mysqli_fetch_array($stockCount);
        $prod_name = $countRows['prod_name'];

        $total_sales += $qty * $price;

        $itemString .= $qty . ' ' . $prod_name . ' , ';
    }

    $validURL = "http://localhost/Accounting/user/quotation-reprint-new.php?quote_id=" . $wp_quote_id;

    $recieptURL = $msg = "Dear " . $dao->getCustomerNames($cust_id, $con) . ",please find your Quotaiont at :  " . $validURL . "  from " . $dao->getCompanyName($con) . "  .Thank you for your business. Feel free to contact us on " . $dao->getCompanyContact($con) . " for any queries.";

    $result = mysqli_query($con, "DELETE FROM temp_trans where branch_id='$branch' AND user_id='$id'") or die(mysqli_error($con));
    echo "<script>document.location='http://api.whatsapp.com/send?phone=26" . $dao->getCustomerPhoneNo($cust_id, $con) . "&text=" . urlencode($msg) . " '</script>";
}

?>