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

// activate the discounts..
$query2 = mysqli_query($con, "SELECT * FROM discount_tb WHERE DATE(discount_from) >= DATE(NOW()) AND  DATE(discount_to) <= DATE(NOW()) AND status='active' ")or die(mysqli_error($con));
while ($row1 = mysqli_fetch_array($query2)) {
    $discount_price = $row1['discount_price'];
    $id = $row1['prod_id'];
    mysqli_query($con, "update product set prod_sell_price='$discount_price'  where prod_id='$id'")or die(mysqli_error($con));
}

// deactivate the active discounts..
$query3 = mysqli_query($con, "SELECT * FROM discount_tb WHERE DATE(NOW()) > DATE(discount_from) AND status='active'")or die(mysqli_error($con));
while ($row1 = mysqli_fetch_array($query3)) {
    $discount_price = $row1['discount_price'];
    $id = $row1['prod_id'];
    mysqli_query($con, "UPDATE discount_tb SET status='notactive' WHERE prod_id='$id' ")or die(mysqli_error($con));
    mysqli_query($con, "update product set prod_sell_price='$discount_price' where prod_id='$id'")or die(mysqli_error($con));
}
?>

<header class="main-header">
    <nav class="navbar navbar-static-top" style="background-color: #3c8dbc">
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
                    <li class="dropdown notifications-user">                        
                        <a href="home">
                            <i class="glyphicon glyphicon-home text-green"></i> Home
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                            </li>
                        </ul>
                    </li>
                                        
                    <li class="dropdown notifications-menu">
                        <a href="quotation">
                            <i class="glyphicon glyphicon-shopping-cart text-green"></i> Quotation
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown notifications-menu">
                        <a href="prospects">
                            <i class="glyphicon glyphicon-shopping-cart text-green"></i> Prospects
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                            </li>
                        </ul>
                    </li>
                  
                    <li class="">
                        <!-- Menu Toggle Button -->
                        <a href="logout" class="dropdown-toggle">
                            
                            <h4 style="color:white">Welcome : 
                                <?php
                                 echo $_SESSION['name'];
                                ?>
                            </h4>
                            <i class="glyphicon glyphicon-off text-red"></i> Logout 

                        </a>
                    </li>
                </ul>
            </div><!-- /.navbar-custom-menu -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
<br></br>