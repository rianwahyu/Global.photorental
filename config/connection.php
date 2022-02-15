<?php 

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set('Asia/Jakarta');
// $dbc = mysqli_connect("localhost","root","","global_photorental");
// $dbc = mysqli_connect("localhost","root","","global_photorental");
$dbc = mysqli_connect('localhost', 'u1687666_root', '8umx9E5#RyNepdda', 'u1687666_global_photorental') ;

// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error($dbc);
}

?>