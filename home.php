<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "partial/config.php";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * from signup where email = '$email'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>

<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>CS Cloud</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

    <!-- theme meta -->
    <meta name="theme-name" content="small-apps" />

    <!-- Favicon -->
    <link rel="icon" href="favicon.ico">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" /> -->

    <!-- PLUGINS CSS STYLE -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <link rel="stylesheet" href="plugins/slick/slick-theme.css">
    <link rel="stylesheet" href="plugins/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="plugins/aos/aos.css">

    <!-- CUSTOM CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="partial/style.css">

</head>

<body class="body-wrapper" data-spy="scroll" data-target=".privacy-nav">


    <nav class="navbar main-nav navbar-expand-lg px-2 px-sm-0 py-2 py-lg-0">
        <div class="container">
            <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item @@about">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item @@about">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item @@about">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item @@contact">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--====================================
=            Hero Section            =
=====================================-->
    <section class="section gradient-banner">
        <div class="shapes-container">
            <div class="shape" data-aos="fade-down-left" data-aos-duration="1500" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
            <div class="shape" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300"></div>
            <div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="100"></div>
            <div class="shape" data-aos="zoom-out" data-aos-duration="2000" data-aos-delay="500"></div>
            <div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-up" data-aos-duration="500" data-aos-delay="0"></div>
            <div class="shape" data-aos="fade-down" data-aos-duration="500" data-aos-delay="0"></div>
            <div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="0"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1 text-center text-md-left">
                    <h1 class="text-white font-weight-bold mb-4">Welcome,
                        <?php
                        include "partial/config.php";
                        $email = $_SESSION['email'];
                        $sql = "SELECT * from signup where email = '$email'";
                        $result = mysqli_query($conn, $sql);

                        $row = mysqli_fetch_assoc($result);
                        echo $row['name'] . "!" ?>&nbsp;<br> Cloud Storage For You
                    </h1>
                    <p class="text-white mb-5">Upload Your files on Firebase</p>

                </div>
                <div class="col-md-6 text-center order-1 order-md-2">
                    <img class="img-fluid" src="images/mobile.png" alt="screenshot">
                </div>
            </div>
        </div>
    </section>
    <!--====  End of Hero Section  ====-->

    <section class="section pt-0 position-relative pull-top">
        <div class="container">
            <div class="rounded shadow p-5 bg-white">
                <div class="row">
                    <div class="col-lg-12 col-md-12 mt-5 mt-md-0 text-center">
                        <div class="form-outline mb-4">
                            <!-- <button class="bn54 upload"><span class="bn54span">Upload</span></button> -->
                            <div class="uploadOuter">
                                <span class="dragBox">
                                    Darg and Drop image here
                                    <input type="file" ondragover="drag()" ondrop="drop()" id="uploadFile" />
                                </span>
                            </div>
                            <div id="preview"></div>

                            <div class="upload-area">

                                <div class="progress-container">
                                    <div class="progress"></div>
                                </div>
                                <div class="percent form-label">0%</div>
                                <div class="controls">
                                    <svg class="pause" xmlns="http://www.w3.org/2000/svg" height="24"
                                        viewBox="0 0 24 24" width="24">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                    </svg>
                                    <svg class="resume" xmlns="http://www.w3.org/2000/svg" height="24"
                                        viewBox="0 0 24 24" width="24">
                                        <path
                                            d="M8 6.82v10.36c0 .79.87 1.27 1.54.84l8.14-5.18c.62-.39.62-1.29 0-1.69L9.54 5.98C8.87 5.55 8 6.03 8 6.82z" />
                                    </svg>
                                    <svg class="cancel" xmlns="http://www.w3.org/2000/svg" height="24"
                                        viewBox="0 0 24 24" width="24">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z" />
                                    </svg>
                                </div>
                                <input type="file" class="hidden-upload-btn" style="display: none;">
                            </div>
                            <div class="all-files">
                                <h2 class="text-black mb-5">Videos</h2>
                                <ul id="video"></ul>
                                <h2 class="text-black mb-5">Audios</h2>
                                <ul id="audio"></ul>
                                <h2 class="text-black mb-5">Images</h2>
                                <ul id="image"></ul>
                            </div>
                            <div class="expand-container" data-value="0">
                                <ul>
                                    <li class="form-label" onclick="openFile(this)">Open</li>
                                    <li class="form-label" onclick="downloadFile(this)">Download</li>
                                    <li class="form-label" onclick="deleteFile(this)">Delete</li>
                                </ul>
                                <!-- Preloader image -->
                                <img class="loader" src="https://aux.iconspalace.com/uploads/11080764221104328263.png"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 m-md-auto align-self-center">
                        <div class="block">
                            <a href="index.html"><img src="images/logo-alt.png" alt="footer-logo"></a>
                            <!-- Social Site Icons -->
                            <ul class="social-icon list-inline">
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/themefisher"><i class="ti-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://twitter.com/themefisher"><i class="ti-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.instagram.com/themefisher/"><i class="ti-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="text-center bg-dark py-4">
            <small class="text-secondary">Copyright &copy;
                <script>
                document.write(new Date().getFullYear())
                </script>. Designed &amp; Developed by <a href="https://themefisher.com/">Themefisher</a>
            </small class="text-secondary">
        </div>
    </footer>


    <!-- To Top -->
    <div class="scroll-top-to">
        <i class="ti-angle-up"></i>
    </div>

    <!-- JAVASCRIPTS -->


    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/bootstrap.min.js"></script>
    <script src="plugins/slick/slick.min.js"></script>
    <script src="plugins/fancybox/jquery.fancybox.min.js"></script>
    <script src="plugins/syotimer/jquery.syotimer.min.js"></script>
    <script src="plugins/aos/aos.js"></script>

    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="js/script.js"></script>
</body>

</html>