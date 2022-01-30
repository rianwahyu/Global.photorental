<?php

include '../connection.php';

$item_id = $_POST['item_id'];
$item_name = $_POST['item_name'];
$merk = $_POST['merk'];
$category = $_POST['category'];
$price = $_POST['price'];
// $stock = $_POST['stock'];
$status = $_POST['status'];
$tgl_pembelian = $_POST['tgl_pembelian'];

$query = "INSERT INTO `item_tbl`(`item_id`, `item_name`, `merk`, `category`, `price`, `status`, `tgl_pembelian`) VALUES ('$item_id', '$item_name', '$merk', '$category', '$price', '$status', '$tgl_pembelian')";
// echo $query;
$result = mysqli_query($dbc, $query);
//echo $query;
if ($result === TRUE) {
    header("location:../../master_item");
} else {
    echo "<script>alert('Add data failed. Clik Ok)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../master_item'>";
}

mysqli_close($dbc);
