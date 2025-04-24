<?php
    require "koneksi.php";
    include "functions.php";

    // Menangani penambahan item ke keranjang
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        addToCart($productId);
    }

    // Memanggil User
    $queryUser = mysqli_query($con, "SELECT * FROM users");
    $namaUser = mysqli_fetch_array($queryUser);

    // Memanggil Isi Produk
    $queryProduk = mysqli_query($con, "SELECT id_produk, nama_produk, harga, foto, detail FROM produk LIMIT 6");
    
    $id_user = isset($_SESSION['id_user']) ? htmlspecialchars($_SESSION['id_user']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Pals</title>
    <link rel="icon" type="image/png" href="asset/frontend/paw.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/produk.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-white text-center">
            <h1>PET PALS SHOP</h1>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword" autocomplete="off">
                        <button type="submit" class="input__button__shadow input__button__shadow--variant text-white">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Highlight Layanan -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Layanan Ditawarkan</h3>

            <div class="row mt-4">
                <!-- Pet Hotel -->
                <div class="col-md-4 mb-3">
                    <a class="no-decoration text-white" href="pet-hotel.php?id=<?php echo $id_user; ?>">
                        <div class="highlighted-kategori kategori-hotel d-flex justify-content-center align-items-center">
                            <h4>PET HOTEL</h4>
                        </div>
                    </a>
                </div>
                <!-- Pet Supplies/Produk -->
                <div class="col-md-4 mb-3">
                    <a class="no-decoration text-white" href="produk.php?id=<?php echo $id_user; ?>">
                        <div class="highlighted-kategori kategori-produk d-flex justify-content-center align-items-center">
                            <h4>PET SUPPLIES</h4>
                        </div>
                    </a>
                </div>
                <!-- Pet Grooming -->
                <div class="col-md-4 mb3">
                    <a class="no-decoration text-white" href="pet-grooming.php?id=<?php echo $id_user; ?>">
                        <div class="highlighted-kategori kategori-grooming d-flex justify-content-center align-items-center">
                            <h4>PET GROOMING</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sedikit Tentang Kami -->
    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mt-3">Pet Pals adalah toko yang menyediakan berbagai perlengkapan untuk kucing, anjing, hamster, dan sugar glider, mulai dari makanan khusus hingga aksesoris seperti kandang, mainan, dan peralatan kesehatan hewan yang lengkap. Selain menyediakan berbagai produk berkualitas, Pet Pals juga menawarkan layanan grooming dan penitipan hewan yang profesional. Pet Pals berkomitmen untuk memenuhi semua kebutuhan hewan peliharaan Anda dan menjadi solusi lengkap bagi pemilik yang menginginkan yang terbaik untuk sahabat berbulu mereka.</p>
            <a class="no-decoration text-white fs-4" href="tentang-kami.php?id=<?php echo $id_user; ?>">Selengkapnya</a>
        </div>
    </div>

    <!-- Produk -->
    <div class="container-fluid">
        <div class="container py-5">
            <h3 class="text-center">Produk</h3>

            <div class="row mb-3">
                <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100 w-80">
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
                                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-cart-shopping"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="text-center">
                <a href="produk.php?id=<?php echo $id_user; ?>" class="btn btn-outline-primary">Lihat Selengkapnya</a>
            </div>
        </div>
    </div>


    <?php require "footer.php"; ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>