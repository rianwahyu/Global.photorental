<?php

include '../connection.php';

$order_id = $_POST['order_id'];

$query = "DELETE FROM `order_tbl` WHERE `order_id`='$order_id' ";
//echo $query;

$result = mysqli_query($dbc, $query);

if($result == true){
    echo "<meta http-equiv='refresh' content='1 url=../../order_list'>";
}