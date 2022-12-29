<?php
$verified = false;
$alreadyRegistered = false;
$Failed = false;
require('partial/config.php');
if (isset($_GET['email']) && isset($_GET['verification_code'])) {
    $query = "SELECT * FROM `signup` WHERE `signup`.`email`='$_GET[email]' AND `signup`.`verification_code`='$_GET[verification_code]'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);

            if ($result_fetch['status'] == '0') {
                $update = "UPDATE `signup` SET `status` = '1' WHERE `signup`.`email` = '$result_fetch[email]';";
                $run = mysqli_query($conn, $update);
                if ($run) {
                    $verified = true;
                }
            } else {
                $alreadyRegistered = true;
            }

        }

    } else {
        $Failed = true;
    }
}
?>


<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Verification Page</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Bootstrap App Landing Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Small Apps Template v1.0">

    <!-- Favicon -->
    <link rel="icon" href="mag.ico">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" /> -->

    <!-- PLUGINS CSS STYLE -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <link rel="stylesheet" href="css/new.css">
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
            <a class="navbar-brand" href="home.php"><img src="photos/mag.png" style="height: 50px; width: 55px;"
                    alt="logo">Mag
                Cloud</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item @@about">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item @@about">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item @@about">
                        <a class="nav-link" href="register.php">Sign-up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <section class="section page-title">
        <div class="container">
        </div>
    </section>
    <section class="section pt-0 position-relative pull-top">
        <div class="container">
            <div class="rounded shadow p-5 bg-white">
                <div class="row">
                    <div class="col-lg-12 col-md-12 mt-5 mt-md-0 text-center">
                        <div class="form-outline mb-4">

                            <div id="preview">
                                <?php
                                if ($verified) {
                                    echo '<h2 class="form-label1">Verification Successful!</h2>
                                        <hr>
                                        <!-- Email input -->
                                        <div class="form-outline mb-4">
                                        <a class="form-label1" href="login.php">Login here</a>
                                        </div>';
                                }

                                if ($alreadyRegistered) {
                                    echo '<h2 class="form-label1">Email Already Verified!</h2>
                                    <div class="form-outline mb-4">
                                    <a class="form-label1" href="login.php">Login here</a>
                                    </div>';
                                }

                                if ($Failed) {
                                    echo '<h2 class="form-label1">Verification Successful!</h2>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="text-center bg-dark py-4"><img src="photos/mag.png" alt="footer-logo"
                style="height: 38px; width: 41px;">
            <small class="text-secondary">Copyright &copy;
                <script>
                document.write(new Date().getFullYear())
                </script>. Designed &amp; Developed by <a href="#">CS Cloud</a>
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
    <!-- google map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g"></script>
    <script src="plugins/google-map/gmap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="js/script.js"></script>
</body>

</html>