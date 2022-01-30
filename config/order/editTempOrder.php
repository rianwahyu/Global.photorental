<?php

include '../connection.php';

$item_id = $_POST['item_id'];
$order_id = $_POST['order_id'];
$order_date = $_POST['order_date'];
$pick_up_date = $_POST['pick_up_date'];
$return_date = $_POST['return_date'];
// $quantity = $_POST['quantity'];
$price = $_POST['price'];
$denda = $_POST['denda'];
$diskon = $_POST['diskon'];
$dp = $_POST['dp'];
$total = $_POST['price'] + $_POST['denda'] - $_POST['diskon'];
$status = $_POST['status'];


//    echo $query;

$curDate = date('Y-m-d H:i:s');
// echo $curDate."....";
// echo $return_date;
$return_date_real = "";
$remark="";

if ($status == "Done") {
    $date1 = new DateTime($return_date);
    $date2 = new DateTime($curDate);

    $diff = $date2->diff($date1);

    $hours = $diff->h;
    $hours = $hours + ($diff->days * 24);

    if ($hours >= 1) {
        $return_date_real = $curDate;
        $remark="Terlambat mengembalikan";
    } else {
        $return_date_real = $return_date;
        $remark="Dikembalikan tepat waktu";
    }
}else{
    $return_date_real="";
    $remark="";
}

$query = "UPDATE `order_tbl` SET `order_date`='$order_date',`pick_up_date`='$pick_up_date',`return_date`='$return_date',  `denda`='$denda', `diskon`='$diskon', dp='$dp', status='$status', return_date_real='$return_date_real', remark='$remark' 
WHERE  order_id='$order_id' ";


$result = mysqli_query($dbc, $query);
if($result == true){
    echo "<meta http-equiv='refresh' content='1 url=../../order_list?search=$order_id'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../order_list'>";
}