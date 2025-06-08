<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop_final</title>
    <link rel="stylesheet" href="style_2.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
</head>

<body>
    <section id="header_">
        <a href=""><img src="resource/logo.png" class="" alt=""></a>

        <div style="margin-bottom: -20px;">
            <ul id="navbar">
                <li><a href="home.php">Home</a></li>
                <li><a href="userProfile.php">My Profile</a></li>
                <li><a href="myProducts.php">My Product</a></li>
                <li><a href="purchasingHistory.php">History</a></li>
                <li><a href="contactUs.php" class="active">Contact</a></li>
                <li><a href="cart.php" class="far fa-shopping-bag"></a></li>
                <li><a id="close" class="far fa-times" style="margin-top: -20px;"></a></li>

                <div class="">

                    <?php
                    session_start();

                    if (isset($_SESSION["u"])) {
                        $data = $_SESSION["u"];
                    ?>

                        <a onclick="signout();" class="text-decoration-none fw-bold" style="font-size: 15px; cursor: pointer;">Logout</a>
                    <?php

                    } else {
                    ?>
                        <a href="index.php" class="text-decoration-none fw-bold" style="font-size: 15px; cursor: pointer;">Sign In</a>
                    <?php
                    }

                    ?>

                </div>
            </ul>
        </div>
        <div id="mob">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>
    <section id="page-header">
        <h2 style="font-weight: 700;">#contact_us</h2>
        <p> Get in touch with our team and we will be happy to assist you.</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2 style="font-weight: 700;">Visit one of our agency location or contact us today.</h2>
            <h3>Head Office</h3>
            <div>
                <li>
                    <i class="fa fa-map-marked"></i>
                    <p>210/71 F Kattuwala, Boralasgamuwa, Colombo</p>
                </li>
                <li>
                    <i class="fa fa-envelope"></i>
                    <p>nuwanthaban@gmail.com</p>
                </li>
                <li>
                    <i class="fa fa-phone"></i>
                    <p>+94 74 0447 508, +94 70 1826 874</p>
                </li>
                <li>
                    <i class="fa fa-clock"></i>
                    <p>Monday to Saturday: 8.00am to 17.00pm</p>
                </li>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.5801592206253!2d79.87666620970498!3d6.940674393030415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259ab56163413%3A0xd895bfb33509af41!2sOrion%20City!5e0!3m2!1sen!2slk!4v1707373470453!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1" style="padding: 40px 80px;">
        <div class="newstext">
            <h4>Easily contact Admins!</h4>
            <p>Chat With <span>admin.</span></p>
        </div>
        <button class="normal">Chat</button>
    </section>


    <?php include "footer.php" ?>
    <script src="script_2.js"></script>
</body>