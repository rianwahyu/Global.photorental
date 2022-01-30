<?php

include '../connection.php';

$guest_id = $_POST['guest_id'];
$date = $_POST['date'];
$name = $_POST['name'];
$address = $_POST['address'];
$source_info = $_POST['source_info'];


$query = "UPDATE `guest_tbl` SET `date`='$date', `name`='$name',`address`='$address',`source_info`='$source_info' WHERE guest_id='$guest_id' ";

$result = mysqli_query($dbc, $query);

if ($result === TRUE){
    header("location:../../user_list");
}else{
    echo "<script>alert('Edit Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../user_list'>";
}

mysqli_close($dbc);