<?php
    require "session.php";
    require "koneksi.php";

    // Mendapatkan id transaksi
    $id = $_GET['id'];

    // Memanggil Data Transaksi
    $queryTransaksi = mysqli_query($con, "SELECT * FROM transaksi WHERE id_transaksi='$id'");
    $dataTransaksi = mysqli_fetch_assoc($queryTransaksi);

    // Memanggil Data Produk Transaksi
    $queryItems = mysqli_query($con, "SELECT tp.*, p.nama_produk 
                                      FROM transaksi_detail tp 
                                      JOIN produk p ON tp.id_produk = p.id_produk 
                                      WHERE tp.id_transaksi='$id'");
    
    // Handle POST request untuk mengubah status transaksi
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['id_transaksi'])) {
            $id_transaksi = $_POST['id_transaksi'];

            // Update status transaksi menjadi "Selesai"
            $stmt = $con->prepare("UPDATE transaksi SET status='Selesai' WHERE id_transaksi=?");
            $stmt->bind_param("i", $id_transaksi);

            if ($stmt->execute()) {
                // Redirect kembali ke halaman detail transaksi
                header("Location: transaksi-detail.php?id=" . $id_transaksi);
                exit();
            } else {
                // Handle error jika update gagal
                echo "Gagal mengubah status transaksi.";
            }
        } else {
            echo "Parameter id_transaksi tidak ditemukan.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="icon" type="image/png" href="asset/frontend/paw.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
    <?php require "navbar.php" ?>

    <div class="container-fluid py-5">
        <div class="container">
            <h3 class="text-center">Detail Transaksi</h3>

            <div class="form col-md-6 mt-5">
                <form action="" method="post">
                    <div class="mt-3">
                        <label for="">Tanggal Pembelian</label>
                        <input type="text" value="<?php echo $dataTransaksi['tgl_transaksi'] ?>" class="form-control" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="">Status Transaksi</label>
                        <input type="text" value="<?php echo $dataTransaksi['status'] ?>" class="form-control" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="">Nama Pembeli</label>
                        <input type="text" value="<?php echo $dataTransaksi['nama_user'] ?>" class="form-control" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="">Alamat</label>
                        <input type="text" value="<?php echo $dataTransaksi['alamat'] ?>" class="form-control" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="">Nomor Telepon</label>
                        <input type="text" value="<?php echo $dataTransaksi['telepon'] ?>" class="form-control" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="">Total Harga Pembelian</label>
                        <input type="text" value="Rp. <?php echo number_format($dataTransaksi['total'], 0, ',', '.'); ?>" class="form-control" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="">Bukti Pembayaran</label>
                        <img src="asset/bukti/<?php echo $dataTransaksi['bukti']; ?>" alt="" class="img-thumbnail form-control" style="width: 100px; height: 100px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal">
                    </div>
                    <div class="mt-3">
                        <label for="">Detail Produk</label>
                        <ul class="list-group">
                            <?php while ($item = mysqli_fetch_assoc($queryItems)) { ?>
                                <li class="list-group-item">
                                    <?php echo $item['nama_produk']; ?> - <?php echo $item['jumlah']; ?> pcs
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php if ($dataTransaksi['status'] != 'Selesai') { ?>
                        <input type="hidden" name="id_transaksi" value="<?php echo $dataTransaksi['id_transaksi']; ?>">
                        <button type="submit" class="btn btn-success mt-5">Selesaikan Pesanan</button>
                    <?php } ?>
                </form>
                <div class="mt-3">
                    <a href="transaksi.php" class="btn btn-outline-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="asset/bukti/<?php echo $dataTransaksi['bukti']; ?>" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <?php require "footer.php" ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>