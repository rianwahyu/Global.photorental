<?php

include '../connection.php';

$item_id = $_POST['item_id'];
$item_name = $_POST['item_name'];
$merk = $_POST['merk'];
$category = $_POST['category'];
$price = $_POST['price'];
// $stock = $_POST['stock'];
// $status = $_POST['status'];
$tgl_pembelian = $_POST['tgl_pembelian'];

$query = "UPDATE `item_tbl` SET `item_name`='$item_name',`merk`='$merk',`category`='$category', `price`='$price',`tgl_pembelian`='$tgl_pembelian' WHERE item_id='$item_id' ";

$result = mysqli_query($dbc, $query);

if ($result === TRUE){
    header("location:../../master_item?search=$item_id");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../master_item'>";
}

mysqli_close($dbc);