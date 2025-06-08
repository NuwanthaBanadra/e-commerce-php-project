<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style_2.css" />
    <link rel="icon" href="resource/logo.svg" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

</head>

<body class="bg-info" >

    <div class="container-fluid" style="background-color: #07b6aa;">
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
                        <li><a id="close" class="far fa-times" style="margin-top: -30px;"></a></li>
                    </ul>
                </div>
                <div id="mob">
                    <i id="bar" class="fas fa-outdent"></i>
                </div>
            </section>

            <div class="col-12 bg-body mb-2">
                <div class="row">
                    <div class="offset-lg-4 col-12 col-lg-4">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-lg-2 col-12 col-lg-8 mb-3 bg-body rounded">
                <div class="row">

                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                        <P class="fs-2 text-black-50 fw-bold mt-3 pt-2">Advanced Search  <i class="ri-search-line" style="font-size: 30px;"></i></P>
                            <div class="col-12 col-lg-10 mt-2 mb-1">
                                <input type="text" class="form-control" placeholder="Type keyword to search..." id="t" />
                            </div>
                            <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                                <button class="btn" style="background-color: #07b6aa; color: white; font-weight: 700;" onclick="advancedSearch(0);">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-2 " style="background-color: #07b6aa; opacity: 100%;">
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="c1">
                                            <option value="0">Select Category</option>
                                            <?php
                                            include "connection.php";

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
                                    </div>

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="b1">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $brand_rs = Database::search("SELECT * FROM `brand`");
                                            $brand_num = $brand_rs->num_rows;

                                            for ($x = 0; $x < $brand_num; $x++) {
                                                $brand_data = $brand_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $brand_data["brand_id"]; ?>">
                                                    <?php echo $brand_data["brand_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $model_rs = Database::search("SELECT * FROM `model`");
                                            $model_num = $model_rs->num_rows;

                                            for ($x = 0; $x < $model_num; $x++) {
                                                $model_data = $model_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $model_data["model_id"]; ?>">
                                                    <?php echo $model_data["model_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select" id="c2">
                                            <option value="0">Select Condition</option>
                                            <?php
                                            $condition_rs = Database::search("SELECT * FROM `condition`");
                                            $condition_num = $condition_rs->num_rows;

                                            for ($x = 0; $x < $condition_num; $x++) {
                                                $condition_data = $condition_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $condition_data["condition_id"]; ?>">
                                                    <?php echo $condition_data["condition_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select" id="c3">
                                            <option value="0">Select Colour</option>
                                            <?php
                                            $clr_rs = Database::search("SELECT * FROM `color`");
                                            $clr_num = $clr_rs->num_rows;

                                            for ($x = 0; $x < $clr_num; $x++) {
                                                $clr_data = $clr_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $clr_data["clr_id"]; ?>">
                                                    <?php echo $clr_data["clr_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-3">
                <div class="row">
                    <div class="offset-8 col-4 mt-2 mb-2">
                        <select id="s" class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-dark">
                            <option value="0">SORT BY</option>
                            <option value="1">PRICE LOW TO HIGH</option>
                            <option value="2">PRICE HIGH TO LOW</option>
                            <option value="3">QUANTITY LOW TO HIGH</option>
                            <option value="4">QUANTITY HIGH TO LOW</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-3">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-black-50 fw-bold">Search Here.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>