<?php

include '../connection.php';

$idCart = $_POST['idCart'];

$query = "DELETE FROM `cart_temp` WHERE `idCart`='$idCart' ";

$result = mysqli_query($dbc, $query);

if($result == true){
    echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
}else{
    echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
}