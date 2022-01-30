<?php

include '../connection.php';

$guest_id = $_POST['guest_id'];

$query = "DELETE FROM `guest_tbl` WHERE `guest_id`='$guest_id'";

$result = mysqli_query($dbc,$query);

if ($result === TRUE){
    header("location:../../user_list");
}else{
    echo "<script>alert('Hapus Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../user_list'>";
}

mysqli_close($dbc);