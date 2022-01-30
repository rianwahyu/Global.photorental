<?php

include '../connection.php';

$id = $_POST['id'];

$query = "DELETE FROM `cart_temp` WHERE `idCart`='$id' ";
// echo $query;
$result = mysqli_query($dbc, $query);
if ($result == true) {
    $data['hasil'] = 'success';
} else {
    $data['hasil'] = 'failed';
}

echo json_encode($data);

//$result = mysqli_query($dbc, $query);

// if($result == true){
//     echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
// }else{
//     echo "<meta http-equiv='refresh' content='1 url=../../order_add'>";
// }