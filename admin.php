<?php
// Simulasi data ID dan password yang benar
$correctID = "admin";
$correctPassword = "password";

// Periksa apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah ID dan password yang dimasukkan sesuai
    if ($_POST["id"] === $correctID && $_POST["password"] === $correctPassword) {
        // Redirect ke halaman admin jika autentikasi berhasil
        header("Location: admin.html");
        exit;
    } else {
        // Redirect kembali ke halaman login jika autentikasi gagal
        header("Location: login.html");
        exit;
    }
}
?>
