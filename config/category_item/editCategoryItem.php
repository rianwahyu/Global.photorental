<?php

include '../connection.php';

$id = $_POST['id'];
$name = $_POST['category_name'];

$query = "UPDATE `category_tbl` SET `category_name`='$name' WHERE id='$id' ";

$result = mysqli_query($dbc, $query);

if ($result === TRUE){
    header("location:../../category_item?search=$id");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../category_item'>";
}

mysqli_close($dbc);