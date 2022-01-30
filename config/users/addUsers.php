<?php

include '../connection.php';

$guest_id = $_POST['guest_id'];
$date = $_POST['date'];
$name = $_POST['name'];
$address = $_POST['address'];
$source_info = $_POST['source_info'];

$querys = "INSERT INTO `guest_tbl`(`guest_id`, `date`, `name`, `address`, `source_info`) VALUES ('$guest_id', '$date', '$name', '$address', '$source_info')";
//echo $querys;
$results = mysqli_query($dbc, $querys);
if ($results === TRUE){
    header("location:../../user_list");
}else{
    echo "<script>alert('Add data failed. Click Ok)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../user_list'>";
}