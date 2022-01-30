<?php

include '../connection.php';

$id = $_POST['id'];

$query = "DELETE FROM `category_tbl` WHERE `id`='$id'";

//echo $query;

$result = mysqli_query($dbc,$query);

if ($result === TRUE){
    header("location:../../category_item");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../category_item'>";
}

mysqli_close($dbc);