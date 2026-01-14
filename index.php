<?php
include "koneksi.php"; 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BTR!</title>
    <link rel="icon" href="img/iocn.jpg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <style>
        html {
            scroll-behavior: smooth;
        }

        #hero,
        #gallery{
           background-color: hsl(323, 100%, 75%); 
        }

        .dark-mode #hero,
        .dark-mode #gallery {
          background-color: rgb(116, 36, 100); 
        }

        .table td {
            text-align: left;
            vertical-align: middle;
            padding: 10px 20px;
        }

        #schedule {
            position: relative;
            background-image: url(img/atago&takao.png);
            background-size: cover;
            background-position: center;
            
        }

        #schedule::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: hsla(323, 100%, 75%, 0.733);
        }

        #schedule > * {
        position: relative;
        z-index: 1;
        }
      
    </style>
    </head>
  <body onload="tampilWaktu()" class="bg-light text-dark"></body>
    <!-- nav begin -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container">
        <a class="navbar-brand" href="#">Rofa-Kun</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav  ms-auto mb-2 mb-lg-0 text-dark">
        <li class="nav-item">
          <a class="nav-link" href="#hero">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#article">Article</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#gallery">Gallery</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#profile">Profile</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#schedule">Schedule</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="login.php" target="_blank">Login</a>
        </li>
       
      </ul>
      <button id="dark" class="btn btn-dark"><i class="bi bi-moon-fill"></i></button>
      <button id="light" class="btn btn-dark"><i class="bi bi-brightness-high"></i></button>

    </div>
  </div>
</nav>
    <!-- nav end -->

    <!-- hero begin -->
    <section id="hero" class="text-center p-5 text-sm-start">
        <div class="container">
            <div class="d-flex flex-column-reverse flex-sm-row align-items-center justify-content-between">
                <div class="text-center text-sm-start">
                    <h1 class="fw-bold display-4">
                        Bocchi The Rock!
                    </h1>
                    <h4 class>
                        ぼっち・ざ・ろっく！
                    </h4>
                    <p>
                       Yearning to make friends and perform live with a band, lonely and socially anxious Hitori "Bocchi" Gotou devotes her time to playing the guitar. On a fateful day, Bocchi meets the outgoing drummer Nijika Ijichi, who invites her to join Kessoku Band when their guitarist, Ikuyo Kita, flees before their first show. Soon after, Bocchi meets her final bandmate—the cool bassist Ryou Yamada.</p> 
                       Although their first performance together is subpar, the girls feel empowered by their shared love for music, and they are soon rejoined by Kita. Finding happiness in performing, Bocchi and her bandmates put their hearts into improving as musicians while making the most of their fleeting high school days.
                    </p>
                    <h5 ><span id="tanggal"></span></h5>
                    <h5 ><span id="jam"></span></h5>
                </div>
                <img src="img/bocchi poster.jpg" class="img-fluid ms-sm-5" width="300">  
            </div>
        </div>
    </section>
    <!-- hero end -->

    <!-- article begin -->
            <section id="article" class="text-center p-5">
            <div class="container">
                <h1 class="fw-bold display-4 pb-3">article</h1>
                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <?php
                $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                $hasil = $conn->query($sql); 

                while($row = $hasil->fetch_assoc()){
                ?>
                    <div class="col">
                    <div class="card h-100">
                        <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
                        <div class="card-body">
                        <h5 class="card-title"><?= $row["judul"]?></h5>
                        <p class="card-text">
                            <?= $row["isi"]?>
                        </p>
                        </div>
                        <div class="card-footer">
                        <small class="text-body-secondary">
                            <?= $row["tanggal"]?>
                        </small>
                        </div>
                    </div>
                    </div>
                    <?php
                }
                ?> 
                </div>
            </div>
            </section>
    <!-- article end -->

    <!-- gallery begin -->
    <section id="gallery" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">GALLERY</h1>
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">
                <div class="carousel-inner">
                    <?php
                    // Query untuk mengambil data dari tabel gallery
                    $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
                    $hasil = $conn->query($sql);

                    // Cek jika query berhasil dan ada data
                    if ($hasil && $hasil->num_rows > 0) {
                        $isFirst = true;  // Flag untuk menandai item pertama sebagai active
                        while ($row = $hasil->fetch_assoc()) {
                            // Cek jika gambar ada
                            if (!empty($row["gambar"]) && file_exists('img/' . $row["gambar"])) {
                    ?>
                                <div class="carousel-item <?= $isFirst ? 'active' : '' ?>">
                                    <img src="img/<?= $row["gambar"] ?>" class="d-block w-100" alt="Gambar Gallery">
                                    <!-- Teks uploader dan tanggal di bawah gambar -->
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            Diunggah oleh: <?= htmlspecialchars($row["uploader"]) ?> | Tanggal: <?= htmlspecialchars($row["tanggal"]) ?>
                                        </small>
                                    </div>
                                </div>
                    <?php
                                $isFirst = false;  // Setelah item pertama, tidak active lagi
                            }
                        }
                    } else {
                        // Jika tidak ada data, tampilkan pesan di carousel
                    ?>
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center align-items-center" style="height: 400px;">
                                <p class="text-muted">Tidak ada gambar di gallery.</p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    <!-- gallery end -->

    <!-- profile begin -->
    <section id="profile" class="text-center p-5" >
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">PROFILE</h1>
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-4">
                <img src="img/Rofa.png" class="rounded-circle" alt="Foto profil" width="250" height="250">
                <div>
                    <h3 class="mb-3 text-center" >Rofa Rayan</h3>
                    <table class="table table-bordered w-auto mx-auto ">
                        <tr>
                            <td><strong>NIM</strong></td>
                            <td>A11.204.15754</td>
                        </tr>
                        <tr>
                            <td><strong>Tempat Tanggal Lahir</strong></td>
                            <td>Jakarta, 4 April 2006</td>
                        </tr>
                        <tr>
                            <td><strong>Program Studi</strong></td>
                            <td>Teknik Informatika</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>rofarayn@gmail.com</td>
                        </tr>
                        <tr>
                            <td><strong>No. Telepon</strong></td>
                            <td>087825484850</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>Jl. Ketileng Timur V No.34</td>
                        </tr>
                    
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- profile end -->

    <!-- schedule begin -->
    <section id="schedule" class="text-center p-5 ">
        <div class="container ">
            <h1 class="fw-bold display-4 pb-3">JADWAL KULIAH & KEGIATAN</h1>
            <div class="row row-cols-1 row-cols-md-4 g-4  "> 
                <div class="col">
                    <div class="card border-warning card mb-3" >
                        <div class="card-header text-bg-warning"><b>SENIN</b></div>
                        <div class="card-body">
                            <h6 class="card-title">09.30-10.20</h6>
                            <p>Pendidikan Kewarganegaraan <br>Kulino</p>
                            <h6 class="card-title">12.30-15.00 </h6>
                            <p>Probabilitas & Statistik<br>H.5.4</p>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-info card mb-3" >
                        <div class="card-header text-bg-info"><b>SELASA</b></div>
                        <div class="card-body">
                            <h6 class="card-title">09.30-12.00</h6>
                            <p>Logika Informatika<br>H.5.9</p>
                            <h6 class="card-title">12.30-15.00 </h6>
                            <p>Sistem Operasi<br>H.5.7</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-secondary card mb-3" >
                        <div class="card-header text-bg-secondary"><B>RABU</B></div>
                        <div class="card-body">
                            <h6 class="card-title">09.30-12.00</h6>
                            <p>Rekayasa Perangkat Lunak<br>H.3.9</p>
                            <h6 class="card-title">12.30-14.10</h6>
                            <p>Technoprenuership<br>H.3.9</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-danger card mb-3" >
                        <div class="card-header text-bg-danger"><b>KAMIS</b></div>
                        <div class="card-body">
                            <h6 class="card-title">07.00-08.40</h6>
                            <p>Basis Data<br>D.2.J</p>
                            <h6 class="card-title">08.40-10.20</h6>
                            <p>Pemograman Berbasis Web<br>D.2.K</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-dark card mb-3" >
                        <div class="card-header text-bg-dark"><b>JUMAT</b></div>
                        <div class="card-body">
                            <h6 class="card-title">07.00-08.40</h6>
                            <p>Basis Data<br>H.5.4</p>
                            <h6 class="card-title">10.00-17.00</h6>
                            <p>Part Time Kerja<br>Kafe</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-success card mb-3" >
                        <div class="card-header text-bg-success"><b>SABTU</b></div>
                        <div class="card-body">
                            <h6 class="card-title">09.00-10.30</h6>
                            <p>Work Out <br>GYM</p>
                            <h6 class="card-title">14.00-22.00</h6>
                            <p>Part Time Kerja<br>Kafe</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-primary card mb-3" >
                        <div class="card-header text-bg-primary"><b>MINGGU</b></div>
                        <div class="card-body">
                            <h6 class="card-title">06.00-11.00</h6>
                            <p>Main<br>Warnet</p>
                            <h6 class="card-title">14.00-22.00</h6>
                            <p>Part Time Kerja<br>Kafe</p>
                        </div>
                    </div>
                </div>
                
                    
                
            </div>
        </div>
    </section>
    <!-- schedule end -->

    <!-- footer begin  -->
    <footer class="text-center p-4">
        <div>
            <a href="https://www.instagram.com/rofarayn/" target="_blank"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
            <a href="https://www.facebook.com/profile.php?id=100092243085300&sk=about" target="_blank"><i class="bi bi-facebook h2 p-2 text-dark"></i></a>
            <a href="https://wa.me/+62087825484850" target="_blank"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
        </div>
        <div class="p-3">
          Rofa Rayan &copy;2025  
        </div>
    </footer>
    <!-- footer end  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <!DOCTYPE html>
    <script src="java.js"></script>
  </body>
</html>