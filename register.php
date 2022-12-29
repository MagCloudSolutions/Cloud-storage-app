<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$showAlert = false;
$emailError = false;
$passwordError = false;
$internalError = false;


function sendMail($email, $verification_code)
{

  require('PHPMailer/PHPMailer.php');
  require('PHPMailer/SMTP.php');
  require('PHPMailer/Exception.php');

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'loginpage219@gmail.com'; //SMTP username
    $mail->Password = 'pchrphgbbmsgjrfa'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('loginpage219@gmail.com', 'CS Cloud');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Email Verification from CS Cloud';
    $mail->Body = '<h3>Thanks for Registration</h3>
      </br>
      <h7>Click the link below to verift your email address.</h7>
      </br>
      <a href = "http://localhost/theme/otp.php?email=' . $email . '&verification_code=' . $verification_code . '" >Verify</a>';

    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }
}
;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include "partial/config.php";

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $c_password = $_POST['c_password'];

  $existsql = "SELECT * FROM signup where email='$email'";
  $result = mysqli_query($conn, $existsql);
  $numExistRows = mysqli_num_rows($result);

  if ($numExistRows > 0) {
    $emailError = true;

  } else {
    if ($password == $c_password) {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $verification_code = bin2hex(random_bytes(16));
      $sql = "INSERT INTO `signup` (`name`, `email`, `password`, `date`, `verification_code`, `status`) VALUES ('$name', '$email', '$hash', current_timestamp(), '$verification_code', '0');";
      $result = mysqli_query($conn, $sql);

      if ($result && sendMail($_POST['email'], $verification_code)) {
        $showAlert = true;
      } else {
        $internalError = true;
      }
    } else {
      $passwordError = true;
    }
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
    <title>Sign Up</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />

    <!-- Favicon -->
    <link rel="icon" href="mag.ico">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" /> -->

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
  if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong>&nbsp;Account created successfully!&nbsp;Click Here to 
          <a href="login.php" style="color:blue;">Login</a>
        </div>';
  }

  if ($emailError) {

    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong>&nbsp;Email already Exist!&nbsp;Click Here to
      <a href="login.php" style="color:blue;">Login</a>
        </div>';
  }
  if ($passwordError) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Error!</strong>&nbsp;Password Do not match!&nbsp;Click Here to 
      <a href="register.php" style="color:blue;">Try Again</a>
        </div>';
  }
  if ($internalError) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Error!</strong>&nbsp;System ran into some problem!&nbsp;Click Here to 
      <a href="register.php" style="color:blue;">Refresh</a>
        </div>';
  }
  ?>
    <section class="user-login section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="block">
                        <!-- Image -->
                        <div class="image align-self-center">
                            <img class="img-fluid" src="photos/girl-.png" alt="desk-image" />
                        </div>
                        <!-- Content -->
                        <div class="content text-center">
                            <div class="logo">
                                <a class="navbar-brand" href="home.php"><img src="photos/mag.png"
                                        style="height: 160px; width: 145px;" alt="logo" /></a>
                            </div>
                            <div class="title-text">
                                <h3>Sign Up for New Account</h3>
                            </div>
                            <form action="register.php" method="post">
                                <!-- Username -->
                                <input class="form-control main" name="name" type="text" placeholder="Your Name"
                                    required />
                                <!-- Email -->
                                <input class="form-control main" name="email" type="email" placeholder="Email Address"
                                    required />
                                <!-- Password -->
                                <input class="form-control main" name="password" type="password" placeholder="Password"
                                    required />
                                <input class="form-control main" name="c_password" type="password"
                                    placeholder="Confirm Password" required />
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-main-md">sign up</button>
                            </form>
                            <div class="new-acount">
                                <p>
                                    By clicking “Sign Up” I agree to
                                    <a href="privacy-policy.html">Terms of Conditions.</a>
                                </p>
                                <p>
                                    Anready have an account? <a href="login.php">SIGN IN</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====  End of Sign Up  ====-->

    <!-- To Top -->
    <div class="scroll-top-to">
        <i class="ti-angle-up"></i>
    </div>

    <script type="text/javascript">
    document.getElementsByClassName("emailExist").onclick = function() {
        location.href = "login.php";
    };
    </script>

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