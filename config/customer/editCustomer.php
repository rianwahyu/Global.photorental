<?php

include '../connection.php';

$customer_id = $_POST['customer_id'];
$fullname = $_POST['fullname'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$mobile_2 = $_POST['mobile_2'];
$email = $_POST['email'];
$job = $_POST['job'];
$office_address = $_POST['office_address'];
$member_id = $_POST['member_id'];
$registered_date = $_POST['registered_date'];
$instagram_id = $_POST['instagram_id'];
$emergency_contact_mobile = $_POST['emergency_contact_mobile'];
$emergency_contact_name = $_POST['emergency_contact_name'];
$emergency_contact_relation = $_POST['emergency_contact_relation'];
$identity_id = $_POST['identity_id'];
$identity_type = $_POST['identity_type'];
// $member_id = $_POST['member_id'];

$query = "UPDATE `customer_tbl` SET `fullname`='$fullname',`address`='$address',`mobile`='$mobile',`mobile_2`='$mobile_2',`email`='$email',`job`='$job',`office_address`='$office_address',`member_id`='$member_id',`registered_date`='$registered_date',`instagram_id`='$instagram_id',`emergency_contact_mobile`='$emergency_contact_mobile',`emergency_contact_name`='$emergency_contact_name',`emergency_contact_relation`='$emergency_contact_relation',`identity_id`='$identity_id',`identity_type`='$identity_type' WHERE customer_id='$customer_id' ";

$result = mysqli_query($dbc, $query);

if ($result === TRUE){
    header("location:../../customer?search=$customer_id");
}else{
    echo "<script>alert('Tambah Data Gagal, Klik OK)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../customer'>";
}

mysqli_close($dbc);