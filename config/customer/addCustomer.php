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

$querys = "INSERT INTO `customer_tbl`(`customer_id`, `fullname`, `address`, `mobile`, `mobile_2`, `email`, `job`, `office_address`, `member_id`, `registered_date`, `instagram_id`, `emergency_contact_mobile`, `emergency_contact_name`, `emergency_contact_relation`, `identity_id`, `identity_type`) VALUES ('$customer_id', '$fullname', '$address', '$mobile', '$mobile_2', '$email', '$job', '$office_address', '$member_id', '$registered_date', '$instagram_id', '$emergency_contact_mobile', '$emergency_contact_name', '$emergency_contact_relation', '$identity_id', '$identity_type')";
// echo $querys;
$results = mysqli_query($dbc, $querys);
if ($results === TRUE){
    header("location:../../customer");
}else{
    echo "<script>alert('Add data failed. Click Ok)</script>";
    echo "<meta http-equiv='refresh' content='2 url=../../customer'>";
}