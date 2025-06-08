<?php

include "connection.php";

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | cara</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style_2.css" />
    <link rel="icon" href="resource/logo.svg" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
</head>

<body>

    <div id="content">
        <div class="container-fluid">

            <div class="row">



                <section id="header_">

                    <a href=""><img src="resource/logo.png" class="" alt=""></a>

                    <div style="margin-bottom: -20px;">
                        <ul id="navbar">
                            <li><a href="home.php" class="active">Home</a></li>
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
                <section style="padding-right: 0px; padding-left: 0px;">
                    <div class="search_">
                        <input type="text" placeholder="Search here" aria-label="Text input with dropdown button" id="basic_search_txt">
                        <select class="form-select_" style="max-width: 250px;" id="basic_search_select">
                            <option value="0">All Categories</option>
                            <?php

                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $category_data["cat_id"]; ?>">
                                    <?php echo $category_data["cat_name"]; ?>
                                </option>
                            <?php
                            }

                            ?>
                        </select>
                        <button onclick="basicSearch(0);">Search</button>
                        <a href="advancedSearch.php">Advanced</a>
                    </div>
                </section>


                <div class="col-12" id="basicSearchResult">
                    <div class="row">

                        <?php include "carousel.php" ?>


                        <!-- Carousel -->
                        <!-- <section id="hero">
                            <h4 style="font-weight: 600;">Shop Smarter-Shop Better</h4>
                            <h2 style="font-weight: 700;">Introducing</h2>
                            <h1>eShop</h1>
                            <p>Your Trusted E-Commerce Haven!</p>
                            <button>Shop Now</button>

                        </section> -->

                        <!-- Carousel -->
                        <section id="feature" class="section-p1">

                            <div class="fe-box">
                                <img src="resource/features/f1.png" alt="">
                                <h6>Free Shipping</h6>
                            </div>
                            <div class="fe-box">
                                <img src="resource/features/f2.png" alt="">
                                <h6>Online Order</h6>
                            </div>
                            <div class="fe-box">
                                <img src="resource/features/f3.png" alt="">
                                <h6>Save Money</h6>
                            </div>
                            <div class="fe-box">
                                <img src="resource/features/f4.png" alt="">
                                <h6>Promotions</h6>
                            </div>
                            <div class="fe-box">
                                <img src="resource/features/f5.png" alt="">
                                <h6>Happy Sell</h6>
                            </div>
                            <div class="fe-box">
                                <img src="resource/features/f6.png" alt="">
                                <h6>24/7 Support</h6>
                            </div>

                        </section>



                        <?php
                        $category_rs2 = Database::search("SELECT * FROM `category`");
                        $category_num2 = $category_rs2->num_rows;

                        for ($y = 0; $y < $category_num2; $y++) {
                            $category_data2 = $category_rs2->fetch_assoc();
                        ?>
                            <!-- Category Name -->
                            <section id="product1" class="section-p1 border">
                                <h2 style="font-weight: 700;"><?php echo $category_data2["cat_name"]; ?></h2>
                                <p>Summer Collection New Modern Design</p>

                            </section>
                            <!-- Category Name -->
                            <!-- products -->
                            <section id="product1" class="section-p1">
                                <div class="pro-container">

                                    <div class="col-12 mb-6">
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="row justify-content-center gap-3">

                                                    <?php

                                                    $product_rs = Database::search("SELECT * FROM product WHERE category_cat_id='" . $category_data2["cat_id"] . "' 
                                                AND status_status_id='1' ORDER BY datetime_added DESC LIMIT 4 OFFSET 0");

                                                    $product_num = $product_rs->num_rows;

                                                    for ($z = 0; $z < $product_num; $z++) {
                                                        $product_data = $product_rs->fetch_assoc();
                                                    ?>

                                                        <div class="pro">

                                                            <?php
                                                            $img_rs = Database::search("SELECT * FROM product_img WHERE product_id='" . $product_data["id"] . "'");
                                                            $img_data = $img_rs->fetch_assoc();
                                                            ?>

                                                            <img src="<?php echo $img_data["img_path"]; ?>" />
                                                            <div class="des">
                                                                <span><?php echo $product_data["title"]; ?></span>

                                                                <h4>Rs. <?php echo $product_data["price"]; ?> .00</h4>
                                                                <?php
                                                                if ($product_data["qty"] > 0) {

                                                                ?>
                                                                    <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                                    <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br />
                                                                    <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="col-6 btn btn-success" style="font-weight: 500; border-radius: 5px; font-size: 15px;">
                                                                        Buy
                                                                    </a>
                                                                    <button class="cart">
                                                                        <i class="ri-shopping-cart-line i" onclick="addToCart(<?php echo $product_data['id']; ?>);"></i>
                                                                    </button>


                                                                <?php

                                                                } else {
                                                                ?>

                                                                    <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                                                                    <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br />
                                                                    <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="col-6 btn btn-success disabled" style="font-weight: 500; border-radius: 5px; font-size: 15px;">
                                                                        Buy
                                                                    </a>
                                                                    <button class="cart">
                                                                        <i class="ri-shopping-cart-line i"></i>
                                                                    </button>

                                                                <?php
                                                                }
                                                                ?>

                                                            </div>

                                                        </div>

                                                    <?php
                                                    }

                                                    ?>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- products -->
                        <?php
                        }

                        ?>

                    </div>
                </div>

                <section id="sm-banner" class="section-p1">
                    <div class="banner-box">
                        <h4>Crazy Deals</h4>
                        <h2>Buy 1 Get 1 Free</h2>
                        <span>The best Classic dress in on sale at cara</span>
                        <button class="white">Learn more</button>
                    </div>
                    <div class="banner-box banner-box2">
                        <h4>Crazy Deals</h4>
                        <h2>Buty 1 Get 1 Free</h2>
                        <span>The best Classic dress in on sale at cara</span>
                        <button class="white">Learn more</button>
                    </div>
                </section>

                <section id="newsletter" class="section-p1 section-m1" style="padding: 40px 80px;">
                    <div class="newstext">
                        <h4>Sign up for our newsletter!</h4>
                        <p>Get the latest updates and offers directly to <span>your email.</span></p>
                    </div>
                    <button class="normal">Sign Up</button>
                </section>


            </div>
        </div>
    </div>
    <button onclick="topFunction()" id="backToTopBtn" title="Go to top" class="backToTopBtn">&#8593;</button>

    <?php include "footer.php"; ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
    <script src="script_2.js"></script>
    <script src="script_3.js"></script>

</body>

</html>
