<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    
    <!-- Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="">
    
    <title>Riko ulos</title>
</head>

<body>
    <!-- Navbar -->
    <section class="nav-navbar fixed-top" style="background-color: skyblue;">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand text-white font-weight-bold" href="index.html">Riko Ulos.id</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link text-white" href="#home">Home <span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link text-white" href="#about">About</a>
                        <a class="nav-item nav-link text-white" href="#produk">Product</a>
                        <a class="nav-item nav-link text-white" href="#contact">Contact</a>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    
<!-- Tambahkan ini di <head> atau file CSS -->
<style>
    .carousel-img {
        max-height: 400px;
        object-fit: cover;
        border-radius: 10px;
    }

    #home {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
</style>

<!-- Section Carousel -->
<section id="home" class="awal">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 img-fluid carousel-img" src="./assets/img/slide1.png" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 img-fluid carousel-img" src="./assets/img/slide2.png" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 img-fluid carousel-img" src="./assets/img/slide3.png" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- About Us -->
    <section id="about" class="about bg-white mt-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-9 sec-2 mt-5">
                    <h2>About Us</h2>
                    <p>Selamat datang di Riko Ulos website e-commerce ulos pertama di Indonesia! Sejak 2024, kami hadir untuk memperkenalkan keindahan dan keanggunan ulos kepada dunia modern. Kami menghadirkan koleksi ulos berkualitas tinggi dengan desain inovatif yang cocok untuk berbagai momen spesial Anda.</p>
                    <p>Dengan pilihan ulos terbaik untuk pria dan wanita, Riko Ulosmemastikan setiap produk yang Anda beli asli, berkualitas, dan siap memperkaya penampilan Anda. Belanja mudah, cepat, dan aman hanya di Riko Ulos. Jadikan setiap hari lebih bermakna dengan ulos pilihan Anda!</p>
                </div>

                <div class="col-lg-3">
                    <img src="assets/icon/logoulos.png" alt="logo" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Quote Section -->
    <section class="quote bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>"Menyatu dalam Tradisi, Bersinar dalam Gaya"</h1>
                    <p>-Riko Ulos-</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Display -->
    <section id="produk" class="produk mt-5 mb-5">
        <div class="container">
            <div class="row">
                <h2>Our Product</h2>
            </div>
            <div class="row text-center">
                <?php
                    require './db/koneksi.php';
                    $sql = mysqli_query($koneksi, "SELECT * FROM produk");
                    while ($data = mysqli_fetch_assoc($sql)) {
                ?>
                <div class="col-md-6 col-lg-3 mt-3">
                    <div class="card">
                        <img class="card-img-top" src="./assets/produk/<?php echo $data['gambar']; ?>" alt="<?php echo $data['gambar']; ?>">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                            <h6 class="pb-3"><?php 
                                $harga_bersih = preg_replace('/[^0-9]/', '', $data['harga']); 
                                $harga_format = number_format((int)$harga_bersih, 0, ',', '.');
                                ?>
                                <td>Rp. <?= $harga_format; ?></td>
                            </h6>
                            <button class="btn btn-primary btn-block btn-custom" data-toggle="modal" data-target="#pesan<?php echo $data['id']; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Beli</button>
                        </div>
                    </div>
                </div>
                <?php 
                    include 'proses.php';
                    ini_set("display_errors", "Off");
                } 
                ?>
            </div>
        </div>
    </section>

<!-- Check Order Status Section -->
<section id="contact" class="contact order">
    <div class="container">
        <div class="row text-content">
            <div class="col text-center mb-3">
                <h4>Check Order Status</h4>
                <p class="text-muted">Enter your email address to check the status of your order</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5 mt-2">
                <?php if (isset($_GET['status_message'])) { ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?php echo nl2br(htmlspecialchars(urldecode($_GET['status_message']))); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <form method="POST" action="check_order_status.php">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="orderEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="orderEmail" placeholder="name@example.com" name="email" required>
                    </div>
                    <button type="submit" id="btn-check-status" class="btn btn-primary w-100">Check Status</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Contact Us -->
<section id="contact" class="contact mt-5 mb-5">
        <div class="container">
            <div class="row">
                <h2>Contact Us</h2>
            </div>
            <div class="row text-center">
                <!-- Instagram -->
                <div class="col-md-6 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <i class="fab fa-instagram fa-3x mb-3"></i>
                            <h4 class="card-title">Instagram</h4>
                            <p><a href="https://instagram.com/tenunulos.id" target="_blank">@tenunulos.id</a></p>
                        </div>
                    </div>
                </div>
                <!-- Facebook -->
                <div class="col-md-6 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <i class="fab fa-facebook fa-3x mb-3"></i>
                            <h4 class="card-title">Facebook</h4>
                            <p><a href="https://facebook.com/tenunulos.id" target="_blank">Tenun Ulos Indonesia</a></p>
                        </div>
                    </div>
                </div>
                <!-- WhatsApp -->
                <div class="col-md-6 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <i class="fab fa-whatsapp fa-3x mb-3"></i>
                            <h4 class="card-title">WhatsApp</h4>
                            <p><a href="https://wa.me/6281234567890" target="_blank">+62 812-3456-7890</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <div class="footer" style="background-color: skyblue;">
        <div class="card-footer text-black text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 pt-3 pb-3">
                        <span><a href="#" class="text-white">Riko Ulos</a> &copy; 2024. Bangga Membawa Tradisi.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/costum.js"></script>
</body>

</html>
