
<?php

session_start();

$data[] = array('Category', 'Amount Collected');
$con = mysqli_connect("localhost", "root", "", "inventory");

include ('../Objects/Objects.php');
$Objects = new InvObjects();

if (isset($_SESSION['sales_date_cat'])){
    $date = $_SESSION['sales_date_cat'];
    $date = explode('-', $date);
    $branch = $_SESSION['branch'];
    $start = date("Y-m-d", strtotime($date[0]));
    $startDate = $start . " 00:00:00";
    $end = date("Y-m-d", strtotime($date[1]));
    $endDate = $end . " 00:00:00";
    $sql = mysqli_query($con, "SELECT SUM(quantity) AS quantity, SUM(price) AS price,cat_id FROM `sales_tb` INNER JOIN product ON sales_tb.item_sold_id = product.prod_id AND sales_tb.sales_date BETWEEN '" . $startDate . "' AND '$endDate' GROUP BY item_sold_id")or die(mysqli_error($con));
} else {
    $sql = mysqli_query($con, "SELECT SUM(quantity) AS quantity, SUM(price) AS price,cat_id FROM `sales_tb` INNER JOIN product ON sales_tb.item_sold_id = product.prod_id GROUP BY item_sold_id");
}

if (mysqli_num_rows($sql) > 0) {
    while ($result = mysqli_fetch_array($sql)) {        
        $Amount = $result['quantity'] * $result['price'];
        $sale = (int) $Amount;
        $data[] = array($Objects->getCategoryById($con, $result['cat_id']), $sale);
    }
} else {
    $sale = (int) 0;
    $data[] = array("No Records", $sale);
}

echo json_encode($data);
?>
