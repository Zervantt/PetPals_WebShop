<?php
require "session.php";
require "koneksi.php";
include "functions.php";

// Mendapatkan total harga dari fungsi getGrandTotal
$total = getGrandTotal($con);

// Mendapatkan biaya pengiriman dari fungsi hitungBiayaPengiriman
$tarif = hitungBiayaPengiriman();

// Mendapatkan biaya akhir dari fungsi biayaAkhir
$biayaAkhir = biayaAkhir($con);

// Memanggil data User
$queryUser = mysqli_query($con, "SELECT * FROM users WHERE id_user=" . $_SESSION['id_user']);
$data = mysqli_fetch_array($queryUser);

// Inisialisasi variabel error_message
$error_message = '';

// Menangani pembayaran ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal_pembayaran = date('Y-m-d H:i:s'); // Mengambil waktu saat ini
    $nama_pelanggan = mysqli_real_escape_string($con, $_POST['nama_pelanggan']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($con, $_POST['telepon']);
    $jumlah_pembayaran = $biayaAkhir; // Jumlah pembayaran sesuai biaya akhir yang dihitung

    // Validasi input
    if (!preg_match('/^[A-Za-z\s]+$/', $nama_pelanggan)) {
        $error_message = "Nama hanya boleh berisi huruf dan spasi";
    } elseif (strlen($nama_pelanggan) > 50) {
        $error_message = "Nama tidak boleh lebih dari 50 karakter";
    } elseif (trim($alamat) === '') {
        $error_message = "Alamat tidak boleh kosong";
    } elseif (strlen($alamat) > 75) {
        $error_message = "Alamat tidak boleh lebih dari 75 karakter";
    } elseif (!preg_match('/^\d+$/', $telepon)) {
        $error_message = "Telepon hanya boleh berisi angka";
    } elseif (strlen($telepon) > 13) {
        $error_message = "Telepon tidak boleh lebih dari 13 karakter";
    } elseif (!isset($_FILES['bukti']) || $_FILES['bukti']['error'] !== UPLOAD_ERR_OK) {
        $error_message = "Silakan upload bukti pembayaran";
    } else {
        // Validasi file bukti pembayaran
        $target_dir = "asset/bukti/";
        $nama_file = basename($_FILES["bukti"]["name"]);
        $target_file = $target_dir . $nama_file;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $image_size = $_FILES["bukti"]["size"];
        $uploadOk = 1;

        // Validasi ukuran file
        if ($image_size > 700000) {
            $error_message = "Ukuran file terlalu besar. Maksimum 700 KB";
            $uploadOk = 0;
        }

        // Validasi tipe file
        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
            $error_message = "Hanya file JPG, JPEG, atau PNG yang diizinkan";
            $uploadOk = 0;
        }

        // Jika validasi file lolos, lanjutkan proses
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
                // Simpan data transaksi ke database
                $stmt = $con->prepare("INSERT INTO transaksi (id_user, tgl_transaksi, nama_user, alamat, telepon, total, bukti) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issssds", $_SESSION['id_user'], $tanggal_pembayaran, $nama_pelanggan, $alamat, $telepon, $jumlah_pembayaran, $nama_file);

                if ($stmt->execute()) {
                    $id_transaksi = $stmt->insert_id; // Dapatkan id transaksi yang baru saja dimasukkan

                    // Ambil produk dari keranjang
                    $cartItems = getCartItems();

                    // Simpan data produk ke tabel transaksi_detail
                    $stmt_detail = $con->prepare("INSERT INTO transaksi_detail (id_transaksi, id_produk, jumlah) VALUES (?, ?, ?)");
                    foreach ($cartItems as $productId => $quantity) {
                        $stmt_detail->bind_param("iii", $id_transaksi, $productId, $quantity);
                        $stmt_detail->execute();
                    }

                    // Kosongkan keranjang belanja setelah transaksi berhasil
                    emptyCart();

                    // Redirect ke halaman sukses atau halaman terima kasih
                    header("Location: transaksi.php");
                    exit();
                } else {
                    $error_message = "Pembayaran gagal. Silakan coba lagi.";
                }
            } else {
                $error_message = "Terjadi kesalahan saat mengupload file. Silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="icon" type="image/png" href="asset/frontend/paw.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/pembayaran.css">
    <link rel="stylesheet" href="css/univ.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container">
        <div class="container mt-5 mb-3">
            <h3 class="text-center"><b>PEMBAYARAN</b></h3>
            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php } ?>
            <div class="container alert alert-info" role="alert">
                <table>
                    <tr>
                        <td>Total harga barang</td>
                        <td>: Rp. <?php echo number_format($total, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td>Biaya pengiriman</td>
                        <td>: Rp. <?php echo number_format($tarif, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><b>Total yang harus dibayar</b></td>
                        <td><b>: Rp. <?php echo number_format($biayaAkhir, 0, ',', '.'); ?></b></td>
                    </tr>
                </table>
            </div>

            <div class="row justify-content-center">
                <div class="form col-md-6">
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo htmlspecialchars($data['nama_user']); ?>" maxlength="50" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Input Alamat Anda" value="<?php echo htmlspecialchars($data['alamat']); ?>" maxlength="75" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Input Nomor Telepon" value="<?php echo htmlspecialchars($data['telepon']); ?>" maxlength="13" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Pembayaran</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah" required autocomplete="off" value="Rp. <?php echo number_format($biayaAkhir, 0, ',', '.'); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" onchange="updatePaymentMethod()" required>
                                <option value="">Pilih Pembayaran</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>
                        <div id="transfer-bank-info" style="display: none;">
                            <a href="asset/frontend/TransferBank.jpg" download>
                                <img src="asset/frontend/TransferBank.jpg" alt="Transfer Bank" style="width: 100%; height: auto;">
                            </a>
                            <p class="text-warning">Klik gambar di atas untuk mengunduh.</p>
                        </div>
                        <div id="qris-info" style="display: none;">
                            <a href="asset/frontend/Qris.jpg" download>
                                <img src="asset/frontend/Qris.jpg" alt="QRIS" style="width: 100%; height: auto;">
                            </a>
                            <p class="text-warning">Klik gambar di atas untuk mengunduh.</p>
                        </div>
                        <div class="mb-3">
                            <label for="bukti" class="form-label">Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="bukti" name="bukti" required>
                        </div>
                        <button type="submit" class="btn btn-primary text-center">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require "footer.php"; ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="js/pembayaran.js"></script>
    <script>
        function updatePaymentMethod() {
            var metode = document.getElementById('metode_pembayaran').value;
            document.getElementById('transfer-bank-info').style.display = metode === 'Transfer Bank' ? 'block' : 'none';
            document.getElementById('qris-info').style.display = metode === 'QRIS' ? 'block' : 'none';
        }
    </script>
</body>
</html>