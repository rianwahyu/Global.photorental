<?php

include '../connection.php';

$item_id = $_POST['item_id'];
$order_id = $_POST['order_id'];
$order_date = $_POST['order_date'];
$customer_id = $_POST['customer_id'];
$pick_up_date = $_POST['pick_up_date'];
$return_date = $_POST['return_date'];
// $quantity = $_POST['quantity'];
// $price = $_POST['price'];
$denda = $_POST['denda'];
$diskon = $_POST['diskon'];
$dp = $_POST['dp'];
$total = $_POST['price'] + $_POST['denda'] - $_POST['diskon'];

$status = "";
if ($dp > 0) {
    $status = "Booked";
} else {
    $status = "Pending Down Payment";
}

$query = "";

$query = $query . " INSERT INTO `order_tbl`(`item_id`, `order_id`, `order_date`, `customer_id`, `pick_up_date`, `return_date`, `denda`, `diskon`, `total_price`, dp, status) VALUES ('$item_id', '$order_id','$order_date','$customer_id','$pick_up_date', '$return_date', '$denda', '$diskon', '$total', '$dp', '$status') ; ";

if ($dp > 0) {
    $query = $query . " UPDATE item_tbl SET status='Booked' WHERE item_id='$item_id'; ";
} else {
    $query = $query . " UPDATE item_tbl SET status='Pending Down Payment' WHERE item_id='$item_id'; ";
}


// $result = mysqli_query($dbc, $query);
// // echo $query;
// if($result == true){
//     echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
// }else{
//     echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
// }

if (mysqli_multi_query($dbc, $query)) {
    echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
} else {
    echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
}
