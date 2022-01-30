<?php

include '../connection.php';

$id = $_POST['id'];
$category_name = $_POST['category_name'];

$querys = "INSERT INTO `category_tbl`(`id`, `category_name`) VALUES (NULL, '$category_name')";
//echo $querys;
$results = mysqli_query($dbc, $querys);
if ($results === TRUE){
    header("location:../../category_item");
}else{
    echo "<script>alert('Add data failed. Click Ok)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../category_item'>";
}