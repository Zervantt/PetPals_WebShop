<?php
    require "session.php";
    require "koneksi.php";
    include "functions.php";

    // Mengambil data produk dari database
    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    $products = [];
    while ($row = mysqli_fetch_assoc($queryProduk)) {
        $products[$row['id_produk']] = $row;
    }

    // Menangani pembaruan item di keranjang
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['product_id'])) {
            $productId = intval($_POST['product_id']);
            if (!isset($products[$productId])) {
                // Produk tidak ditemukan, tambahkan penanganan error
                die("Produk tidak ditemukan");
            }

            if (isset($_POST['action']) && $_POST['action'] == 'remove') {
                removeFromCart($productId);
            } elseif (isset($_POST['action']) && $_POST['action'] == 'update') {
                $quantity = intval($_POST['quantity']);
                if ($quantity <= 20 && $quantity > 0) {
                    updateCart($productId, $quantity);
                } else {
                    // Jumlah tidak valid, tambahkan penanganan error
                    removeFromCart($productId);
                }
            }
        }
    }

    $cartItems = getCartItems();

    $id_user = isset($_SESSION['id_user']) ? htmlspecialchars($_SESSION['id_user']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="icon" type="image/png" href="asset/frontend/paw.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/keranjang.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container">
        <div class="container-fluid py-5">
            <h3 class="text-center"><b>KERANJANG PESANAN</b></h3>

            <!-- Table Keranjang -->
            <div class="table-responsive mt-5">
                <table class="table">
                    <!-- Head -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <!-- Body -->
                    <tbody>
                        <!-- Menunjukan keranjang ketika kosong -->
                        <?php if (empty($cartItems)) { ?>
                            <tr>
                                <td colspan="7" class="text-center">Keranjang belanja kosong.</td>
                            </tr>
                        <?php } else { 
                            $number = 1;
                            $grandTotal = 0;
                            // Menghitung Harga
                            foreach ($cartItems as $productId => $quantity) {
                                $product = $products[$productId];
                                $totalPrice = $product['harga'] * $quantity;
                                $grandTotal += $totalPrice;
                        ?>
                            <tr>
                                <td><?php echo $number++; ?></td>
                                <td><img src="asset/foto_produk/<?php echo htmlspecialchars($product['foto']); ?>" alt="<?php echo htmlspecialchars($product['nama_produk']); ?>" style="width: 100px; height: auto;"></td> <!-- Menampilkan Foto Produk -->
                                <td><?php echo htmlspecialchars($product['nama_produk']); ?></td> <!-- Menampilkan Nama Produk -->
                                <td>Rp. <?php echo number_format($product['harga'], 0, ',', '.'); ?></td> <!-- Menampilkan Harga Produk -->
                                <td>
                                    <form method="post" action="" id="update-form-<?php echo $productId; ?>" style="display: inline-block;">
                                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                        <input type="hidden" name="action" value="update">
                                        <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="20" style="width: 50px;" onchange="updateQuantity(<?php echo $productId; ?>)">
                                    </form>
                                </td> <!-- Menampilkan Quantity/Banyak Produk -->
                                <td>Rp. <?php echo number_format($totalPrice, 0, ',', '.'); ?></td> <!-- Menampilkan Total Harga Produk -->
                                <td>
                                    <form method="post" action="" style="display: inline-block;">
                                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                        <input type="hidden" name="action" value="remove">
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td> <!-- Button menghapus produk dari keranjang -->
                            </tr>
                        <?php } ?>
                            <!-- Total Harga Akhir -->
                            <tr>
                                <td colspan="5" class="text-right"><b>Total</b></td>
                                <td colspan="2"><b>Rp. <?php echo number_format($grandTotal, 0, ',', '.'); ?></b></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Tampilkan tombol pembayaran jika keranjang tidak kosong -->
            <?php if (!empty($cartItems)) { ?>
            <div class="container text-center">
                <a href="pembayaran.php?id=<?php echo $id_user; ?>">
                    <button type="button" class="btn btn-outline-success">Lanjutkan Pembayaran</button>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php require "footer.php"; ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="js/keranjang.js"></script>
</body>
</html>