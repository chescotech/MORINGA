<?php
//session_start();
if (empty($_SESSION['id'])):
    header('Location:../index.php');
endif;
date_default_timezone_set("Africa/Lusaka");
?>
<?php
include('../dist/includes/dbcon.php');

$branch = $_SESSION['branch'];
$query = mysqli_query($con, "select * from branch where branch_id='$branch'")or die(mysqli_error($con));
$row = mysqli_fetch_array($query);
$branch_name = $row['branch_name'];
?>

<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header" style="padding-left:20px">
                <a href="home.php" class="navbar-brand"><b><i class="glyphicon glyphicon-home"></i> <?php
                        echo $branch_name;
                        ?></b></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">              
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-wrench"></i> Setup
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <ul class="menu">
                                    <li><!-- start notification -->
                                        <a href="category.php">
                                            <i class="glyphicon glyphicon-user text-green"></i> Item Categories
                                        </a>
                                    </li>                                  

                                    <li><!-- start notification -->
                                        <a href="supplier.php">
                                            <i class="glyphicon glyphicon-send text-green"></i> Suppliers
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- Tasks Menu -->
                    <!-- Tasks Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="product.php">
                            <i class="glyphicon glyphicon-list text-green"></i> Stock Orders
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="sold-items.php">
                            <i class="glyphicon glyphicon-list text-green"></i> Sales
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                            </li>
                        </ul>
                    </li>                   
                    <li class="">
                        <!-- Menu Toggle Button -->
                        <a href="profile.php" class="dropdown-toggle">
                            <i class="glyphicon glyphicon-cog text-orange"></i>
                            <?php echo $_SESSION['name']; ?>
                        </a>
                    </li>
                    <li class="">
                        <!-- Menu Toggle Button -->
                        <a href="logout.php" class="dropdown-toggle">
                            <i class="glyphicon glyphicon-off text-red"></i> Logout 

                        </a>
                    </li>
                </ul>
            </div><!-- /.navbar-custom-menu -->
        </div><!-- /.container-fluid -->
    </nav>
</header>