<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require_once 'functions.php'; // Pastikan functions.php di-include di sini untuk keranjang

    $id_user = isset($_SESSION['id_user']) ? htmlspecialchars($_SESSION['id_user']) : 0;
    $cartTotal = getCartTotal(); // Ambil total item di keranjang
?>

<!--Navigation Bar-->
<nav class="navbar navbar-expand-lg navbar-dark navbar-color">
    <div class="container">
        <!-- Logo dan tombol toggle -->
        <a class="navbar-brand me-auto" href="index.php?id=<?php echo $id_user; ?>">
            <img src="asset/frontend/PetPals_noBg.png" alt="Logo">
        </a>
        <!-- Tombol hamburger/toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu navbar -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="index.php?id=<?php echo $id_user; ?>">Beranda</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="produk.php?id=<?php echo $id_user; ?>">Produk</a>
                </li>
                <li class="nav-item me-3 position-relative">
                    <a class="nav-link text-white" href="keranjang.php?id=<?php echo $id_user; ?>">Keranjang</a>
                    <?php if ($cartTotal > 0): ?>
                        <span class="badge bg-warning text-white position-absolute" style="top: -10px; right: -10px; font-weight: bold;"><?php echo $cartTotal; ?></span>
                    <?php endif; ?>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="transaksi.php?id=<?php echo $id_user; ?>">Transaksi</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="tentang-kami.php?id=<?php echo $id_user; ?>">Tentang Kami</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="profil.php?id=<?php echo $id_user; ?>">Profil</a>
                </li>
            </ul>
        </div>
    </div>
</nav>