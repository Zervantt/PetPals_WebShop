<?php
    require "session.php";
    require "koneksi.php";

    // Mengambil data produk dari database
    $queryPesanan = mysqli_query($con, "SELECT * FROM transaksi WHERE id_user=".$_SESSION['id_user']." ORDER BY tgl_transaksi DESC");
    $jumlahTransaksi = mysqli_num_rows($queryPesanan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="icon" type="image/png" href="asset/frontend/paw.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
    <?php require "navbar.php" ?>

    <div class="container-fluid">
        <div class="container py-5">
            <h3 class="text-center"><b>RIWAYAT TRANSAKSI ANDA</b></h3>

            <!-- Table Riwayat Pesanan -->
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama</th>
                        <th>Total Harga</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahTransaksi==0){
                        ?>
                                <tr>
                                    <td colspan=6 class="text-center">Anda Belum Memiliki Riwayat Pesanan</td>
                                </tr>
                        <?php
                            }
                            else{
                                $number = 1;
                                while($data=mysqli_fetch_array($queryPesanan)){
                        ?>
                                <tr>
                                    <td><?php echo $number ?></td>
                                    <td><?php echo $data['tgl_transaksi']; ?></td>
                                    <td><?php echo $data['nama_user']; ?></td>
                                    <td>Rp. <?php echo number_format($data['total'], 0, ',', '.'); ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    <td>
                                        <a href="transaksi-detail.php?id=<?php echo $data['id_transaksi']; ?>" class="btn btn-info">
                                            <i class="fas fa-info"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                                $number++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require "footer.php" ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>