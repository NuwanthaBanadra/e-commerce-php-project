<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product | eShop</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style_2.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>
    <section id="header_">
        <a href=""><img src="resource/logo.png" class="" alt="img"></a>

        <div style="margin-bottom: -20px;">
            <ul id="navbar">
                <li><a href="myProducts.php">Back to My Product</a></li>
                <li><a id="close" class="far fa-times" style="margin-top: -30px;"></a></li>
            </ul>
        </div>
        <div id="mob">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <?php
    session_start();
    if (isset($_SESSION["u"])) {

        include "connection.php";

    ?>
        <br>
        <form class="form-horizontal">
            <fieldset>

                <!-- Form Name -->
                <legend class="text-center text-danger fw-bold">ADD NEW PRODUCTS</legend>


                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_categorie">PRODUCT CATEGORY</label>
                    <div class="col-md-4">
                        <select id="category" name="product_categorie" class="form-control">
                            <option value="0">SELECT CATEGORY</option>
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
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_categorie">PRODUCT BRAND</label>
                    <div class="col-md-4">
                        <select id="brand" name="product_categorie" class="form-control">
                            <option value="0">SELECT BRAND</option>
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
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_categorie">PRODUCT MODEL</label>
                    <div class="col-md-4">
                        <select id="model" name="product_categorie" class="form-control">
                            <option value="0">SELECT MODEL</option>
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
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>
                    <div class="col-md-4">
                        <input id="title" placeholder="PRODUCT NAME" class="form-control input-md" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_categorie">PRODUCT CONDITION</label>
                    <div class="col-md-4">
                        <div class="col-12">
                            <div class="form-check form-check-inline mx-5">
                                <input class="form-check-input" type="radio" name="c" id="b" checked />
                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="c" id="u" />
                                <label class="form-check-label fw-bold" for="u">Used</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_categorie">PRODUCT COLOUR</label>
                    <div class="col-md-4">
                        <select id="clr" class="form-control">
                            <option value="0">SELECT COLOUR</option>
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
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_categorie">ADD NEW COLOUR</label>
                    <div class="col-md-4">
                        <input id="product_name" name="product_name" placeholder="ADD NEW COLOUR" class="form-control input-md" required="" type="text">
                        <br>
                        <button class="btn btn-warning" style="width: 100px;">+ ADD</button>
                    </div>
                </div>

                <!-- Select Basic -->


                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="available_quantity">AVAILABLE QUANTITY</label>
                    <div class="col-md-4">
                        <div class="col-12">
                            <input type="number" class="form-control" value="0" min="0" id="qty" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="available_quantity">COST PER ITEM</label>
                    <div class="col-md-4">
                        <div class="col-12">
                            <input type="number" class="form-control" value="0" min="0" id="cost" />
                        </div>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_weight">DELIVERY COST</label>
                    <div class="col-md-4">

                        <div class="input-group mb-2 mt-2">

                            <span class="input-group-text fw-bold">Delivery cost Within Colombo</span>
                            <input type="number" min="0" class="form-control" id="dwc" />
                            <br><br>
                            <span class="input-group-text fw-bold">Delivery cost out of Colombo</span>
                            <input type="number" min="0" class="form-control" id="doc" />
                        </div>

                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_name_fr">PRODUCT DESCRIPTION</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="desc" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">

                            </div>
                            <div class="offset-lg-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-4 border border-primary rounded">
                                        <img src="resource/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0" />
                                    </div>
                                    <div class="col-4 border border-primary rounded">
                                        <img src="resource/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1" />
                                    </div>
                                    <div class="col-4 border border-primary rounded">
                                        <img src="resource/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i2" />
                                    </div>
                                </div>
                            </div>
                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                <input type="file" class="d-none" multiple id="imageuploader" />
                                <label for="imageuploader" class="col-12 btn btn-dark" style="border-radius: 0;" onclick="changeProductImage();">Upload Images</label>
                            </div>
                        </div>
                    </div>


                    <!-- Button -->
                    <!-- <div class="col-12">
                        <label class="form-label fw-bold" style="font-size: 20px;">Notice...</label><br />
                        <label class="form-label">
                            We are taking 5% of the product from price from every
                            product as a service charge.
                        </label>
                    </div> -->
                    <div class="col-12">
                        <hr class="border-success" />
                    </div>

                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                        <button class="btn btn-success" onclick="addProduct();" id="liveToastBtn">Save Product</button>
                    </div>

            </fieldset>
        </form>
        <br><br><br><br>


        <!-- notification -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img class="rounded me-2">
                    <strong class="me-auto">Notice</strong>
                    <small>1 sec ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    New Product saved Successfully....
                </div>
            </div>
        </div>
        <!-- notification -->

    <?php

    } else {
        header("Location: home.php");
    }

    ?>
    
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
    <script src="script_2.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>


</html>