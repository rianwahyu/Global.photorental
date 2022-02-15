<?php

include '../connection.php';

if (isset($_POST)) {
    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];
    $pick_up_date = $_POST['pick_up_date'];
    $return_date = $_POST['return_date'];
    $diskon = $_POST['diskon'];
    $dp = $_POST['dp'];
}

$arrayCart = array();
$querys = "SELECT * FROM cart_temp";
$results = mysqli_query($dbc, $querys);
if (mysqli_num_rows($results) < 1) {
    $data['hasil'] = 'failed';
    echo json_encode($data);
} else {
    while ($datas = mysqli_fetch_array($results)) {
        $arrayCart[] = $datas;
    }

    $date1 = date_create($pick_up_date);
    $date2 = date_create($return_date);
    $diff = date_diff($date1, $date2);

    $totDays = (round($diff->format("%d")));
    if ($totDays <= 0) {
        $totDays = 1;
    }

    if (empty($diskon)) {
        $diskon = 0;
    }

    if (empty($dp)) {
        $dp = 0;
    }

    $status = "";
    if ($dp > 0) {
        $status = "Booked";
    } else {
        $status = "Pending Down Payment";
    }

    $order_id = getIDOrder();
    $query = "";
    $query = $query . " INSERT INTO `order_tbl`(`order_id`, `order_date`, `customer_id`, `pick_up_date`, `return_date`, `denda`, `diskon`, `dp`, `status`, `year`) VALUES ('$order_id', '$order_date', '$customer_id', '$pick_up_date', '$return_date', '0', '$diskon', '$dp', '$status', NOW() ) ; ";

    $query = $query . " INSERT INTO `order_value_tbl`(order_id, `item_id`,  `quantity`, `price`, `total_price`) VALUES ";

    $total_prices = 0;
    foreach ($arrayCart as $d) {
        $total_prices = $totDays * $d['price'];
        $query = $query . " ('$order_id' ,'" . $d['item_id'] . "',  '$totDays', '" . $d['price'] . "', '$total_prices') ,";
    }

    $query = rtrim($query, ',');
    $query = $query . "; ";
    //echo $query;

    $query = $query . " DELETE FROM `cart_temp` WHERE 1 ; ";
    //echo $query;
    if (mysqli_multi_query($dbc, $query)) {
        $data['hasil'] = 'success';
    } else {
        $data['hasil'] = 'failed';
    }

    echo json_encode($data);
}




function getIDOrder()
{
    include '../connection.php';
    $kode = date('y');
    $year = date('Y');
    $order_id = "";
    $sql = "SELECT order_id FROM order_tbl WHERE year='$year' ORDER BY order_id DESC LIMIT 1 ";
    $res  = mysqli_query($dbc, $sql);
    $data = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) < 1) {
        $order_id = $kode . "0001";
    } else {
        $id = $data["order_id"];
        $id = substr($id, 2);

        $order_id = $kode . str_pad($id + 1, 4, 0, STR_PAD_LEFT);
    }

    return $order_id;
}
