<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Fungsi untuk menambah item ke keranjang
    function addToCart($productId) {
        $productId = intval($productId); // Validasi input
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]++;
        } else {
            $_SESSION['cart'][$productId] = 1;
        }
    }

    // Fungsi untuk menghapus item dari keranjang
    function removeFromCart($productId) {
        $productId = intval($productId); // Validasi input
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

    // Fungsi untuk memperbarui jumlah item di keranjang
    function updateCart($productId, $quantity) {
        $productId = intval($productId); // Validasi input
        $quantity = intval($quantity); // Validasi input
        if ($quantity < 1) {
            removeFromCart($productId);
        } else {
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] = $quantity;
            }
        }
    }

    // Fungsi untuk mendapatkan total item di keranjang
    function getCartTotal() {
        if (!isset($_SESSION['cart'])) {
            return 0;
        }
        $total = 0;
        foreach ($_SESSION['cart'] as $quantity) {
            $total += $quantity;
        }
        return $total;
    }

    // Fungsi untuk mendapatkan item di keranjang
    function getCartItems() {
        if (!isset($_SESSION['cart'])) {
            return [];
        }
        return $_SESSION['cart'];
    }

    // Fungsi untuk mendapatkan total harga dari semua item di keranjang
    function getGrandTotal($con) {
        if (!isset($_SESSION['cart'])) {
            return 0;
        }

        // Ambil data produk dari database dengan prepared statements
        $stmt = $con->prepare("SELECT id_produk, harga FROM produk");
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            echo "Error: " . $con->error;
            return 0;
        }

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[$row['id_produk']] = $row;
        }

        $grandTotal = 0;
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            if (isset($products[$productId])) {
                $product = $products[$productId];
                $totalPrice = $product['harga'] * $quantity;
                $grandTotal += $totalPrice;
            }
        }

        return $grandTotal;
    }

    // Fungsi untuk menghitung biaya pengiriman
    function hitungBiayaPengiriman() {
        // Logika perhitungan biaya pengiriman berdasarkan alamat
        $tarifTetap = 20000;
        return $tarifTetap;
    }

    // Fungsi untuk menghitung seluruh biaya, Biaya akhir
    function biayaAkhir($con){
        $grandTotal = getGrandTotal($con);
        $tarifTetap = hitungBiayaPengiriman();
        $biayaAkhir = $grandTotal + $tarifTetap;
        return $biayaAkhir;
    }

    // Fungsi untuk mengosongkan keranjang belanja
    function emptyCart() {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
    }
?>