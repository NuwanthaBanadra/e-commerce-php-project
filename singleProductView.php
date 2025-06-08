<?php
include "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.model_has_brand_id,product.condition_condition_id,
    product.status_status_id,product.user_email,model.model_name AS mname,brand.brand_name AS bname FROM 
    product INNER JOIN model_has_brand ON model_has_brand.id=product.model_has_brand_id INNER JOIN 
    brand ON brand.brand_id=model_has_brand.brand_brand_id INNER JOIN model ON 
    model.model_id=model_has_brand.model_model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"]; ?> | eShop</title>
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="style_2.css" />
            <link rel="stylesheet" href="style_3.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
            <link rel="icon" href="resource/logo.svg" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">
                    <section id="header_">

                        <a href=""><img src="resource/logo.png" class="" alt=""></a>

                        <div style="margin-bottom: -20px;">
                            <ul id="navbar">
                                <li><a href="home.php">Home</a></li>
                                <li><a href="userProfile.php">My Profile</a></li>
                                <li><a href="myProducts.php">My Product</a></li>
                                <li><a href="purchasingHistory.php">History</a></li>
                                <li><a href="contactUs.php">Contact</a></li>
                                <li><a href="cart.php" class="far fa-shopping-bag"></a></li>
                                <!-- <li onclick="signout();"><a class="ri-logout-box-r-line" style="font-size: 20px;"></a></li> -->
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

                    <div class="main-wrapper">
                        <div class="container">
                            <div class="product-div">
                                <div class="product-div-left">


                                    <div class="img-container">
                                        <img src="resource/empty.svg">

                                    </div>


                                    <div class="hover-container">

                                        <?php
                                        $image_rs = Database::search("SELECT * FROM product_img WHERE product_id='" . $pid . "'");
                                        $image_num = $image_rs->num_rows;
                                        $img = array();
                                        ?>

                                        <?php

                                        if ($image_num != 0) {
                                            for ($x = 0; $x < $image_num; $x++) {
                                                $image_data = $image_rs->fetch_assoc();
                                                $img[$x] = $image_data["img_path"];
                                        ?>


                                                <div><img src="<?php echo $img[$x]; ?>"></div>

                                            <?php
                                            }
                                        } else {
                                            ?>

                                            <div><img src="resource/empty.svg" /></div>

                                            <div><img src="resource/empty.svg" /></div>

                                            <div><img src="resource/empty.svg" /></div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>


                                <div class="product-div-right">

                                    <span class="product-name"><?php echo $product_data["title"]; ?></span>
                                    <p style="font-size: 15px;">Available Items: <?php echo $product_data["qty"]; ?></p>
                                    <div class="product-rating">
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star"></i></span>
                                        <span><i class="fas fa-star-half-alt"></i></span>
                                        <span>(350 ratings)</span>
                                    </div><br>

                                    <p><b> Product Details:</b> <br><?php echo $product_data["description"]; ?></p>

                                    <?php

                                    $price = $product_data["price"];
                                    $adding_price = ($price / 100) * 10;
                                    $new_price = $price + $adding_price;
                                    $difference = $new_price - $price;

                                    ?>

                                    <span class="product-price">Rs. <?php echo $price; ?> .00</span>

                                    <span class="product-price text-decoration-line-through" style="color: red; font-size: 20px;">
                                        Rs. <?php echo $new_price; ?> .00
                                    </span>


                                    <?php
                                    $seller_rs = Database::search("SELECT * FROM user WHERE email='" . $product_data["user_email"] . "'");
                                    $seller_data = $seller_rs->fetch_assoc();
                                    ?>

                                    <div class="border border-1 border-secondary rounded overflow-hidden 
                                                        float-left mt-1 position-relative product-qty">

                                        <input onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' type="text" class="border-0  text-start" style="outline: none;" pattern="[0-9]" value="1" id="qty_input" />

                                        <div class="position-absolute qty-buttons">
                                            <div class="justify-content-center d-flex flex-column align-items-center 
                                                                 qty-inc">
                                                <i class="bi bi-caret-up-fill" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                            </div>
                                            <div class="justify-content-center d-flex flex-column align-items-center 
                                                                 qty-dec">
                                                <i class="bi bi-caret-down-fill" onclick="qty_dec();"></i>
                                            </div>
                                        </div>

                                    </div>


                                    <div class=" btn-groups">

                                        <button class="buy-now-btn" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);"><i class="fas fa-wallet"></i>Buy Now</button>

                                        <button type="button" class="add-cart-btn" onclick="addToCart(<?php echo $product_data['id']; ?>);"><i class="fas fa-shopping-cart"></i>add to cart</button>
                                        <!-- <button type="button" class="add-cart-btn"><i class="ri-heart-fill"></i> Wishlist</button> -->

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
            <script src="script_4.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

        </body>

        </html>
    <?php

    } else {
        echo ("Sorry for the inconvenience.Please try again later.");
    }
} else {
    ?>

    <script>
        window.location = "404_error.php";
    </script>

<?php
}

?>

