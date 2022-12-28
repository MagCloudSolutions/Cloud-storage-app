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
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

    <!-- PLUGINS CSS STYLE -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <link rel="stylesheet" href="plugins/slick/slick-theme.css">
    <link rel="stylesheet" href="plugins/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="plugins/aos/aos.css">

    <!-- CUSTOM CSS -->
    <link href="css/style.css" rel="stylesheet">

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
                    <li class="nav-item dropdown @@pages">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Pages
                            <span><i class="ti-angle-down"></i></span>
                        </a>
                        <!-- Dropdown list -->
                        <ul class="dropdown-menu">

                            <li><a class="dropdown-item" href="sign-in.php">Sign In</a></li>
                            <li><a class="dropdown-item" href="sign-up.php">Sign Up</a></li>
                        </ul>
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

    <!--================================
=            Page Title            =
=================================-->

    <section class="section page-title">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 m-auto">
                    <!-- Page Title -->
                    <h1>Verification Message</h1>
                    <form class="bg rounded shadow-5-strong p-5" action="register.php" method="post"
                        style="border: 2px solid black; ">
                        <?php
                        if ($verified) {
	                        echo '<h2 class="form-label">Verification Successful!</h2>
                                    <hr>
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <a class="form-label" href="login.php">Login here</a>
                                    </div>';
                        }

                        if ($alreadyRegistered) {
	                        echo '<h2 class="form-label">Email Already Verified!</h2>
                                    <hr>
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <a class="form-label" href="login.php">Login here</a>
                                    </div>';
                        }

                        if ($Failed) {
	                        echo '<h2 class="form-label">Verification Successful!</h2>';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 m-md-auto align-self-center">
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
                    <div class="col-lg-2 col-md-3 col-6 mt-5 mt-lg-0">
                        <div class="block-2">
                            <!-- heading -->
                            <h6>Product</h6>
                            <!-- links -->
                            <ul>
                                <li><a href="team.html">Teams</a></li>
                                <li><a href="blog.html">Blogs</a></li>
                                <li><a href="FAQ.html">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 mt-5 mt-lg-0">
                        <div class="block-2">
                            <!-- heading -->
                            <h6>Resources</h6>
                            <!-- links -->
                            <ul>
                                <li><a href="sign-up.html">Singup</a></li>
                                <li><a href="sign-in.html">Login</a></li>
                                <li><a href="blog.html">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 mt-5 mt-lg-0">
                        <div class="block-2">
                            <!-- heading -->
                            <h6>Company</h6>
                            <!-- links -->
                            <ul>
                                <li><a href="career.html">Career</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="team.html">Investor</a></li>
                                <li><a href="privacy.html">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6 mt-5 mt-lg-0">
                        <div class="block-2">
                            <!-- heading -->
                            <h6>Company</h6>
                            <!-- links -->
                            <ul>
                                <li><a href="about.html">About</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="team.html">Team</a></li>
                                <li><a href="privacy-policy.html">Privacy Policy</a></li>
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
    <!-- google map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g"></script>
    <script src="plugins/google-map/gmap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="js/script.js"></script>
</body>

</html>