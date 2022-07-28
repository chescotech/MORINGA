
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
error_reporting(0);
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
        <title>Purchase Order </title>
        <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
        <a class = "btn btn-primary btn-print" href = "purchase-orders"><i class ="glyphicon glyphicon-arrow-left"></i>Back</a>
    </head>
    <style type="text/css">
        tr td{
            padding-top:-10px!important;
            border: 1px solid #000;
        }
        @media print {
            .btn-print {
                display:none !important;
            }
        }
    </style>
    <style type="text/css">
        body{
            background-color:#999;}
        .wrapper{
            background-color:#FFF;
            width:900px;
            height:600px;
            margin:auto;
        }
        .name{
            background-color:#fff;
            height:40px;
            width:900px;
            float:left;

        }
        .name_{
            background-color:#fff;
            height:90px;
            width:450px;
            float:left;
        }
        .payslip{
            background-color:#fff;
            height:90px;
            width:450px;
            float:right;
        }
        .payslip2{
            background-color:#fff;
            width:900px;
            float:left;
        }
        .payslip2_{
            padding-left:25px;
        }
        td{
            font-size:10px;}
        .box{	font-family:Tahoma, Geneva, sans-serif;}
        .box1{
            font-weight:bold;
            opacity:0;
            font-size:1px;}
        </style>

        <?php include('../dist/includes/dbcon.php'); ?>
        <?php
        $id = $_SESSION['id'];
        $queryb = mysqli_query($con, "select * from branch")or die(mysqli_error());
        $rowb = mysqli_fetch_array($queryb);
        ?>
        <body class="hold-transition skin-blue layout-top-nav" onload="window.print()" style=" background-color: white ">
        <div class="wrapper">
            <div class="body">
                <left>
                    <img src="logo.PNG"></img>
                    <?php
                    $identifier = $_GET['identifier'];
                    $query = mysqli_query($con,
                    "SELECT purchase_orders.qty,ware_house_tb.prod_name,purchase_orders.cost_price,supplier.supplier_name,supplier.supplier_address,supplier.supplier_contact FROM `purchase_orders` inner join ware_house_tb on ware_house_tb.prod_id=purchase_orders.prod_id
                    INNER JOIN supplier on supplier.supplier_id=purchase_orders.supplier
                    WHERE identifier='$identifier'
                    ")or die(mysqli_error($con));

                    $customerRows = mysqli_fetch_array($query);
                    ?>

                </left>   
                <center><a style=" color: black; font-size: 15px; font-family: Arial"><b> PURCHASE ORDER   # <?php
                            echo $identifier;
                            ?>
                        </b></a></center>  
                <p style=" margin-left: 25px">          ____________________________________________________________________________________________________________</p>
                <div class="name"></div>                           
                <div class="payslip2">
                    <div class="payslip2_">       
                        <div class="payslip">                            
                            </td>
                            <p style="font-size: 15px; font-family: Arial"><b> Date: </b><?php
                                echo date("M d, Y");
                                ?>
                            </p>

                        </div>                        


                        <style type="">
                            .align{
                                word-spacing:285px;}.align1{
                                word-spacing:300px;}.align3{
                                float:right;}.net{

                                margin-top: -200px;
                            }
                        </style>           

                        <p style="font-size: 15px; font-family: Arial">
                            To: 
                        </p>  

                        <p style="font-size: 15px; font-family: Arial">
                            <b>
                                <?php
                                echo 'Suppliers Name: ' . $customerRows['supplier_name'] . ' <br> Suppliers phone No:'
                                . '  ' . $customerRows['supplier_contact'] . '<br> Suppliers Address: ' . $customerRows['supplier_address']
                                ?>
                            </b>
                        </p>  

                        <br>

                            <style type="">
                                .align{
                                    word-spacing:285px;}.align1{
                                    word-spacing:300px;}.align3{
                                    float:right;}.net{
                                    margin-right:99px;}
                                td {
                                    vertical-align: top;
                                }
                            </style>
                            <style>
                                table, td, th {
                                    border: 1px solid black;
                                }

                                table {
                                    border-collapse: collapse;
                                    width: 100%;
                                }

                                td {
                                    height: 50px;
                                    vertical-align: bottom;
                                }
                            </style>
                            <table style=" margin-left: -10px">
                                <tr>
                                    <th style="font-size: 15px; font-family: Arial">QTY</th>
                                    <th style="font-size: 15px; font-family: Arial">PRODUCT</th> 
                                    <th style="font-size: 15px; font-family: Arial">UNIT PRICE</th>                                   
                                    <th style="font-size: 15px; font-family: Arial">LINE TOTAL</th> 
                                    <th style="font-size: 15px; font-family: Arial">CURRENCY</th> 
                                </tr>
                                <tr>
                                    <?php
                                    $grand = 0;
                                    $query = mysqli_query($con, "SELECT currency,ware_house_tb.prod_id,purchase_orders.qty,ware_house_tb.prod_name,purchase_orders.cost_price,supplier.supplier_name,supplier.supplier_address,supplier.supplier_contact FROM `purchase_orders` inner join ware_house_tb on ware_house_tb.prod_id=purchase_orders.prod_id
                                    INNER JOIN supplier on supplier.supplier_id=purchase_orders.supplier
                                    WHERE identifier='$identifier'
                                    ")or die(mysqli_error($con));

                                    while ($row = mysqli_fetch_array($query)) {
                                        //$order_no = $row['order_no'];
                                        $qty = $row['qty'];
                                        $prodName = $row['prod_name'];
                                        $cost_price = $row['cost_price'];
                                        $total = $cost_price * $qty;
                                        $subTotal += $total;
                                        $prod_id = $row['prod_id'];
                                        $currency = $row['currency'];

                                        mysqli_query($con, "DELETE FROM temp_purchases WHERE prod_id='$prod_id' ")or die(mysqli_error($con));

                                        echo ' <tr>
                                            <td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                           ' . $qty . '
                                        </td style="vertical-align:middle;font-size: 18px; font-family: Arial">
                                <td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                           ' . $prodName . '
                                        </td>
                                        <td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                           ' . $cost_price . '
                                        </td>
                                                                                                                      
                                        <td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                             ' . $total . '
                                        </td>
                                        <td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                             ' . $currency . '
                                        </td>
                            </tr>';
                                    }

                                    echo ' <tr>
                                <td>                                         
                                                                            
                                        </td><td>    
                                        </td><td>                                          
                                        </td><td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                        Sub Total
                                        </td><td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                             ' . number_format($subTotal, 2) . '
                                        </td>
                            </tr>';


                                    echo ' <tr>
                                <td>                                         
                                                                           
                                        </td><td>    
                                        </td><td>                                          
                                        </td><td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                        Grand Total
                                        </td><td style="vertical-align:middle;font-size: 15px; font-family: Arial">
                                             ' . number_format($subTotal, 2) . '
                                        </td>
                            </tr>';
                                    ?>

                                </tr>                                   
                            </table>

                            <?php
                            $query_ = mysqli_query($con, "select * from user where user_id='$id'")or die(mysqli_error($con));
                            $row = mysqli_fetch_array($query_);

                            echo '<br></br> <b>ORDER PREPARED BY:</b> ' . $row['name'] . '. ';
                            echo '<br></br> <b>SIGNATURE: ...................................</b> ';
                            ?>

                            <br></br> <br></br> <br></br> <br></br>

                        </form></div>
                </div>
            </div>
        </div>
    </body>
</html>
<br></br> <br></br> <br></br> <br></br>



