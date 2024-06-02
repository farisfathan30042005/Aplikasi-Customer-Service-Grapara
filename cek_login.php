<?php 
// Mengaktifkan session PHP
session_start();
 
// Menghubungkan dengan koneksi
include 'koneksi.php';
 
// Menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// Menyeleksi data pengguna dengan username yang sesuai
$data = mysqli_query($koneksi,"SELECT * FROM auth WHERE username='$username'");
 
// Menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
    $row = mysqli_fetch_assoc($data);
    // Memeriksa kecocokan password
    if($password == $row['password']) {
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        // Memeriksa peran pengguna dan mengarahkan sesuai dengan perannya
        if($username == 'admin') {
            header("location:admin.php");
        } elseif($username == 'manager') {
            header("location:manager.php");
        } else {
            header("location:index.php?pesan=gagal");
        }
    } else {
        header("location:index.php?pesan=gagal");
    }
} else {
    header("location:index.php?pesan=gagal");
}
?>
