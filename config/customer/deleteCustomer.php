<?php

include '../connection.php';

$customer_id = $_POST['customer_id'];

$query = "DELETE FROM `customer_tbl` WHERE `customer_id`='$customer_id'";

//echo $query;

$result = mysqli_query($dbc,$query);

if ($result === TRUE){
    header("location:../../customer");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../customer'>";
}

mysqli_close($dbc);