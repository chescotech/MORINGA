<!DOCTYPE html>
<!-- partial:index.partial.html -->
<?php include('../dist/includes/dbcon.php'); ?>
<html>
    <?php
    error_reporting(0);
    session_start();

    $id = $_SESSION['id'];
    $queryb = mysqli_query($con, "select * from branch")or die(mysqli_error($con));
    $rowb = mysqli_fetch_array($queryb);

    $branch = $_SESSION['branch'];

    $invoice2 = mysqli_query($con, "SELECT MAX(id) AS id FROM invoices_tb")or die(mysqli_error($con));
    $rowss = mysqli_fetch_array($invoice2);
    $invoiceNo = $rowss['id'];
    $cust_first = $_POST['customer'];
    $customer_ = mysqli_query($con, "SELECT * FROM `customer` WHERE cust_first ='$cust_first' ")or die(mysqli_error($con));
    $quote_number = $_GET['quote_id']; //$quotaton_rows['quote_id'];

    $customerRows = mysqli_fetch_array($customer_);
    ?>
    <?php
    $id = $_SESSION['id'];
    $queryb = mysqli_query($con, "select * from branch")or die(mysqli_error($con));
    $rowb = mysqli_fetch_array($queryb);

    function AmountInWords($amount) {
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($x < $count_length) {
            $get_divider = ($x == 2) ? 10 : 100;
            $amount = floor($num % $get_divider);
            $num = floor($num / $get_divider);
            $x += $get_divider == 10 ? 1 : 2;
            if ($amount) {
                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                $string [] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
       ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
       ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
            } else
                $string[] = null;
        }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
        return ($implode_to_Rupees ? $implode_to_Rupees . ' ' : '') . $get_paise;
    }
    ?>

    <?php
    $id = $_SESSION['id'];
    $customer = $_POST['customer'];
    $exchange_id = $_POST['exchange_id'];
    
    include('Classes/Company.php');
    $company = new Company();

    $quotes = mysqli_query($con, "SELECT MAX(quote_id) AS quote_id FROM `quotation_tb` ") or die(mysqli_error($con));
    $quoteRows = mysqli_fetch_array($quotes);
    $quote_identity = $quoteRows['quote_id'] + 1;
    $discountAmount = $_POST['discount'];

    mysqli_query($con, " UPDATE  quotation_tb SET quote_id='$quote_identity',customer='$customer',discount='$discountAmount',currency='$exchange_id' WHERE status !='printed' ") or die(mysqli_error($con));

    $queryb = mysqli_query($con, "select * from branch") or die(mysqli_error($con));
    $rowb = mysqli_fetch_array($queryb);
    $reciept_footer_text = $rowb['reciept_footer_text'];

    // echo $rowb['branch_name'];

    $queryQuote = mysqli_query($con, "select MAX(quote_id) AS quote_id  from quotation_tb") or die(mysqli_error($con));
    $quotaton_rows = mysqli_fetch_array($queryQuote);
    //$quote_number = $quote_identity; //$quotaton_rows['quote_id'];
    ?>
    <center>
        <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a> 
        <a class = "btn btn-primary btn-print" href = "quotations.php"><i class ="glyphicon glyphicon-arrow-left"></i> |  NEXT QUOTE</a>
    </center>
    <br></br>
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <link rel="stylesheet" href="style.css">

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
    <body onload="window.print()">
        <header>
            <div style="display: flex; width: 100%; text-align: center; justify-content: center">
                <div style="width:90px; height:90px; margin-top: -29px;">
                    <img style="width:100%;" src="../dist/uploads/comp/<?php echo $company->logo($con); ?>" />
                </div>
                <p style="font-weight: bold; margin-top: 10px; font-size:20px"><?php
                    echo $company->compName($con);
                ?></p>
            </div>
            <h1>Quotation</h1>
        </header>
        <article>

            <div class="TopAddress">
                <div style="border: none; border-right: 1px solid #3b3b3b; width:40%; padding: 10px;">
                    <div style="display:flex; justify-content:space-between;">
                        <div style="padding-bottom: 5xp;">
                            <br />
                            <p style="font-size: 13px;"><?php echo $company->tPin($con); ?></p>
                            <br />
                            <p style="font-size: 13px;">Address: <?php echo $company->address($con); ?></p>
                            <br />
                            <p style="font-size: 13px;">Contact: <?php echo $company->contact($con); ?></p>
                            <br />
                        </div>
                    </div>
                    <div style="border:none; border-top: 1px solid #3b3b3b;">
                        <div style="font-size: 13px;">Quote To: <?php echo $customerRows['cust_first']; ?></div>                    
                        <div style="font-size: 13px;">TPIN : <?php echo $customerRows['account_no']; ?></div>
                        <div style="font-size: 13px;"> Address : <?php echo $customerRows['cust_address']; ?></div>
                        <div style="font-size: 13px;"> Contact : <?php echo $customerRows['cust_contact']; ?></div>
                    </div>
                </div>

                <div style="border: none; width:60%">
                    <table class="topHeaderTable">
                        <tr>
                            <th>
                                <div>Quotation No.</div>
                                <p style="font-weight: bold; padding-top:5px">                                    
                                    <?php echo $quote_number; ?>
                                </p>
                            </th>
                            <td>
                                <div>Dated</div>
                                <div style="font-weight: bold; padding-top: 5px;">
                                    <?php
                                    echo date("M d, Y");
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <div>Supplier's Ref.</div>
                                <div style="font-weight: bold; padding-top: 5px;"></div>
                            </th>
                            <td>
                                <div></div>
                                <div style="font-weight: bold; padding-top: 5px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <div>Buyer's Order No.</div>
                                <div style="font-weight: bold; padding-top: 5px;"></div>
                            </th>
                            <td>
                                <div></div>
                                <div style="font-weight: bold; padding-top: 5px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <div>Despatch Document No.</div>
                                <div style="font-weight: bold; padding-top: 5px;"></div>
                            </th>
                            <td>
                                <div></div>
                                <div style="font-weight: bold; padding-top: 5px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <div>Despatch through</div>
                                <div style="font-weight: bold; padding-top: 5px;"></div>
                            </th>
                            <td>
                                <div></div>
                                <div style="font-weight: bold; padding-top: 5px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <div>Exchange Rate</div>
                                <div style="font-weight: bold; padding-top: 5px;"></div>
                            </th>
                            <td>
                                <div><?php echo number_format($rate, 2); ?></div>
                                <div style="font-weight: bold; padding-top: 5px;"></div>
                            </td>
                        </tr>

                    </table>
                    <div>
                        <div
                            style="padding-top:5px;padding-left: 8px; font-size:12px; margin-bottom:60px; border:none; border-top:1px solid #ccc">
                            Terms of Delivery
                        </div>
                    </div>
                </div>
            </div>
            <table class="inventory">
                <thead>
                    <tr>
                        <th class="num">No.</th>
                        <th class="dis">Description</th>
                        <th class="qt">Quantity</th>
                        <th class="rate">Rate</th>
                        <th class="per">Unit</th>
                        <th class="per">Item Value</th>
                        <th class="per">Dis</th>
                        <th class="amount">ZMK | USD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //$query = mysqli_query($con, "select * from sales_details LEFT join product on product.prod_id=sales_details.prod_id where sales_id='$sid'")or die(mysqli_error($con));
                    $query = mysqli_query($con, "select * from quotation_tb LEFT join product on product.prod_id=quotation_tb.prod_id"
                            . " WHERE quote_id='$quote_number'") or die(mysqli_error($con));

                    $grand = 0;
                    $count = 0;
                    while ($row = mysqli_fetch_array($query)) {
                        $count ++;
                        $order_no = $row['order_no'];

                        if ($row['prod_name'] == '') {
                            $prodName = $row['description'];
                        } else {
                            $prodName = $row['prod_name'];
                        }

                        $price = $row['price'];
                        $currency_id = $row['currency'];
                        $discountAmount2 = $row['discount'];

                        $total = $row['qty'] * $row['price'];
                        $subTotal += $row['qty'] * $row['price'];
                        //$pack_size = $row['pack_size'];
                        $grand = $grand + $total;
                        if ($row['barcode'] == "") {
                            $prodCode = '0.00';
                        } else {
                            $prodCode = $row['barcode'];
                        }
                        $qty = $row['qty'];

                        if ($row['vat_status'] != "free") {
                            $vatFinalTotal += ($row['qty'] * $row['price'] ) - $discountAmount2;
                        } else if ($row['vat_status'] == "free") {
                            $vatFree += ($row['qty'] * $row['price'] );
                        }
                        $pack_size = $row['pack_size'];
                        echo ' <tr><td>' . $count . '</td>
                                        <td>' . $prodName . '</td>
                                        <td>' . $qty . '</td>
                                        <td>' . $price . '</td>
                                        <td>' . $pack_size . '</td>
                                        <td>' . $total . '</td>
                                        <td></td>
                                        <td><span data-prefix>' . $currency_id . ' </span><span> ' . $total . '</span></td> </tr>';
                    }

                    $amountLessVat = ($vatFinalTotal / 1.16);
                    $vatValue = $vatFinalTotal - $amountLessVat;
                    $totalExlVAT = $vatFinalTotal - $vatValue;
                    $new_amount_due = ($discountAmount2 / 100) * $subTotal;

                    $totalVatAmountonsider = ($subTotal - $new_amount_due) * 0.16;
                    $amountLessVat2 = ($totalVatAmountonsider / 1.16);
                    $vatValue2 = $totalVatAmountonsider;

                    mysqli_query($con, " UPDATE  quotation_tb SET quote_id='$quote_identity',customer='$customer',status='printed' WHERE status !='printed' ") or die(mysqli_error($con));
                    ?>
                </tbody>
            </table>
            <div style="border:none; border-top: 1px solid #3b3b3b"></div>
            <table class="totals" style="border-collapse: collapse;">
                <tr>
                    <td class="num blank">
                    </td>
                    <td class="dis blank">
                    </td>
                    <td class="qt blank">
                    </td>
                    <td class="blank">
                    </td>
                    <td class="leftSide bold">
                        <div>Sub Total</div>
                    </td>
                    <td class="bold">
                        <div> <?php echo $currency_id . ' ' . number_format($subTotal, 2); ?></div>
                    </td>
                </tr>

                <tr>
                    <td class="num blank">
                    </td>
                    <td class="dis blank">
                    </td>
                    <td class="qt blank">
                    </td>
                    <td class="blank">
                    </td>
                    <td class="leftSide bold">
                        <div>Discount @ <?php echo $discountAmount2; ?> % </div>
                    </td>
                    <td class="bold">
                        <div><?php echo $currency_id . ' ' . number_format($new_amount_due, 2); ?></div>
                    </td>
                </tr>

                <tr>
                    <td class="num blank">
                    </td>
                    <td class="dis blank">
                    </td>
                    <td class="qt blank">
                    </td>
                    <td class="blank">
                    </td>
                    <td class="leftSide bold">
                        <div>Vat @ 16 %</div>
                    </td>
                    <td class="bold">
                        <div> <?php echo $currency_id . ' ' . number_format($vatValue2, 2); ?></div>
                    </td>
                </tr>


                <tr>
                    <td class="num blank">
                    </td>
                    <td class="dis blank">

                    </td>
                    <td class="qt blank">
                    </td>
                    <td class="blank">
                    </td>
                    <td class="bottomBox leftSide bold">
                        <div>Total</div>
                    </td>
                    <td class="bottomBox bold">
                        <div> <?php echo $currency_id . ' ' . number_format(($subTotal - $new_amount_due) + $vatValue2, 2); ?></div>
                    </td>
                </tr>

            </table>
            <!-- <a class="add">+</a> -->
            <div style="border:none; border-top: 1px solid #3b3b3b; margin-top:5px">
                <div style="display:flex; justify-content: space-between;">

                    <div style="padding-left: 10px; padding-right: 10px; padding-top: 10px; height:100px">
                        <p style="font-size:12px">Amount (in words)</p>
                        <p style="font-size:13px; font-weight:bold">
                            <?php echo AmountInWords($subTotal - $new_amount_due) . ' ( ' . $currency_id . ' ) ' ?>
                        </p>
                    </div>

                    <div style="font-size:13px; padding:10px">
                        <p>E.& O.E</p>
                    </div>
                </div>

                <div style="display:flex; font-size:13px; justify-content:space-between; ">
                    <div style="width: 40%; padding:10px">


                        <div style="text-decoration: underline; font-size: 14px;">Validity of Quotation</div>
                        <div>
                            Quotation is valid for 7 Days
                        </div>
                    </div>


                    <div style="width: 50%;">
                        <div style="padding:10px">
                            <p>Company's Bank Details</p>
                            <div style="display:flex">
                                <p>Bank Name</p>
                                <p style="margin-left: 52px; font-weight: bold">: INDO Zambia Bank</p>
                            </div>
                            <div style="display:flex">
                                <p style="margin-left: 40px; font-weight: bold">

                                    ZMK Acc No :  0162030000555</p>

                            </div>
                            <div style="display:flex">

                                <p style="margin-left: 40px; font-weight: bold">USD Acc No : 016203100019</p>

                            </div>
                            <div style="display:flex">
                                <p>Sort Code:</p>
                                <p style="margin-left: 58px; font-weight: bold">: 090016</p>
                            </div>
                            <div style="display:flex">
                                <p>Swift Code:</p>
                                <p style="margin-left: 54px; font-weight: bold">: INZAZMLX</p>
                            </div>
                        </div>


                    </div>


                </div>
            </div>

            <div style="display: flex; justify-content: space-between; font-size:13px; ">
                <div style="width: 50%; padding: 10px; height:50px">
                    Customer Signature
                </div>
                <div style="width: 50%; border:none; border-top: 1px solid #3b3b3b; border-left: 1px solid #3b3b3b;">
                    <div style="font-weight: bold; text-align: center;">
                        for SOUTHERN SWITCHGEAR & AUTOMATION LTD
                    </div>
                    <div style="margin-top:10px; display: flex; justify-content:flex-end; margin-right:18px;">
                        Authorised Signatory
                    </div>
                </div>
            </div>

        </article>

    </body>

</html>