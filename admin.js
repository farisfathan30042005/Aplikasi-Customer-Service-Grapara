// Fungsi untuk melakukan redirect ke halaman login
function redirectToLogin() {
    window.location.href = "login.html";
}

// Event listener untuk tombol "Admin Page"
document.getElementById('adminPageBtn').addEventListener('click', redirectToLogin);
