<?php

require('fpdf/fpdf.php');
include('../dist/includes/dbcon.php');

session_start();


$date = $_POST['date'];
$date = explode('-', $date);

$start = date("Y-m-d", strtotime($date[0]));
$startDate = $start . " 00:00:00";
$end = date("Y-m-d", strtotime($date[1]));
$endDate = $end . " 00:00:00";
$stop_date = date('Y-m-d H:i:s', strtotime($endDate . ' +1 day'));
$toll_id = $_POST['toll_id'];
 $branch_id = $_POST['branch_id'];

$pdf = new FPDF();
$pdf->AddPage('L', 'A4');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', '', 11);
$pdf->SetTitle("Transaction Statement Report");

//$pdf->Image($TaxObject->getCompanyLogo($compId), 35, 2, 150, 40, "JPG");
$pdf->Image("header.jpg", 115, 2, 50, 40, "JPG");
$pdf->Cell(450, 35, " ");
$pdf->Ln();
$pdf->MultiCell(0, 10, "Transaction Statement Report from  " . $start . " To  " . $end . "", 0, 'C');
$pdf->Cell(450, 7, "_______________________________________________________________________________________________________________________________________________");
$pdf->Ln();

$pdf->Cell(40, 9, "Date.");
$pdf->Cell(35, 9, "Reference");
$pdf->Cell(40, 9, "Acc");
$pdf->Cell(50, 9, "Transaction Details");
$pdf->Cell(50, 9, "Debit");
$pdf->Cell(50, 9, "Credit");
$pdf->Cell(50, 9, "Balance");
$pdf->Ln();
$total = 0;
 $total_balance = 0;
 $totalDebit=0;
$total_credit = 0;
$total_debit = 0;

if($branch_id!="all_branches"){
                                                              $query = mysqli_query($con, "SELECT date_added,invoice_no,amount_due,customer.cust_first,customer.cust_last FROM `sales`"
                                                                . " INNER JOIN customer on customer.cust_id=sales.customer_id  "
                                                                . "AND date_added BETWEEN '$startDate' AND '$stop_date'  AND sales.customer_id='$branch_id' ")or die(mysqli_error($con));
                                                        }else{
                                                            
                                                             $query = mysqli_query($con, "SELECT date_added,invoice_no,amount_due,customer.cust_first,customer.cust_last FROM `sales`"
                                                                . " INNER JOIN customer on customer.cust_id=sales.customer_id  "
                                                                . "AND date_added BETWEEN '$startDate' AND '$stop_date'")or die(mysqli_error($con)); 
                                                        }
while ($row = mysqli_fetch_array($query)) {

    $date_added = $row['date_added'];
    $invoice_no = $row['invoice_no'];
    $amount_due = $row['amount_due'];
   
    //$total += $row['amount_deducted'];

    $damagesQuery = mysqli_query($con, "SELECT SUM(amount) AS credit FROM `credit_payments` "
            . "WHERE invoice_no='$invoice_no' "
            . "GROUP BY invoice_no ")or die(mysqli_error($con));

    $Rows = mysqli_fetch_array($damagesQuery);

    if (mysqli_num_rows($damagesQuery) > 0) {
        $totalCredit = $Rows['credit'];
        $total_credit += $totalCredit;
        //echo $Rows['credit'];
    } else {
        $totalCredit = 0;
        //echo '0.00';
    }


    $balance = $row['amount_due'] - $totalCredit;
    $total_balance += $balance;
     $totalDebit += $row['amount_due'];
     
     $acountName = $row['cust_first'].' '.$row['cust_last'];
     
    $pdf->Cell(40, 9, date("M d, Y", strtotime($date_added)));
    $pdf->Cell(35, 9, $invoice_no);
    $pdf->Cell(40, 9, $acountName);
    $pdf->Cell(50, 9, $invoice_no);
    $pdf->Cell(50, 9, $amount_due);
    $pdf->Cell(50, 9, $totalCredit);
    $pdf->Cell(50, 9, $balance);

    $pdf->Ln();
}

$pdf->Cell(450, 2, "_______________________________________________________________________________________________________________________________________________");
$pdf->Ln();
$pdf->Cell(40, 9, "");
$pdf->Cell(35, 9, "");
$pdf->Cell(40, 9, "");
$pdf->Cell(50, 9, "");
$pdf->Cell(50, 9, number_format($totalDebit,2));
$pdf->Cell(50, 9, "Total Balance");
$pdf->Cell(50, 9, " K " . number_format($total_balance, 2));

$pdf->Output();
?>
