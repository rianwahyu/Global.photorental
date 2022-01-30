<?php

include '../connection.php';

if (isset($_POST)) {
    $item_id = $_POST['item_id'];
    $quantity = 1;
    $price = $_POST['price'];
    $diskon = $_POST['diskon'];

    $total_price = $quantity * $price;

    $query = "INSERT INTO `cart_temp`(`item_id`, `quantity`, `price`, `total_price`) 
    VALUES ('$item_id', '$quantity', '$price', '$total_price')";
    $result = mysqli_query($dbc, $query);
    if ($result == true) {
        $data['hasil'] = 'success';
    } else {
        $data['hasil'] = 'failed';
    }

    echo json_encode($data);
}
