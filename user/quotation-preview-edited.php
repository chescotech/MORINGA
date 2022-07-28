<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
error_reporting(0);
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Quotation</title>
    </head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>

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
                            <script language="JavaScript"><!--
                        javascript:window.history.forward(1);
                                //--></script>
                            <style type ="text/css" >
                                .footer{ 
                                    position: absolute;     
                                    text-align: left;    
                                    margin-top: 800px;
                                    bottom: 0px; 
                                    width: 100%;                
                                    footer {page-break-after: always;}
                                }  
                                .footer {page-break-after: always;}
                            </style>
                            <style type="text/css">
                                body{
                                    background-color:#999;}
                                .wrapper{
                                    background-color:#FFF;
                                    width:100%;

                                    margin:auto;
                                }
                                .name{
                                    background-color:#fff;

                                    width:100%;
                                    float:left;

                                }
                                .name_{
                                    background-color:#fff;

                                    width:100%;
                                    float:left;
                                }
                                .payslip{
                                    background-color:#fff;

                                    width:100%;
                                    float:left;
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
                                    font-size:13px;}
                                .box{	font-family:Tahoma, Geneva, sans-serif;}
                                .box1{
                                    font-weight:bold;
                                    opacity:0;
                                    font-size:1px;}
                                </style>

                                <style type="text/css">
                                h5,h6{
                                    text-align:center;
                                }

                                @media print {
                                    .btn-print {
                                        display:none !important;
                                    }
                                    .main-footer	{
                                        display:none !important;
                                    }
                                    .box.box-primary {
                                        border-top:none !important;
                                    }
                                }
                            </style>

                            <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
                                <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> <button style=" background-color: blue">Print</button></a>
                                <a class = "btn btn-primary btn-print" href = "next-quotation.php"><i class ="glyphicon glyphicon-arrow-left"></i><button style=" background-color: green ">NEXT QUOTATION</button></a>

                                <body class="hold-transition skin-blue layout-top-nav"  onload="print()" onfocus="window.close()" style=" background-color: white ">
                                    <div class="wrapper" title="">
                                        <div class="body"></div>            
                                        <div class="body">
                                            <div class="name"></div>
                                            <div class="name_">

                                                <?php include('../dist/includes/dbcon.php'); ?>

                                                <form method="post" action="entry.php" onSubmit="return proceed()">
                                                    <table border="0" align="center" width="10000">
                                                        <center>
                                                            <img src="my-logo.png" height="120px" >
                                                        </center>
                                                        <center><h4 style="color: blue"><b>
                                                                    <?php
                                                                    $id = $_SESSION['id'];
                                                                    $customer = $_POST['customer'];
                                                                    $quote_number =  $_POST['quote_id'];;//$quotaton_rows['quote_id'];
                                                                    
echo 
                                                                    
                                                                    mysqli_query($con, " UPDATE  quotation_tb SET customer='$customer',status='printed' WHERE quote_id='$quote_number' ")or die(mysqli_error($con));


                                                                    $queryb = mysqli_query($con, "select * from branch")or die(mysqli_error($con));
                                                                    $rowb = mysqli_fetch_array($queryb);
                                                                    $reciept_footer_text = $rowb['reciept_footer_text'];
                                                                    // echo $rowb['branch_name'];

                                                                                                                                    
                                                                    ?> 
                                                                </b>
                                                            </h4></center>
                                                        <?php
                                                        echo '<center><h5><u>QUOTATION </u></h5></center>';

                                                        echo ' <tr>
                                                            <td class="box" width=""><p><u></u>
                                                                          TPIN : 1002938663 &nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                           Quotation # : ' . $quote_number . '                       
                                                                    </p>
                                                            </td>
                                                            </tr>';
                                                        echo ' <tr>
                                                            <td class="box" width=""><p><u></u>
                                                                        Quotation To: ' . $_POST['customer'] . '&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                           &nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp; Date : ' . date("M d, Y") . ' ' . date("H:i:sa") . '                       
                                                                    </p>
                                                            </td>
                                                            </tr>';

                                                        $query1 = mysqli_query($con, "select * from payment where sales_id='$sales_id'")or die(mysqli_error($con));

                                                        $row1 = mysqli_fetch_array($query1);
                                                        ?>

                                                        <table class="table table-bordered table-bordered"  style="border:1px solid black">

                                                            <thead>
                                                                <tr>
                                                                    <th>Item Code</th>                                                                   
                                                                    <th>Description</th>
                                                                    <th>Qty</th>                                                                   
                                                                    <th>Unit Price</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                $quote_id = $_POST['quote_id'];
                                                                $query = mysqli_query($con, "select * from quotation_tb LEFT join product on product.prod_id=quotation_tb.prod_id WHERE quote_id='$quote_id' ")or die(mysqli_error($con));
                                                                $grand = 0;
                                                                $totalQuotation = 0;
                                                                while ($row = mysqli_fetch_array($query)) {
                                                                    $description = $row['description'];
                                                                    $item_code = $row['barcode'];
                                                                    if ($row['prod_name'] == "") {
                                                                        //echo $row['description'];
                                                                        $prodName = $row['description'];
                                                                    } else {
                                                                        $prodName = $row['prod_name'];
                                                                    }

                                                                    //$price = $row['price'];
                                                                    //$total = $row['qty'] * $row['price'];
                                                                    //$totalQuotation += $row['qty'] * $row['price'];
                                                                    //$grand = $grand + $total;
                                                                    
                                                                    
                                                                    
                                                                    $price = ($row['price'] / 1.16);
                                                                    //$price = $row['price'] - $amountLessVat;


                                                                    $total = $row['qty'] * $price;
                                                                    $totalQuotation += $row['qty'] * $row['price'];
                                                                    $grand = $grand + $total;
                                                                    

                                                                    echo ' <tr>
                                                                         <td style="vertical-align:middle;font-size: 13px; font-family: Arial">
                                           ' . $item_code . '
                                        </td>
                              
                                         <td style="vertical-align:middle;font-size: 13px; font-family: Arial">
                                           ' . $prodName . '
                                        </td>
                                         <td style="vertical-align:middle;font-size: 13px; font-family: Arial">
                                           ' . $row['qty'] . '
                                        </td>
                                       
 <td style="vertical-align:middle;font-size: 13px; font-family: Arial">
                                           ' . number_format($price, 2) . '
                                        </td>
                                         <td style="vertical-align:middle;font-size: 13px; font-family: Arial">
                                             ' . number_format($total, 2) . '
                                        </td>
                            </tr>';
                                                                }
                                                                ?>                                                            </tbody>
                                                        </table>


                                                    </table>
                                            </div>
                                            </form>
                                            <br>
                                                </table>
                                                </table>
                                            </form></div>

                                    </div>

                                    </div>
                                    </div>
                                </body>

                                <div class="footer" style="color: black">
                                    <?php
                                    $amountLessVat = ($totalQuotation / 1.16);
                                    $vatValue = $totalQuotation - $amountLessVat;
                                    $totalExlVAT = $vatFinalTotal - $vatValue;

                                    echo '<p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Exl VAT :  K ' . number_format($amountLessVat, 2) . '</p>';


                                    echo '<p>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; VAT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : K ' . number_format($vatValue, 2) . '</p>';


                                    echo '<p>' . '&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                                    . ' Grand Total &nbsp;&nbsp; :  K ' . number_format($totalQuotation, 2) . '</p>';
                                    ?>
                                    <p style=" margin-left: -15px">          ______________________________________________________________________________________________________________________</p>

                                    <tr>
                                        <td  width="" style="color: black"><p>Prepared By : 
                                                <?php
                                                $query = mysqli_query($con, "select * from user where user_id='$id'")or die(mysqli_error($con));
                                                $row = mysqli_fetch_array($query);

                                                echo $row['name'];
                                                ?> 
                                                <?php echo '<br>' . ' Quotation is only valid for 7 days from day of issuance. '; ?>
                                            </p>
                                    </tr>

                                </div> 
                                </html>

