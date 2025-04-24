<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Hotel</title>
    <link rel="icon" type="image/png" href="asset/frontend/paw.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/kategori_PetPals.css">
</head>

<body>
    <?php require "navbar.php"; ?>

    <!-- Carousel -->
    <div id="carouselExample" class="container-fluid carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="asset/frontend/Hotel_1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="asset/frontend/Hotel_2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="asset/frontend/Hotel_3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="asset/frontend/Hotel_4.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- Penjelasan Pet Hotel -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h1>PET HOTEL</h1>
            <p class="fs-5">Pet Pals Hotel adalah layanan penitipan hewan yang aman dan nyaman. Layanan ini sangat berguna bagi pemilik kucing, anjing, hamster, dan sugar glider yang harus bepergian atau memiliki keperluan mendesak dan tidak dapat membawa hewan peliharaan mereka. Tempat penitipan di Pet Pals dirancang sedemikian rupa agar hewan peliharaan dapat merasa nyaman dan tidak stres selama ditinggal. Dengan staf yang ramah dan berpengalaman, serta fasilitas yang lengkap, Pet Pals memastikan bahwa setiap hewan peliharaan mendapatkan perhatian dan perawatan yang memadai selama berada di tempat penitipan. Pet Pals benar-benar menjadi solusi lengkap bagi pemilik hewan peliharaan yang menginginkan yang terbaik untuk sahabat berbulu mereka.</p>
        </div>
    </div>

    <div class="container mt-3">
        <h2 class="text-center mb-5">Berbagai Pilihan Ruangan yang Tersedia</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="shadow">
                    <div class="row">
                        <img src="asset/frontend/VVIP_Rooms.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <h4><b>Ruangan VVIP</b></h4>
                <p class="fs-5">
                    Mulai dari Rp. 90.000/Hari
                </p>
                <ul>
                    <li>Ruangan Bersih dan Nyaman</li>
                    <li>Ruangan ber AC + Air Purifier</li>
                    <li>Tersedia Litter Box dan Tempat Makan & Minum</li>
                    <li>Terdapat Hidding Cave</li>
                    <li>Terdapat Cat Scratcher</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="shadow">
                    <div class="row">
                        <img src="asset/frontend/VIP_Rooms.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <h4><b>Ruangan VIP</b></h4>
                <p class="fs-5">
                    Mulai dari Rp. 75.000/Hari
                </p>
                <ul>
                    <li>Ruangan Bersih dan Nyaman</li>
                    <li>Ruangan ber AC + Air Purifier</li>
                    <li>Tersedia Litter Box dan Tempat Makan & Minum</li>
                    <li>Terdapat Hidding Cave</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="shadow">
                    <div class="row">
                        <img src="asset/frontend/Standard_Rooms.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <h4><b>Ruangan Standard</b></h4>
                <p class="fs-5">
                    Mulai dari Rp. 60.000/Hari
                </p>
                <ul>
                    <li>Ruangan Bersih dan Nyaman</li>
                    <li>Ruangan ber AC + Air Purifier</li>
                    <li>Tersedia Litter Box dan Tempat Makan & Minum</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Button -->
    <div class="container-fluid text-center py-5 mb-5">
        <a href="https://wa.me/628118867399?text=Halo%2C%20saya%20ingin%20memesan%20ruangan%20hotel%20di%20Pet%20Pals%20Hotel">
            <button class="c-button">
                <span class="c-main">
                    <span class="c-ico"><span class="c-blur"></span> <span class="ico-text"><i class="fab fa-whatsapp fs-4"></i></span></span>
                    Booking Sekarang
                </span>
            </button>
        </a>
    </div>

    <?php require "footer.php"; ?>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>