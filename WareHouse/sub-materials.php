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
                $("#date_expire").datepicker();
                $("#datepicker2").datepicker();
            });
        </script>
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav">
        <div class="wrapper">

            <?php
            include('../dist/includes/header_warehouse.php');
            include ('../Objects/Objects.php');
            $Objects = new InvObjects();
            ?>
            <div class="content-wrapper">
                <div class="container">
                    <section class="content-header">

                        <div class="box box-primary angel">
                            <div class="box-header">
                                <h3 class="box-title">Filter / Search By Product</h3>
                            </div>
                            <div class="box-body">
                                <form method="post">                                         
                                    <div class="col-lg-2">
                                        <label>Select Product</label>
                                        <select class="form-control select2" style="width: 100%;" name="prod_id" required >                                                
                                            <?php
                                            $queryc = mysqli_query($con, "select id,description from rawdata_tb  WHERE type='SUB' ")or die(mysqli_error($con));
                                            while ($rowc = mysqli_fetch_array($queryc)) {
                                                ?>
                                                <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['description']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="search"> Search Item </button>
                                </form>
                            </div>                               
                        </div>                               
                </div>

                <h1>
                    <a class="btn btn-lg btn-warning" href="home.php">Back</a>
                    <a class="btn btn-lg btn-primary" href="#add" data-target="#add" data-toggle="modal" style="color:#fff;" class="small-box-footer">Add Sub Material<i class="glyphicon glyphicon-plus text-blue"></i></a>

                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Product</li>
                </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-19">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title" style=" color: black"><b> 
                                            <?php
                                            $querycount = mysqli_query($con, "SELECT COUNT(id) AS norecords FROM `sub_cons_tb`")or die(mysqli_error($con));
                                            $rowCount = mysqli_fetch_array($querycount);
                                            $noRecords = $rowCount['norecords'];
                                            echo $noRecords . ' Items Available in Stock';
                                            ?>                                            
                                        </b>
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <button id="btnExport" onclick="javascript:xport.toCSV('example1');"> Export to CSV</button><br></br>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Picture</th>
                                                <th>Class</th>                                                    
                                                <th>Description</th>
                                                <th>Quantity</th>
                                               
                                                <th>Category</th>
                                                <th>Origin</th>
                                                 <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['search'])) {
                                                $prodId = $_POST['prod_id'];

                                        $query = mysqli_query($con, "SELECT * FROM  rawdata_tb INNER JOIN category ON category.cat_id= rawdata_tb.category_id  AND type='SUB' AND rawdata_tb.id='$prodId'  ")or die(mysqli_error($con));
                                      
                                            } else {

                                                $query = mysqli_query($con, "SELECT * FROM  rawdata_tb INNER JOIN category ON category.cat_id= rawdata_tb.category_id  AND type='SUB'  ")or die(mysqli_error($con));
                                            }

                                            while ($row = mysqli_fetch_array($query)) {
                                                $prod_d = $row['id'];
                                                ?>
                                                <tr>
                                                    <td><img style="width:80px;height:60px" src="../dist/uploads/pos.png"></td>
                                                    <td><?php echo $row['class']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td><?php
                                                        $qty = $row['qty'];
                                                        if ($qty > 0) {                                                           
                                                            echo "<span class='label label-success'>" .$qty . "</span>";
                                                        } else {
                                                            echo "<span class='label label-danger'>0</span>";
                                                        }
                                                        ?>
                                                    </td>                                                  
                                                    <td><?php echo $row['cat_name']; ?></td>
                                                    <td><?php echo $row['origin']; ?></td>
                                                   <td>
                                                        <a href="#delete<?php echo $row['id']; ?>" data-target="#delete<?php echo $row['id']; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-blue"></i></a>
                                                    </td>
                                                </tr>
                                            <div id="updateordinance<?php echo $row['prod_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="height:auto">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Update Product Details</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" method="post" action="sub-mat-add.php" enctype='multipart/form-data'>


                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" for="name">Product Name</label>
                                                                    <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['prod_id']; ?>" required>  
                                                                        <input type="text" class="form-control" id="name" name="prod_name" value="<?php echo $row['prod_name']; ?>" required>  
                                                                    </div>
                                                                </div> 

                                                                <div class="form-group" hidden="">
                                                                    <label class="control-label col-lg-3" for="name">Description</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="text" class="form-control" id="name" name="desc" value="<?php echo $row['prod_desc']; ?>">  
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" for="file">Supplier</label>
                                                                    <div class="col-lg-9">
                                                                        <select class="form-control select2" style="width: 100%;" name="supplier" required>
                                                                            <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
                                                                            <?php
                                                                            $query2 = mysqli_query($con, "select * from supplier")or die(mysqli_error($con));
                                                                            while ($row2 = mysqli_fetch_array($query2)) {
                                                                                ?>
                                                                                <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row2['supplier_name']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div> 

                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" for="price">Buy Price</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="text" class="form-control" id="price" name="prod_price" value="<?php echo $row['prod_price']; ?>" required>  
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" for="price">Sell Price</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="text" class="form-control" id="price" name="prod_sell_price" value="<?php echo $row['prod_sell_price']; ?>" required>  
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" >Category</label>
                                                                    <div class="col-lg-9">
                                                                        <select class="form-control select2" style="width: 100%;" name="category" required>
                                                                            <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                                                                            <?php
                                                                            $queryc = mysqli_query($con, "select * from category order by cat_name")or die(mysqli_error($con));
                                                                            while ($rowc = mysqli_fetch_array($queryc)) {
                                                                                ?>
                                                                                <option value="<?php echo $rowc['cat_id']; ?>"><?php echo $rowc['cat_name']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div><!-- /.input group -->
                                                                </div><!-- /.form group -->

                                                                <div class="form-group" hidden="">
                                                                    <label class="control-label col-lg-3" >Belongs To:</label>
                                                                    <div class="col-lg-9">
                                                                        <select class="form-control select2" style="width: 100%;" name="belongs_to" required>
                                                                            <option value="<?php echo $row['cat_id']; ?>"><?php echo $Objects->getShopCategoryById($con, $row['belongs_to']); ?></option>
                                                                            <?php
                                                                            $queryc = mysqli_query($con, "select * from shop_category_tb")or die(mysqli_error($con));
                                                                            while ($rowc = mysqli_fetch_array($queryc)) {
                                                                                ?>
                                                                                <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['name']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div><!-- /.input group -->
                                                                </div><!-- /.form group -->

                                                                <div class="form-group" >
                                                                    <label class="control-label col-lg-3" >Belongs To:</label>
                                                                    <div class="col-lg-9">
                                                                        <select class="form-control select2" style="width: 100%;" name="belongs_to" required>                                                                                
                                                                            <?php
                                                                            $queryc = mysqli_query($con, "select * from stores_branch")or die(mysqli_error($con));
                                                                            while ($rowc = mysqli_fetch_array($queryc)) {
                                                                                ?>
                                                                                <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['branch_name']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div><!-- /.input group -->
                                                                </div><!-- /.form group -->

                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" for="price">Quantity</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="number" class="form-control" id="price" name="prod_qty" value="<?php echo $row['prod_qty']; ?>" required>  
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" for="price">Picture</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="hidden" class="form-control" id="price" name="image1" value="<?php echo $row['prod_pic']; ?>"> 
                                                                        <input type="file" class="form-control" id="price" name="image">  
                                                                    </div>
                                                                </div>
                                                        </div><br><br><br><br><br><br><br>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="discount<?php echo $row['prod_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="height:auto">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">
                                                                <?php echo $row['prod_name'] . ' Discount '; ?>
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <?php
                                                            $discountQuery = mysqli_query($con, "select * FROM discount_tb WHERE prod_id='$prod_d' ")or die(mysqli_error($con));
                                                            $discountrow = mysqli_fetch_array($discountQuery)
                                                            ?>                                                                
                                                            <form class="form-horizontal" method="post" action="manage-discounts.php" enctype='multipart/form-data'>
                                                                <div class="form-group" hidden="hidden">
                                                                    <label class="control-label col-lg-3" for="price">Serial #</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="text" class="form-control" id="price" name="prod_id" value="<?php echo $prod_d; ?>" required>  
                                                                        <input type="number" class="form-control" id="price" name="prod_sell_price" value="<?php echo $row['prod_sell_price']; ?>" required>  
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" for="name">Discount Price</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="text" class="form-control" id="name" autocomplete="off"  name="discount_price" value="<?php echo $discountrow['discount_price']; ?>" required>  
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" for="file">Status</label>
                                                                    <div class="col-lg-9">
                                                                        <select class="form-control select2" style="width: 100%;" name="status" required>
                                                                            <option value="<?php echo $discountrow['status']; ?>"><?php echo $discountrow['status']; ?></option>
                                                                            <option value="active">Active</option>
                                                                            <option value="notactive">Not Active</option>
                                                                        </select>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" for="price">Discount From</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="text" name="date"  class="form-control pull-right active" id="reservation">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <br></br>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save Discount</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="damages<?php echo $row['prod_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="height:auto">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title" style=" color: black"><b>
                                                                    <?php echo 'Record ' . $row['prod_name'] . ' Damages '; ?>
                                                                </b>
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                            $discountQuery = mysqli_query($con, "select * FROM discount_tb WHERE prod_id='$prod_d' ")or die(mysqli_error($con));
                                                            $discountrow = mysqli_fetch_array($discountQuery)
                                                            ?>                                                                
                                                            <form class="form-horizontal" method="post" action="manage-damages.php" enctype='multipart/form-data'>
                                                                <div class="form-group" hidden="hidden">
                                                                    <label class="control-label col-lg-3" for="price">Serial #</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="number" class="form-control" id="price" name="prod_id" value="<?php echo $prod_d; ?>" required>  
                                                                        <input type="number" class="form-control" id="price" name="prod_sell_price" value="<?php echo $row['prod_sell_price']; ?>" required>  
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-3" for="name">Number Of Damages</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="text" class="form-control" id="name" autocomplete="off"  name="no_damages"required>  
                                                                    </div>
                                                                </div>                                                                 
                                                        </div>
                                                        <br></br>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save Discount</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="delete<?php echo $row['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="height:auto">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Are u sure you want to delete this Product ??
                                                               
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body" hidden="">
                                                            <form class="form-horizontal" method="post" action="delete-sub-materials.php" enctype='multipart/form-data'>
                                                                <div class="form-group" hidden="hidden">
                                                                    <label class="control-label col-lg-3" for="price">Serial #</label>
                                                                    <div class="col-lg-9">
                                                                        <input type="text" class="form-control" id="price" name="id" value="<?php echo $row['id']; ?>" required>  
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Delete</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
                    <h4 class="modal-title">Add New Sub Material</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="sub-mat-add.php" enctype='multipart/form-data'>  

                        <div class="form-group">
                            <label class="control-label col-lg-3" for="name">Class</label>
                            <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" required>  
                                <input type="text" class="form-control" id="name" name="class" placeholder="Class" required>  
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-lg-3" for="name">Description</label>
                            <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" required>  
                                <input type="text" class="form-control" name="description" placeholder="Description" autocomplete="off">  
                            </div>
                        </div> 
                        
                         <div class="form-group">
                            <label class="control-label col-lg-3" for="name">Quantity</label>
                            <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" required>  
                                <input type="text" class="form-control" name="qty" placeholder="Quantity" autocomplete="off">  
                            </div>
                        </div>  

                        <div class="form-group" >
                            <label class="control-label col-lg-3" for="price">Origin</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" id="price" name="origin" placeholder="Origin"></textarea>  
                            </div>
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
                                                "paging": false,
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
                                                "paging": false,
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
