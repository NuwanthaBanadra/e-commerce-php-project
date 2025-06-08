<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link rel="stylesheet" href="style_2.css" />
    <link rel="icon" href="resource/logo.svg" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
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
                <li><a href="contactUs.php">Contact</a></li>
                <li><a href="cart.php" class="far fa-shopping-bag active"></a></li>
                <!-- <li onclick="signout();"><a class="ri-logout-box-r-line" style="font-size: 20px;"></a></li> -->
                <li><a id="close" class="far fa-times" style="margin-top: -90px;"></a></li>

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
        <h2 style="font-weight: 700;">#Add_to_cart</h2>
        <p> Get in touch with our team and we will be happy to assist you.</p>
    </section>
    <br>

    <?php
    include "connection.php";
    // session_start();
    if (isset($_SESSION["u"])) {
        $user = $_SESSION["u"]["email"];

        $total = 0;
        $subtotal = 0;
        $shipping = 0;
    ?>
        <section id="cart" class="section-p1">
            <?php
            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
            $cart_num = $cart_rs->num_rows;

            if ($cart_num == 0) {
            ?>
                <table width="100%">
                    <!-- Empty View -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 text-center mb-2">
                                <h1><i class="ri-error-warning-line" style="font-size: 100px;"></i></h1>
                            </div>
                            <div class="col-12 emptyCart"></div>
                            <div class="col-12 text-center mb-2">
                                <label class="form-label fs-2 fw-bold">
                                    You have no items in your Cart yet.
                                </label>
                            </div>
                            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                <a href="home.php" class="btn btn-warning" style="font-weight: bold;">
                                    Start Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Empty View -->
                </table>
            <?php
            } else {
            ?>
                <table>
                    <thead>
                        <tr>
                            <td>Remove</td>
                            <td>Image</td>
                            <td>Product</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Subtotal</td>
                        </tr>
                    </thead>
                    <?php
                    for ($x = 0; $x < $cart_num; $x++) {
                        $cart_data = $cart_rs->fetch_assoc();

                        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON product.id=product_img.product_id WHERE `id`='" . $cart_data["product_id"] . "'");
                        $product_data = $product_rs->fetch_assoc();

                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                        $address_rs = Database::search("SELECT `district_id` AS did FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_city_id=city.city_id INNER JOIN `district` ON city.district_district_id=district.district_id WHERE `user_email`='" . $user . "'");
                        $address_data = $address_rs->fetch_assoc();

                        $ship = 0;

                        if ($address_data["did"] == 2) {
                            $ship = $product_data["delivery_fee_colombo"];
                            $shipping = $shipping + $ship;
                        } else {
                            $ship = $product_data["delivery_fee_other"];
                            $shipping = $shipping + $ship;
                        }

                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                        $seller_data = $seller_rs->fetch_assoc();

                    ?>
                        <tbody>
                            <tr>
                                <!-- <td><a href="" onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);"><i class="far fa-times-circle"></i></a></td> -->

                                <td><button onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);" style="color: black; background-color: #E3E6F3; border: none; font-size: 18px; width: 25px; height: 25px; border-radius: 100%; opacity: 50%;"><i class="far fa-times-circle"></i></button></td>

                                <td><img src="<?php echo $product_data["img_path"]; ?>" alt="" style="width: 60px; height: 60px;"></td>

                                <td><?php echo $product_data["title"]; ?></td>

                                <td>Rs.<?php echo $product_data["price"]; ?>.00</td>


                                <td><input type="number" min="1" value="<?php echo $cart_data["qty"]; ?>" onchange="changeQTY(<?php echo $cart_data['cart_id']; ?>);" id="qty_num"></td>

                                <td>Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</td>
                            </tr>
                        </tbody>
                    <?php
                    }
                    ?>
                </table>
            <?php
            }
            ?>
        </section>
        <section id="cart-add" class="section-p1">
            <div class="subtotal">
                <h3>Cart Totals</h3>
                <table>
                    <tr>
                        <td>Cart Subtotal</td>
                        <td>Rs.<?php echo $total; ?>.00</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>Rs.<?php echo $shipping; ?>.00</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>Rs.<?php echo $total + $shipping; ?>.00</strong></td>
                    </tr>
                </table>
                <!-- <button class="normal">Proceed to Checkout</button> -->
            </div>
        </section>
    <?php
    } else {
    ?>

        <script>
            window.location = "404_error.php";
        </script>

    <?php
    }
    ?>



    <section id="newsletter" class="section-p1 section-m1" style="padding: 40px 80px;">
        <div class="newstext">
            <h4>Sign up for our newsletter!</h4>
            <p>Get the latest updates and offers directly to <span>your email.</span></p>
        </div>
        <button class="normal">Sign Up</button>
    </section>

    <?php include "footer.php" ?>

    <script src="script.js"></script>
    <script src="script_2.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>
