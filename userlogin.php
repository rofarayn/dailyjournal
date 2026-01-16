<?php
session_start();

include "koneksi.php"; 

//check jika belum ada user yang login arahkan ke halaman login
if (!isset($_SESSION['username'])) { 
	header("location:login.php"); 
} 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>My Daily Journal | Admin</title>
        <link rel="icon" href="/latihan_jqueryajax/img/icon.jpg">


        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        /> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <style>  
            html {
                position: relative;
                min-height: 100%;
            }
            body {
                margin-bottom: 100px; /* Margin bottom by footer height */
            }
            footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 100px; /* Set the fixed height of the footer here */ 
            }
        </style>
    </head>

    <body>
    <!-- nav begin -->
    <nav class="navbar navbar-expand-sm bg-body-tertiary sticky-top bg-danger-subtle">
        <div class="container">
            <a class="navbar-brand" target="_blank" href=".">My Daily Journal</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                    <li class="nav-item">
                        <a class="nav-link" href="userlogin.php?page=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userlogin.php?page=article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userlogin.php?page=gallery">Gallery</a>
                    </li>                      
                    <li class="nav-item dropdown">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                                <img 
                                    src="img/<?= $_SESSION['foto'] ?? 'default.png' ?>" 
                                    width="35" 
                                    height="35"
                                    style="border-radius:50%; object-fit:cover;"
                                >
                                <span><?= $_SESSION['username'] ?></span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end text-center p-3">

                                <!-- foto profil -->
                                <li>
                                    <img 
                                        src="img/<?= $_SESSION['foto'] ?? 'default.png' ?>" 
                                        width="80" 
                                        height="80"
                                        style="border-radius:50%; object-fit:cover;"
                                    >
                                </li>

                                <!-- username -->
                                <li class="mt-2 fw-bold">
                                    <?= $_SESSION['username'] ?>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <!-- logout -->
                                <li>
                                    <a class="dropdown-item text-danger" href="logout.php">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </li> 
                </ul>
            </div>
        </div>
    </nav>
    <!-- nav end -->

   <!-- content begin -->
        <section id="content" class="p-5">
            <div class="container">
                <?php
                    $page = $_GET['page'] ?? 'dashboard';

                    $allowed_pages = ['dashboard', 'article', 'gallery',];

                    if (in_array($page, $allowed_pages)) {
                    ?>
                        <h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">
                            <?= ucfirst($page) ?>
                        </h4>
                        <?php
                        include($page . ".php");
                    } else {
                        echo "<h5 class='text-danger'>halaman tidak ditemukan</h5>";
                    }
                    ?>
            </div>
        </section>
    <!-- content end -->

    <!-- footer begin -->
    <footer class="text-center p-4 bg-danger-subtle">
        <div>
            <a href="https://www.instagram.com/rofarayn/" target="_blank"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
            <a href="https://www.facebook.com/profile.php?id=100092243085300&sk=about" target="_blank"><i class="bi bi-facebook h2 p-2 text-dark"></i></a>
            <a href="https://wa.me/+62087825484850" target="_blank"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
        </div>
        <div class="p-3">
          Rofa Rayan &copy;2025  
        </div>
    </footer>
    <!-- footer end -->
     
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
    ></script>
</body>
</html> 