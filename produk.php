<?php
    require "koneksi.php";
    include "functions.php";

    // Menangani penambahan item ke keranjang
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        addToCart($productId);
    }

    // Memanggil Produk by Nama
    if (isset($_GET['keyword'])) {
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama_produk LIKE '%" . $_GET['keyword'] . "%'");
    }

    // Memanggil Produk by Kategori
    else if (isset($_GET['kategori'])) {
        $queryGetKategoriId = mysqli_query($con, "SELECT id_kategori FROM kategori WHERE nama_kategori='" . $_GET['kategori'] . "'");
        $kategoriId = mysqli_fetch_array($queryGetKategoriId);

        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE id_kategori='" . $kategoriId['id_kategori'] . "'");
    }

    // Memanggil Produk Default
    else {
        $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    }

    // Menghitung Jumlah Produk
    $countData = mysqli_num_rows($queryProduk);

    // Memanggil Kategori
    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="icon" type="image/png" href="asset/frontend/paw.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/produk.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <a class="no-decoration" href="produk.php">
                        <li class="list-group-item">Semua Produk</li>
                    </a>
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                    <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama_kategori']; ?>">
                        <li class="list-group-item"><?php echo $kategori['nama_kategori']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-lg-9 mb-3">
                <h3 class="text-center">Produk</h3>
                <div class="row">
                    <?php if ($countData < 1) { ?>
                        <h4 class="text-center my-5">Produk yang Anda cari tidak tersedia!</h4>
                    <?php } ?>

                    <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-img">
                                <img src="asset/foto_produk/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-info">
                                <p class="text-title"><?php echo $produk['nama_produk']; ?></p>
                                <p class="text-body">Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="detail-produk.php?nama=<?php echo $produk['nama_produk']; ?>" class="btn btn-outline-primary">Lihat Detail</a>
                                <div class="card-button">
                                    <form method="post" action="">
                                        <input type="hidden" name="product_id" value="<?php echo $produk['id_produk']; ?>">
                                        <?php if ($produk['stok'] == '0') { ?>
                                            <button type="button" class="btn btn-outline-secondary" disabled><i class="fas fa-cart-shopping"></i></button>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-cart-shopping"></i></button>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php require "footer.php"; ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>