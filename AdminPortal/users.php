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
        <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
        <style>
        </style>
    </head>   
    <body class="hold-transition skin-<?php echo $_SESSION['skin']; ?> layout-top-nav">
        <div class="wrapper">
            <?php
            include('../dist/includes/header_admin.php');
            include ('../Objects/Objects.php');
            $Objects = new InvObjects();
            ?>
            <div class="content-wrapper">
                <div class="container">
                    <section class="content-header">
                        <h1>
                            <a class="btn btn-lg btn-warning" href="home.php">Back</a>
                            <a class="btn btn-lg btn-primary" href="#add" data-target="#add" data-toggle="modal" style="color:#fff;" class="small-box-footer">Add New User <i class="glyphicon glyphicon-plus text-blue"></i></a>
                        </h1>
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
                                        <h3 class="box-title" style=" color: black"><b>System Users</b></h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Username</th>
                                                    <th>Names</th>
                                                    <th>User Type</th>
                                                    <th>Status</th> 
                                                    <th>Belongs To</th> 
                                                    <th></th> 
                                                    <th>Update</th>                                                     
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($con, "select * from user")or die(mysqli_error($con));
                                                while ($row = mysqli_fetch_array($query)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['username']; ?></td>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['user_type']; ?></td>
                                                        <td><?php
                                                            $status = $row['status'];
                                                            if ($status == "active") {
                                                                echo "<span class='label label-success'>Not Active</span>";
                                                            } else {
                                                                echo "<span class='label label-danger'>Active</span>";
                                                            }
                                                            ?>
                                                        </td>  
                                                        <td><?php
                                                            $branch_id_user = $row['branch_id_user'];
                                                            $query2 = mysqli_query($con, "select * from stores_branch where id='$branch_id_user'")or die(mysqli_error($con));
                                                            $row2 = mysqli_fetch_array($query2);
                                                            $branch_name = $row2['branch_name'];
                                                            if ($branch_name == "") {
                                                                echo "No Branch Assigned";
                                                            } else {
                                                                echo $row2['branch_name'];
                                                            }
                                                            ?></td>
                                                        <td><img style="width:80px;height:60px" src="../dist/uploads/user.jpg"></td>
                                                        <td>
                                                            <a href="#updateordinance<?php echo $row['user_id']; ?>" data-target="#updateordinance<?php echo $row['user_id']; ?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                                                        </td>
                                                    </tr>

                                                <div id="updateordinance<?php echo $row['user_id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content" style="height:auto">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title">Edit User Details</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" method="post" action="user_update.php" enctype='multipart/form-data'>
                                                                    <div class="form-group" hidden="">
                                                                        <label for="name">Names</label>
                                                                        <div class="input-group col-md-12">  
                                                                            <input type="text" class="form-control" id="name" name="user_id" value="<?php echo $row['user_id']; ?>" required>  
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label for="name">Names</label>
                                                                        <div class="input-group col-md-12">  
                                                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>  
                                                                        </div>
                                                                    </div> 

                                                                    <div class="form-group">
                                                                        <label>Belongs To</label>
                                                                        <select class="form-control select2" style="width: 100%;" name="branch_id_user" required >                                                                          
                                                                            <option value="0"><?php
                                                                                echo $branch_name;
                                                                                ?></option>
                                                                            <?php
                                                                            $branchuser = $row['user_id'];
                                                                            $queryc = mysqli_query($con, "select * from stores_branch ")or die(mysqli_error($con));
                                                                            while ($rowc = mysqli_fetch_array($queryc)) {
                                                                                ?>
                                                                                <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['branch_name']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="name">Change Password</label>
                                                                        <div class="input-group col-md-12">  
                                                                            <input type="password" class="form-control" id="name" name="password" >  
                                                                        </div>
                                                                    </div> 

                                                                    <div class="form-group">
                                                                        <label for="name">Re Enter Password</label>
                                                                        <div class="input-group col-md-12">  
                                                                            <input type="password" class="form-control" id="name" name="repassword">  
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="date">User Type</label>
                                                                        <div class="input-group col-md-12">
                                                                            <select class="form-control select2" name="user_type" required>
                                                                                <option value="<?php echo $row['user_type']; ?>"><?php echo $row['user_type']; ?></option>
                                                                                <option value="User">Teller User</option>
                                                                                <option value="InventoryDataEntry">Inventory User</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="date">Status</label>
                                                                        <div class="input-group col-md-12">
                                                                            <select class="form-control select2" name="status" required>
                                                                                <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
                                                                                <option value="active">Active</option>
                                                                                <option value="not active">Not Active</option>                                                                                
                                                                            </select>
                                                                        </div><!-- /.input group -->
                                                                    </div><!-- /.form group -->
                                                            </div><hr>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Update Details</button>
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
                        <h4 class="modal-title">Add New User</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post" action="add-user.php" enctype='multipart/form-data'>                           
                            <div class="form-group">
                                <label class="control-label col-lg-3" for="name">User Name</label>
                                <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" required>  
                                    <input type="text" class="form-control" id="name" name="username" placeholder="User Name" required>  
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="control-label col-lg-3" for="price">Password</label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" id="name" name="password" placeholder="Enter Paassword" required>  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3" for="price">Full Names</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="price" name="names" placeholder="Enter users names" required>  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-3" >User Type:</label>
                                <div class="col-lg-9">
                                    <select class="form-control select2" style="width: 100%;" name="user_type" required>                                       
                                        <option value="Admin">Admin</option> 
                                        <option value="User">Teller</option> 
                                        <option value="warehouse">Warehouse User</option> 
                                        <option value="InventoryDataEntry">Inventory Data Entry</option> 
                                        <option value="Supervisor">Supervisor /  Manager</option> 
                                    </select>
                                </div>
                            </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create User</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

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
