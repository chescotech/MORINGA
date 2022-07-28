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
        <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <script src="../plugins/datatables/table-exporter.js"></script>
        <style>

        </style>
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav">
        <div class="wrapper">
            <?php
            include('../dist/includes/header_dataentry.php');
            include ('../Objects/Objects.php');
            $Objects = new InvObjects();
            ?>
            <div class="content-wrapper">
                <div class="container">
                    <section class="content-header">
                        <br></br>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Product</li>
                        </ol>
                    </section>
                    <section class="content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title" style=" color: black"><b>Items With Shortages</b></h3>
                                    </div>
                                    <div class="box-body">
                                        
                                        <button id="btnExport" onclick="javascript:xport.toCSV('example1');"> Export to CSV</button>
                                        <br></br>
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Picture</th>
                                                    <th>Product Code</th>
                                                    <th>Product Name</th>
                                                    <th>Description</th>
                                                    <th>Supplier</th>
                                                    <th>Qty</th>
                                                    <th>Buy Price</th>
                                                    <th>Sell Price</th>
                                                    <th>Item Category</th>                                                 
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($con, "select * from product natural join supplier natural join category where branch_id='$branch' AND prod_qty <= (SELECT notification_count FROM branch) order by prod_name")or die(mysqli_error($con));
                                                while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                    <tr>
                                                        <td><img style="width:80px;height:60px" src="../dist/uploads/pos.png"></td>
                                                        <td><?php echo $row['serial']; ?></td>
                                                        <td><?php echo $row['prod_name']; ?></td>
                                                        <td><?php echo $row['prod_desc']; ?></td>
                                                        <td><?php echo $row['supplier_name']; ?></td>
                                                        <td><?php
                                                            $productQuantity = $row['prod_qty'];
                                                            if ($productQuantity > 0) {
                                                                echo "<span class='label label-success'>" . $productQuantity . "</span>";
                                                            } else {
                                                                echo "<span class='label label-danger'>" . $productQuantity . "</span>";
                                                            }                                                         
                                                            ?></td>
                                                        <td><?php echo number_format($row['prod_qty'], 2); ?></td>
                                                        <td><?php echo number_format($row['prod_sell_price'], 2); ?></td>
                                                        <td><?php echo $row['cat_name']; ?></td>                                                       
                                              
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
                        <h4 class="modal-title">Add New Product</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post" action="product_add.php" enctype='multipart/form-data'>                           
                            <div class="form-group">
                                <label class="control-label col-lg-3" for="name">Product Name</label>
                                <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" required>  
                                    <input type="text" class="form-control" id="name" name="prod_name" placeholder="Product Name" required>  
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="control-label col-lg-3" for="price">Product Description</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" id="price" name="prod_desc" placeholder="Product Description"></textarea>  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3" for="file">Supplier</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" style="width: 100%;" name="supplier" required>
                                        <?php
                                        $query2 = mysqli_query($con, "select * from supplier")or die(mysqli_error($con));
                                        while ($row2 = mysqli_fetch_array($query2)) {
                                            ?>
                                            <option value="<?php echo $row2['supplier_id']; ?>"><?php echo $row2['supplier_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="control-label col-lg-3" for="price">Price Bought</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="price" name="prod_price" placeholder="Price Prodct Bought" required>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3" for="price">Quantity Bought</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="price" name="prod_qty" placeholder="Quantity Bought" required>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3" for="price">Selling Price</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="price" name="prod_sell_price" placeholder="Selling Price Per Item" required>  
                                </div>
                            </div>

                            <div class="form-group" hidden="">
                                <label class="control-label col-lg-3" >Item Belongs To:</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" style="width: 100%;" name="belongs_to" required>
                                        <?php
                                        $queryc = mysqli_query($con, "select * from shop_category_tb")or die(mysqli_error($con));
                                        while ($rowc = mysqli_fetch_array($queryc)) {
                                            ?>
                                            <option value="<?php echo $rowc['id']; ?>"><?php echo 'The ' . $rowc['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div><!-- /.input group -->
                            </div> 

                            <div class="form-group">
                                <label class="control-label col-lg-3" >Category</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" style="width: 100%;" name="category" required>
                                        <?php
                                        $queryc = mysqli_query($con, "select * from category order by cat_name")or die(mysqli_error($con));
                                        while ($rowc = mysqli_fetch_array($queryc)) {
                                            ?>
                                            <option value="<?php echo $rowc['cat_id']; ?>"><?php echo $rowc['cat_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div><!-- /.input group -->
                            </div>                           
                            <div class="form-group">
                                <label class="control-label col-lg-3" for="price">Picture</label>
                                <div class="col-lg-9">
                                    <input type="file" class="form-control" id="price" name="image">  
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div><!--end of modal-dialog-->
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
