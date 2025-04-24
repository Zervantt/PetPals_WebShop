<?php
    ob_start();
    session_start();
    require "koneksi.php";

    // Menampilkan users
    $queryUser = mysqli_query($con, "SELECT * FROM users");
    $jumlahUser = mysqli_num_rows($queryUser);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman SignIn</title>
    <link rel="icon" type="image/png" href="asset/frontend/paw.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post" id="registerForm">
                <h2 class="mb-5">Create Account</h2>
                <span>Buat Akun Anda</span>
                <input type="text" name="nama" id="nama" placeholder="Nama Anda" autocomplete="off" required>
                <span class="error" id="namaError"></span>
                <input type="text" name="username" id="registerUsername" placeholder="Username (8-25 Karakter)" autocomplete="off" required>
                <span class="error" id="registerUsernameError"></span>
                <input type="password" name="password" id="registerPassword" placeholder="Password (8-25 Karakter)" required>
                <span class="error" id="registerPasswordError"></span>
                <button type="submit" name="registerBtn">Daftar</button>

                <!-- Tampilkan pesan error dari server jika ada -->
                <?php
                echo isset($namaError) ? "<span class='error'>$namaError</span>" : "";
                echo isset($usernameError) ? "<span class='error'>$usernameError</span>" : "";
                echo isset($passwordError) ? "<span class='error'>$passwordError</span>" : "";
                ?>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post" id="loginForm">
                <h1 class="mb-5">Sign In</h1>
                <span>Masukkan Username & Password Anda</span>
                <input type="text" name="username" id="loginUsername" placeholder="Username" autocomplete="off" required>
                <input type="password" name="password" id="loginPassword" placeholder="Password" required>
                <span class="error" id="loginError1"></span>
                <span class="error" id="loginError2"></span>
                <button type="submit" name="loginBtn">Masuk</button>

                <!-- Tampilkan pesan error dari server jika ada -->
                <?php
                echo isset($loginError1) ? "<span class='error'>$loginError1</span>" : "";
                echo isset($loginError2) ? "<span class='error'>$loginError2</span>" : "";
                ?>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h2>Selamat Datang!</h2>
                    <p>Login ke dalam akun Anda</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h2>Selamat Datang Kembali!</h2>
                    <p>Belum mempunyai akun, buat disini!</p>
                    <button class="hidden" id="register">Sign Up</button>
                    <a href="admin/login.php"><button class="hidden">Admin</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-container">
        <?php
            // Proses Login
            if (isset($_POST['loginBtn'])) {
                $username = mysqli_real_escape_string($con, htmlspecialchars($_POST['username']));
                $password = mysqli_real_escape_string($con, htmlspecialchars($_POST['password']));

                // Cek apakah username ada di database
                $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
                $countdata = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);

                if ($countdata > 0) {
                    // Verifikasi password
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        $_SESSION['id_user'] = $data['id_user'];

                        header('location: index.php?id=' . (isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0));
                        exit();
                    } else {
                        $loginError1 = 'USERNAME ATAU PASSWORD SALAH!';
                    }
                } else {
                    $loginError2 = 'AKUN TIDAK DITEMUKAN!';
                }

                // Menampilkan error login dengan JavaScript
                if (isset($loginError1)) {
                    echo "<script>document.getElementById('loginError1').textContent = '$loginError1';</script>";
                }
                if (isset($loginError2)) {
                    echo "<script>document.getElementById('loginError2').textContent = '$loginError2';</script>";
                }
            }

            // Proses Register
            if (isset($_POST['registerBtn'])) {
                $namaUser = mysqli_real_escape_string($con, htmlspecialchars($_POST['nama']));
                $username = mysqli_real_escape_string($con, htmlspecialchars($_POST['username']));
                $password = mysqli_real_escape_string($con, htmlspecialchars($_POST['password']));

                // Validasi Nama
                if (!preg_match('/^[a-zA-Z ]+$/', $namaUser) || strlen($namaUser) > 50) {
                    $namaError = 'Nama harus berupa huruf dan tidak lebih dari 50 karakter!';
                }
                // Validasi Username
                elseif (!preg_match('/^[a-zA-Z0-9_]{8,50}$/', $username)) {
                    $usernameError = 'Username harus 8-50 karakter dan hanya mengandung huruf, angka, atau underscore!';
                }
                // Validasi Password
                elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,25}$/', $password)) {
                    $passwordError = 'Password harus 8-25 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol!';
                } else {
                    // Cek apakah username sudah digunakan
                    $queryExist = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
                    $jumlahUser = mysqli_num_rows($queryExist);

                    if ($jumlahUser > 0) {
                        echo '<div class="alert alert-warning mt-3" role="alert">Username Sudah Digunakan!</div>';
                    } else {
                        // Hash password dan simpan ke database
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $querySimpan = mysqli_query($con, "INSERT INTO users(nama_user, username, password) VALUES ('$namaUser', '$username', '$hashedPassword')");

                        if ($querySimpan) {
                            echo '<div class="alert alert-primary" role="alert">Akun Berhasil Dibuat! Redirecting to login...</div>';
                            header("refresh:3;url=login.php");
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                }
            }
        ?>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>