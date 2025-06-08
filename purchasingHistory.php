<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="main.css"> -->
    <link rel="icon" href="resource/logo.png" />
    <link rel="stylesheet" href="bootstrap.css" />
    <!-- <link rel="stylesheet" href="style_2.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
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
                <li><a href="purchasingHistory.php" class="active">History</a></li>
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
    <?php

    include "connection.php";

    if (isset($_SESSION["u"])) {
        $mail = $_SESSION["u"]["email"];

        $invoice_rs = Database::search("SELECT * FROM invoice WHERE user_email='" . $mail . "'");
        $invoice_num = $invoice_rs->num_rows;

    ?>
        <main>
            <?php

            if ($invoice_num == 0) {
            ?>
                <!-- empty view -->
                <div class="col-12 text-center mb-2" style="margin-top: 100px;">
                    <h1><i class="ri-error-warning-line text-warning" style="font-size: 100px; opacity: 70%;"></i></h1>
                </div>
                <div class="col-12 text-center bg-body" style="height: 200px;">
                    <span class="fs-1 fw-bold text-black-50 d-block">
                        You have not purchased any item yet...
                    </span>
                </div>
                <!-- empty view -->
            <?php
            } else {
            ?>
                <!-- Order Area Start -->

                <div class="row">
                    <div class="col-lg-12">

                    </div>
                </div>
                <div>
                    <h3 class="text-center fw-bold text-danger mt-5">Purchasing History</h3>
                    <hr>
                </div>
                <div class="card-body" style="padding: 10px 50px;">
                    <table class="table table-hover">
                        <thead class="text-success">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Product</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Purchased Date & Time</th>
                                <th scope="col">Feedback</th>
                            </tr>
                        </thead>

                        <?php

                        for ($x = 0; $x < $invoice_num; $x++) {
                            $invoice_data = $invoice_rs->fetch_assoc();

                        ?>
                            <?php

                            $details_rs = Database::search("SELECT * FROM product INNER JOIN product_img ON 
                            product.id=product_img.product_id INNER JOIN user ON product.user_email=user.email 
                            WHERE id='" . $invoice_data["product_id"] . "'");

                            $product_data = $details_rs->fetch_assoc();

                            ?>
                            <tbody>
                                <div>
                                <tr>
                                    <th scope="row"><img src="<?php echo $product_data["img_path"]; ?>" width="100px" height="100px"></th>
                                    <td>
                                        <p><?php echo $product_data["title"]; ?></p>
                                    </td>
                                    <td>
                                        <p>Rs.<?php echo $product_data["price"]; ?>.00</p>
                                    </td>
                                    <td>
                                        <p><?php echo $invoice_data["qty"]; ?> item</p>
                                    </td>
                                    <td>
                                        <p>Rs.<?php echo $invoice_data["total"]; ?>.00</p>
                                    </td>
                                    <td>

                                        <p class="text-warning"><i class="fas fa-star"></i> 5.0</p>

                                    </td>
                                    <td>
                                        <p><?php echo $invoice_data["date"]; ?></p>
                                    </td>
                                    <td>
                                        <div class="button">
                                            <a class="btn bg-primary" style="border-radius: 0; color: white;" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);">Feedback</a>

                                            
                                        </div>

                                    </td>
                                </tr>
            <?php

                        }

            ?>
                                </div>
                                
                            </tbody>
                    </table>


                </div>




            <!-- Order Area End -->
        </main>
        <!-- model -->
        <div class="modal" tabindex="-1" id="feedbackmodal<?php echo $invoice_data['product_id']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Add New Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fw-bold">Type</label>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="type" id="type1" />
                                                <label class="form-check-label text-success fw-bold" for="type1">
                                                    Positive
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="type" id="type2" checked />
                                                <label class="form-check-label text-warning fw-bold" for="type2">
                                                    Neutral
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="type" id="type3" />
                                                <label class="form-check-label text-danger fw-bold" for="type3">
                                                    Negative
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fw-bold">User's Email</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="text" class="form-control" disabled id="mail" value="<?php echo $mail; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fw-bold">Feedback</label>
                                        </div>
                                        <div class="col-9">
                                            <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-primary" onclick="saveFeedback(<?php echo $invoice_data['product_id']; ?>);">Save Feedback</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- model -->
<?php
            }
        }

?>
<!-- Footer -->

<?php include "footer.php"; ?>

<!-- Footer -->

<script src="bootstrap.bundle.js"></script>
<script src="script.js"></script>
<script src="script1.js"></script>

</body>