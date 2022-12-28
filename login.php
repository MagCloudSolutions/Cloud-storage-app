<?php
$showError = false;
$login = false;
$mailIDerror = false;
$passwordError = false;



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include "partial/config.php";
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * from signup where email = '$email'";
  $result = mysqli_query($conn, $sql);

  $num = mysqli_num_rows($result);

  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password']) && $row['status'] == '1') {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        header('Location: home.php');

      } else {
        if (!password_verify($password, $row['password'])) {
          $passwordError = true;
        } else if ($row['status'] != '1') {
          $mailIDerror = true;
        }
      }
    }
  } else {
    $showError = true;

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
    <meta charset="utf-8" />
    <title>Sign In</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

    <!-- PLUGINS CSS STYLE -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css" />
    <link rel="stylesheet" href="plugins/slick/slick.css" />
    <link rel="stylesheet" href="plugins/slick/slick-theme.css" />
    <link rel="stylesheet" href="plugins/fancybox/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="plugins/aos/aos.css" />

    <!-- CUSTOM CSS -->
    <link href="css/style.css" rel="stylesheet" />
</head>

<body class="body-wrapper" data-spy="scroll" data-target=".privacy-nav">
    <?php
    if ($login) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>&nbsp;You are logged in
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if ($showError) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong>&nbsp;Invalid Credentials
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    if ($passwordError) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>&nbsp;Incorrect Password.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    if ($mailIDerror) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>&nbsp;Email not verified please check your mail inbox.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>
    <section class="user-login section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="block">
                        <!-- Image -->
                        <div class="image align-self-center">
                            <img class="img-fluid" src="images/Login/front-desk-sign-in.jpg" alt="desk-image" />
                        </div>
                        <!-- Content -->
                        <div class="content text-center">
                            <div class="logo">
                                <a href="index.html"><img src="images/logo.png" alt="" /></a>
                            </div>
                            <div class="title-text">
                                <h3>Sign in to To Your Account</h3>
                            </div>
                            <form action="login.php" method="post">
                                <!-- Username -->
                                <input class="form-control main" name="email" type="email" placeholder="Email"
                                    required />
                                <!-- Password -->
                                <input class="form-control main" name="password" type="password" placeholder="Password"
                                    required />
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-main-sm">sign in</button>
                            </form>
                            <div class="new-acount">
                                <a href="contact.html">Forget your password?</a>
                                <p>
                                    Don't Have an account? <a href="sign-up.php"> SIGN UP</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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