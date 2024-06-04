<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'koneksi.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($conn,"select * from users where username='$username' and password='$password'");

// menyeleksi data admin dengan user role yang sesuai
$dataRole = mysqli_query($conn,"select * from users where username='$username' and password='$password' and role='Manager'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
$cekRole = mysqli_num_rows($dataRole);
 
if($cek > 0 and	$cekRole > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:../manager/manager.php");
}
else if($cek > 0 and $cekRole == 0){
	header("location:../index.php?pesan=error_user_role");
}
else{
	header("location:../index.php?pesan=gagal");
}
?>