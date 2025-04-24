<?php
    require "koneksi.php";
    include "functions.php";

    // Menangani penambahan item ke keranjang
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        addToCart($productId);
    }

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($con, "SELECT a.*, b.nama_kategori AS nama_kategori FROM produk a JOIN kategori b ON a.id_kategori = b.id_kategori WHERE a.nama_produk='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    // Periksa ketersediaan stok
    $stokHabis = $produk['stok'] === '0';

    $id_user = isset($_SESSION['id_user']) ? htmlspecialchars($_SESSION['id_user']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="icon" type="image/png" href="asset/frontend/paw.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="asset/foto_produk/<?php echo $produk['foto']; ?>" class="w-100" alt="">
                </div>
                <div class="col-md-6">
                    <h1><?php echo $produk['nama_produk']; ?></h1>
                    <p class="fs-5">
                        Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?>
                    </p>
                    <hr>
                    <table>
                        <tr>
                            <td>Kategori Produk</td>
                            <td>: <?php echo $produk['nama_kategori']; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Stok</td>
                            <td>: <?php echo $produk['stok']; ?></td>
                        </tr>
                    </table>
                    <br>
                    <p>
                        <?php echo $produk['detail']; ?>
                    </p>
                    <hr>
                </div>
            </div>
            <div class="text-center">
                <a href="produk.php?id=<?php echo $id_user; ?>" class="btn btn-outline-primary mb-2">Lihat Produk Lainnya</a>
                <form method="post" action="">
                    <input type="hidden" name="product_id" value="<?php echo $produk['id_produk']; ?>">
                    <?php if ($produk['stok'] == 'Habis') { ?>
                        <button type="button" class="btn btn-outline-secondary" disabled>Tambah ke Keranjang</button>
                    <?php } else { ?>
                        <button type="submit" class="btn btn-outline-primary">Tambah ke Keranjang</button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <?php require "footer.php"; ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>