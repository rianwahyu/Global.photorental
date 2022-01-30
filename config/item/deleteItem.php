<?php

include '../connection.php';

$item_id = $_POST['item_id'];

$query = "DELETE FROM `item_tbl` WHERE `item_id`='$item_id'";

//echo $query;

$result = mysqli_query($dbc,$query);

if ($result === TRUE){
    header("location:../../master_item");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../master_item'>";
}

mysqli_close($dbc);