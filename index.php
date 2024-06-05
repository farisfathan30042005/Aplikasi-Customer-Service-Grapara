<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service</title>
    <link rel="icon" type="image/x-icon" href="images/cs_logo.png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php
    include 'autentikasi/koneksi.php';
	if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
            echo '<script type="text/JavaScript">';
			echo 'alert("Login gagal!, username dan password salah.")';
            echo '</script>';
        }else if($_GET['pesan'] == "error_user_role"){
            echo '<script type="text/JavaScript">';
			echo 'alert("Login gagal!, user role yang digunakan tidak sesuai.")';
            echo '</script>';
		}else if($_GET['pesan'] == "logout"){
            echo '<script type="text/JavaScript">';
			echo 'alert("Anda telah berhasil logout.")';
            echo '</script>';
		}else if($_GET['pesan'] == "belum_login"){
            echo '<script type="text/JavaScript">';
			echo 'alert("Anda harus login untuk mengakses halaman ini.")';
            echo '</script>';
		}
	}
	?>

    <header>
        <h1>Grapara Customer Service</h1>
        <h2>Manage your customer service operations efficiently</h2>
    </header>

    <div id="loginPopupAdmin" class="login-popup">
        <div class="login-popup-content">
            <h1 class="log1n">Login Admin</h1>
            <span class="close" onclick="closeLoginPopup()">&times;</span>
            <form method="post" action="autentikasi/cek_login_admin.php">
		        <table>
			        <tr>
				        <input type="text" name="username" placeholder="Masukkan username" autofocus required>
			        </tr>
			        <tr>
				        <input type="password" name="password" placeholder="Masukkan password" required>
			        </tr>
				        <button><input style="background: linear-gradient(to right, #141e30, #243b55); color: #fff; border: 0;" type="submit" value="Login"></button>
			        </tr>
		        </table>			
	        </form>
        </div>
    </div>

    <div id="loginPopupCS" class="login-popup">
        <div class="login-popup-content">
            <h1 class="log1n">Login Customer Service</h1>
            <span class="close" onclick="closeLoginPopup()">&times;</span>
            <form method="post" action="autentikasi/cek_login_cs.php">
		        <table>
			        <tr>
				        <input type="text" name="username" placeholder="Masukkan username" autofocus required>
			        </tr>
			        <tr>
				        <input type="password" name="password" placeholder="Masukkan password" required>
			        </tr>
				        <button><input style="background: linear-gradient(to right, #141e30, #243b55); color: #fff; border: 0;" type="submit" value="Login"></button>
			        </tr>
		        </table>			
	        </form>
        </div>
    </div>

    <div id="loginPopupManager" class="login-popup">
        <div class="login-popup-content">
            <h1 class="log1n">Login Manager</h1>
            <span class="close" onclick="closeLoginPopup()">&times;</span>
            <form method="post" action="autentikasi/cek_login_manager.php">
		        <table>
			        <tr>
				        <input type="text" name="username" placeholder="Masukkan username" autofocus required>
			        </tr>
			        <tr>
				        <input type="password" name="password" placeholder="Masukkan password" required>
			        </tr>
				        <button><input style="background: linear-gradient(to right, #141e30, #243b55); color: #fff; border: 0;" type="submit" value="Login"></button>
			        </tr>
		        </table>			
	        </form>
        </div>
    </div>

    <div class="carousel-container">
        <div class="carousel-slide">
            <div class="carousel-text">
                <h2>Seamless Experience</h2>
                <p>Enjoy a seamless experience with our customer service simulator.</p>
            </div>
            <div class="carousel-text">
                <h2>Efficient Customer Support</h2>
                <p>We provide efficient customer support to handle all your queries.</p>
            </div>
            <div class="carousel-text">
                <h2>24/7 Availability</h2>
                <p>Our customer service is available 24/7 to assist you.</p>
            </div>
        </div>
    </div>

    <div class="section-container">
        <div class="section">
        <h2>Admin</h2>
        <p>Manage users and service desks</p>
        <button class="nav-button" onclick="showLoginPopupAdmin()">Go To Admin Panel</button>
        </div>
        <div class="section">
            <h2>Customer</h2>
            <p>Get your queue number</p>
            <a href="customer/customer.php" class="nav-button" id="customer">Get Queue Number</a>
        </div>
        <div class="section">
            <h2>Customer Service</h2>
            <p>Log in and manage customer</p>
            <button class="nav-button" onclick="showLoginPopupCS()">Go to CS Panel</button>
        </div>
       <div class="section">
        <h2>Manager</h2>
        <p>View service statistics and reports</p>
        <button class="nav-button" onclick="showLoginPopupManager()">Go To Manager Panel</button>
        </div>
    </div>

    <footer class="footer"><p>© 2024 Grapara Customer Service Simulator Kelompok 1. All Rights Reserved.</p></footer>

    <script src="scripts.js"></script>
</body>
</html>
