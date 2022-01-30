<?php

include '../connection.php';

$id = $_POST['id'];
$name = $_POST['name'];

$query = "UPDATE `merk_tbl` SET `name`='$name' WHERE id='$id' ";

$result = mysqli_query($dbc, $query);

if ($result === TRUE){
    header("location:../../merk?search=$id");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../merk'>";
}

mysqli_close($dbc);