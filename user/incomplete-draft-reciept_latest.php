<!DOCTYPE html>
<!-- partial:index.partial.html -->
<?php include('../dist/includes/dbcon.php'); ?>
<html>


<?php
error_reporting(0);
session_start();

include('Classes/Company.php');
$company = new Company();

?>
<?php
$id = $_SESSION['id'];
$queryb = mysqli_query($con, "select * from branch") or die(mysqli_error($con));
$rowb = mysqli_fetch_array($queryb);

function AmountInWords($amount)
{
    $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
    // Check if there is any number after decimal
    $amt_hundred = null;
    $count_length = strlen($num);
    $x = 0;
    $string = array();
    $change_words = array(
        0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
    );
    $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($x < $count_length) {
        $get_divider = ($x == 2) ? 10 : 100;
        $amount = floor($num % $get_divider);
        $num = floor($num / $get_divider);
        $x += $get_divider == 10 ? 1 : 2;
        if ($amount) {
            $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
            $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
            $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
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
$branch = $_SESSION['branch'];
$orderno = $_GET['orderno'];

$query = mysqli_query($con, "SELECT cust_id from draft_temp_trans  where order_no='$orderno' ") or die(mysqli_error($con));
$row = mysqli_fetch_array($query);
$customer_id = $row['cust_id'];
$mode_payment = $row['name'];

$invoiceNo = $orderno;

$customer = mysqli_query($con, "SELECT * FROM `customer` WHERE cust_id ='$customer_id' ") or die(mysqli_error($con));

//echo '$customer_id '.$customer_id;

$customerRows = mysqli_fetch_array($customer);
?>

<center>
    <a class="btn btn-success btn-print" href="" onclick="window.print()"><i class="glyphicon glyphicon-print"></i> Print</a>
    <a class="btn btn-primary btn-print" href="draft-sale"><i class="glyphicon glyphicon-arrow-left"></i> | Back</a>
</center>
<br></br>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="style.css">

</head>
<style type="text/css">
    tr td {
        padding-top: -10px !important;
        border: 1px solid #000;
    }

    @media print {
        .btn-print {
            display: none !important;
        }
    }
</style>

<!-- <body onload="window.print()"> -->
<body>
    <header>
        <div style="display: flex; width: 100%; text-align: center; justify-content: center">
            <div style="width:90px; height:90px; margin-top: -29px;">
                <img style="width:100%;" src="../dist/uploads/comp/<?php echo $company->logo($con); ?>" />
            </div>
            <p style="font-weight: bold; margin-top: 10px; font-size:20px"><?php
                                                                            echo $company->compName($con);
                                                                            ?></p>
        </div>
        <h1>Tax Invoice</h1>
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
                    <div style="font-size: 13px;">To Customer : <?php echo $customerRows['cust_first'] . ' ' . $customerRows['cust_last']; ?></div>
                    <div style="font-size: 13px;"><?php
                                                    echo '<br> TPIN: ' . $customerRows['account_no'];
                                                    ?></div>
                    <div style="font-size: 13px;"><?php
                                                    echo '<br> Address : ' . $customerRows['cust_address'];
                                                    ?></div>
                    <div style="font-size: 13px;"><?php
                                                    echo '<br> Contact Number: ' . $customerRows['cust_contact'];
                                                    ?>
                    </div>

                </div>
            </div>

            <div style="border: none; width:60%">
                <table class="topHeaderTable">
                    <tr>
                        <th>
                            <div>Invoice No.</div>
                            <p style="font-weight: bold; padding-top:5px">
                                <?php echo $invoiceNo; ?>
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
                    <div style="padding-top:5px;padding-left: 8px; font-size:12px; margin-bottom:60px; border:none; border-top:1px solid #ccc">
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
                $get_latest = mysqli_query($con, "SELECT updated FROM draft_temp_trans
                                    WHERE order_no='$orderno' ORDER BY updated DESC LIMIT 1")or die("latest error: ".mysqli_error($con));
                $get_latest_row = mysqli_fetch_array($get_latest);

                $latest_date = $get_latest_row['updated'];
                                
                $query1 = mysqli_query($con, "SELECT discount_type,updated,amount,description,temp_trans_id,prod_name,price AS prod_sell_price,
                    SUM(qty) AS qty from draft_temp_trans 
                    LEFT JOIN product ON product.prod_id=draft_temp_trans.prod_id 
                    WHERE order_no='$orderno'
                    AND updated = '$latest_date'
                    GROUP BY description,prod_name, updated ") or die(mysqli_error($con));
                $grand = 0;
                $grand = 0;
                $grand = 0;
                $totalDiscount = 0;
                // echo "records found: ".mysqli_num_rows($query1);
                while ($row = mysqli_fetch_array($query1)) {
                    $order_no = $row['order_no'];
                    $count++;
                    if ($row['prod_name'] == '') {
                        $prodName = $row['description'];
                    } else {
                        $prodName = $row['prod_name'];
                    }

                    $price = $row['prod_sell_price'];
                    $total = $row['qty'] * $row['prod_sell_price'];

                    $subTotal_ += $row['qty'] * $price;
                    $pack_size = $row['pack_size'];


                    $amount = $row['amount'];
                    $discount_type = $row['discount_type'];
                    if ($amount != "") {
                        if ($discount_type == "Percentage") {
                            $newPrice = ($amount / 100) * ($row['prod_sell_price'] * $row['qty']);
                            //$newPrice = $price - $computedPrice;
                        } else {
                            $newPrice = $amount;
                        }
                        $total_ = ($row['prod_sell_price'] * $row['qty']) - $newPrice;
                    } else {
                        $total_ = ($row['prod_sell_price'] * $row['qty']);
                    }

                    //$unitPrice = $row['price'] / $row['qty'];
                    //$grand = $grand + $total;
                    $totalDiscount += $newPrice;


                    $grand = $grand + $total;

                    echo ' <tr><td>' . $count . '</td>
                                        <td>' . $prodName . ' '.$row["updated"].'</td>
                                        <td>' . $row['qty']  . '</td>
                                        <td>' . $price . '</td>
                                        <td>' . $pack_size . '</td>
                                        <td>' . $total . '</td>
                                        <td>' . $discount_type . ' %</td>
                                        <td><span data-prefix>ZMK </span><span>' . $total . '</span></td> </tr>';
                }

                $amountLessVat = ($vatFinalTotal / 1.16);
                $vatValue = $vatFinalTotal - $amountLessVat;

                $subTotal += ($subTotal_ - $discount) / 1.16;
                $totalVatAmountonsider = $subTotal_ - ($subTotal_ - $discount) / 1.16;

                $totalExlVAT = $vatFinalTotal - $vatValue;

                $Partpaymentsquery = mysqli_query($con, "SELECT SUM(amount) AS amount FROM `part_payments_tb` INNER JOIN user ON user.user_id=part_payments_tb.user_id AND order_no='$orderno' GROUP BY order_no") or die(mysqli_error($con));
                $grand = 0;

                $pppaymentsrow = mysqli_fetch_array($Partpaymentsquery);
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
                    <div>Total Exl VAT</div>
                </td>
                <td class="bold">
                    <div>ZMK <?php echo number_format($subTotal, 2); ?></div>
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
                    <div>Discount @ <?php echo $discount_type; ?> % </div>
                </td>
                <td class="bold">
                    <div><?php echo $discount; ?></div>
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
                    <div>VAT @ 16% </div>
                </td>
                <td class="bold">
                    <div><?php echo number_format($totalVatAmountonsider, 2); ?></div>
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
                    <div>ZMK <?php
                                $fin_total = ($subTotal - $discount) + $totalVatAmountonsider;
                                echo number_format($fin_total, 2); ?></div>
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
                    <div>Deposit</div>
                </td>
                <td class="bottomBox bold">
                    <div>ZMK <?php echo number_format($pppaymentsrow['amount'], 2); ?></div>
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
                    <div>Balance Due</div>
                </td>
                <td class="bottomBox bold">
                    <div>ZMK <?php
                                $bal_due = $fin_total - $pppaymentsrow['amount'];
                                echo number_format($bal_due, 2); ?></div>
                </td>
            </tr>

        </table>
        <!-- <a class="add">+</a> -->
        <div style="border:none; border-top: 1px solid #3b3b3b; margin-top:5px">
            <div style="display:flex; justify-content: space-between;">

                <div style="padding-left: 10px; padding-right: 10px; padding-top: 10px; height:100px">
                    <p style="font-size:12px">Amount (in words)</p>
                    <p style="font-size:13px; font-weight:bold">
                        <?php
                        $ttal = ($subTotal - $discount) + $totalVatAmountonsider;
                        echo AmountInWords($bal_due) . ' ( Kwacha ) ' ?>
                    </p>
                </div>

                <div style="font-size:13px; padding:10px">
                    <p>E.& O.E</p>
                </div>
            </div>

            <div style="display:flex; font-size:13px; justify-content:space-between; ">
                <div style="width: 40%; padding:10px">
                    <div style="margin-bottom: 7px; border:none; border-bottom: 1px solid #ccc; padding-bottom:6px">
                        <div style="font-size: 15px;">
                            Signature:
                        </div>
                        <div style="font-size: 15px;">
                            Received By:
                        </div>
                        <div style="font-size: 15px;">
                            Registration Number:
                        </div>
                    </div>

                    <div style="text-decoration: underline; font-size: 14px;">Declaration</div>
                    <div>
                        We declare that this Invoice shows the actual price of the goods described and that all
                        particulars are true and correct.
                    </div>
                </div>


            </div>
        </div>

        <div style="display: flex; justify-content: space-between; font-size:13px; ">
            <div style="width: 50%; padding: 10px; height:50px">
                Customer Signature
            </div>
            <div style="width: 50%; border:none; border-top: 1px solid #3b3b3b; border-left: 1px solid #3b3b3b;">
                <div style="font-weight: bold; text-align: left;">
                    for <?php
                        echo $company->compName($con);
                        ?>
                </div>
                <div style="margin-top:10px; display: flex; justify-content:flex-end; margin-right:18px;">
                    Authorised Signatory
                </div>
            </div>
        </div>

    </article>

</body>

</html>