<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Grooming</title>
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
                <img src="asset/frontend/PetPals_Grooming.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="asset/frontend/Groom1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="asset/frontend/Groom2.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- Penjelasan Pet Grooming -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h1>PET GROOMING</h1>
            <p class="fs-5">Pet Pals Grooming adalah layanan grooming yang profesional. Layanan grooming di Pet Pals mencakup pemotongan bulu, pembersihan telinga, pemangkasan kuku, hingga perawatan khusus lainnya yang disesuaikan dengan jenis dan kebutuhan kucing dan anjing. Petugas grooming di Pet Pals adalah tenaga ahli yang terlatih dan berpengalaman, sehingga pemilik hewan dapat merasa tenang dan percaya bahwa hewan mereka akan mendapatkan perawatan terbaik. Layanan grooming ini tidak hanya bertujuan untuk menjaga penampilan hewan peliharaan tetap rapi dan bersih, tetapi juga untuk menjaga kesehatan kulit dan bulu mereka.</p>
        </div>
    </div>

    <!-- Button -->
    <div class="container-fluid text-center py-5 mb-5">
        <a href="https://wa.me/628118867399?text=Halo%2C%20saya%20ingin%20memesan%20janji%20temu%20di%20Pet%20Pals%20Grooming">
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