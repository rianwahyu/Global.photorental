<?php

include '../connection.php';

$id = $_POST['id'];

$query = "DELETE FROM `merk_tbl` WHERE `id`='$id'";

//echo $query;

$result = mysqli_query($dbc,$query);

if ($result === TRUE){
    header("location:../../merk");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../merk'>";
}

mysqli_close($dbc);