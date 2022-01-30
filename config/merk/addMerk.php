<?php

include '../connection.php';

$id = $_POST['id'];
$name = $_POST['name'];

$querys = "INSERT INTO `merk_tbl`(`id`, `name`) VALUES (NULL, '$name')";
//echo $querys;
$results = mysqli_query($dbc, $querys);
if ($results === TRUE){
    header("location:../../merk");
}else{
    echo "<script>alert('Add data failed. Click Ok)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../merk'>";
}