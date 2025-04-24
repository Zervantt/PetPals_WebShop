<?php
    require "session.php";
    require "koneksi.php";

    // Memanggil data User
    $queryUser = mysqli_query($con, "SELECT * FROM users WHERE id_user=".$_SESSION['id_user']);
    $data = mysqli_fetch_array($queryUser);

    // Jika tombol "Ubah Profile" ditekan
    if(isset($_POST['simpan'])) {
        // Ambil nilai yang dimasukkan pengguna
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];

        // Update data user di database
        $query = "UPDATE users SET nama_user = '$nama', alamat = '$alamat', telepon = '$telepon' WHERE id_user = ".$_SESSION['id_user'];
        $result = mysqli_query($con, $query);

        if($result) {
            // Update data di session
            $_SESSION['nama_user'] = $nama;
            $_SESSION['alamat'] = $alamat;
            $_SESSION['telepon'] = $telepon;

            // Redirect ke halaman profile setelah berhasil diubah
            header("Location: profil.php?id=".$_SESSION['id_user']);
            exit();
        } else {
            // Tampilkan pesan kesalahan jika gagal melakukan update
            $error_message = "Gagal mengubah profile. Silakan coba lagi.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Saya</title>
    <link rel="icon" type="image/png" href="asset/frontend/paw.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/univ.css">
</head>
<body>
    <?php require "navbar.php" ?>
    
    <div class="container-fluid py-5">
        <div class="container">
            <h3 class="text-center">Profile Anda</h3>

            <div class="my-5 col-12 col-md-6">
                <form action="" method="post">
                    <div>
                        <label for="nama">Nama Anda</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $data['nama_user']; ?>" class="form-control" autocomplete="off" required>
                        <span class="error" id="namaError"></span>
                    </div>
                    <div>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo $data['username']; ?>" class="form-control mb-2" autocomplete="off" required disabled>
                    </div>
                    <div>
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" placeholder="Input Alamat Anda" value="<?php echo $data['alamat']; ?>" class="form-control" autocomplete="off" required>
                        <span class="error" id="namaError"></span>
                    </div>
                    <div>
                        <label for="telepon">Telepon</label>
                        <input type="number" id="telepon" name="telepon" placeholder="Input Nomor Telepon" value="<?php echo $data['telepon']; ?>" class="form-control" autocomplete="off" required>
                        <span class="error" id="namaError"></span>
                    </div>
                    <div class="row mt-3">
                        <button class="btn btn-primary mb-3" type="submit" name="simpan">Ubah Profile</button>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require "footer.php" ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>