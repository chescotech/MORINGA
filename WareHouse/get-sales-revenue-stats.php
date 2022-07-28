
<?php

session_start();

$data[] = array('Revenue Date', 'Revenue Amount');
$con = mysqli_connect("localhost", "root", "", "inventory");

if (isset($_SESSION['sales_date'])) {
    $date = $_SESSION['sales_date'];
    $date = explode('-', $date);
    $branch = $_SESSION['branch'];
    $start = date("Y-m-d", strtotime($date[0]));
    $startDate = $start . " 00:00:00";
    $end = date("Y-m-d", strtotime($date[1]));
    $endDate = $end . " 00:00:00";
    $sql = mysqli_query($con, "SELECT * FROM `sales_tb` INNER JOIN product ON sales_tb.item_sold_id = product.prod_id AND sales_tb.sales_date BETWEEN '" . $startDate . "' AND '$endDate' ")or die(mysqli_error($con));
} else {
    $sql = mysqli_query($con, "SELECT * FROM `sales_tb` INNER JOIN product ON sales_tb.item_sold_id = product.prod_id");
}

if (mysqli_num_rows($sql) > 0){
    while ($result = mysqli_fetch_array($sql)){
        $cDate = date("M j, Y", strtotime($result['sales_date']));
        $Amount = $result['quantity'] * $result['price'];
        $sale = (int) $Amount;
        $data[] = array($cDate, $sale);
    }
}else{
    $sale = (int) 0;
    $data[] = array("No Records", $sale);
}
echo json_encode($data);
?>
