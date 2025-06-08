<?php

session_start();
include "connection.php";

if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Panal</title>
        <link rel="stylesheet" href="style_.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <!-- <link rel="stylesheet" href="style_2.css" /> -->

        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
        <link rel="icon" href="LogoWhite.png" />
        <link rel="stylesheet" href="font.css" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body onload="loadChart();">


        <nav class="navbar" style="background-color: #08a096;">

            <div class="container-fluid">

                <!-- <img src="<?php echo $image_details["path"]; ?>" width="50px" height="50px" class="d-inline-block align-text-top" style="border-radius: 100%;">

                 <h5 ><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h5> -->

                <div style="background-color: #08a096;">
                    <h2 class="fw-bold text-white">Admin Panel</h2>

                </div>
                <a href="sellingHistory.php" class="btn btn-warning text-white fw-bold">Selling history</a>

            </div>

        </nav>

        <!-- <header>
            <div>
                <div class="user-wrapper">
                    <?php

                    $email = $_SESSION["au"]["email"];

                    $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON user.gender_gender_id=gender.gender_id WHERE `email`='" . $email . "'");

                    $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

                    $image_details = $image_rs->fetch_assoc();

                    ?>

                    <img src="<?php echo $image_details["path"]; ?>" width="40px" height="40px">
                    <div>
                        <h4><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h4>
                        <small>Admin</small>

                    </div>

                </div>

        </header> -->



        <main>

            <hr>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <?php
                        $user_rs = Database::search("SELECT * FROM `user`");
                        $user_num = $user_rs->num_rows;
                        ?>
                        <h1 style="font-weight: 550;"><?php echo $user_num; ?></h1>
                        <span>Customers</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <?php

                        $today = date("Y-m-d");
                        $thismonth = date("m");
                        $thisyear = date("Y");

                        $a = "0";
                        $b = "0";
                        $c = "0";
                        $e = "0";
                        $f = "0";

                        $invoice_rs = Database::search("SELECT * FROM `invoice`");
                        $invoice_num = $invoice_rs->num_rows;

                        for ($x = 0; $x < $invoice_num; $x++) {
                            $invoice_data = $invoice_rs->fetch_assoc();

                            $f = $f + $invoice_data["qty"]; //total qty

                            $d = $invoice_data["date"];
                            $splitDate = explode(" ", $d); //separate the date from time
                            $pdate = $splitDate["0"]; //sold date

                            if ($pdate == $today) {
                                $a = $a + $invoice_data["total"];
                                $c = $c + $invoice_data["qty"];
                            }

                            $splitMonth = explode("-", $pdate); //separate date as year,month & day
                            $pyear = $splitMonth["0"]; //year
                            $pmonth = $splitMonth["1"]; //month

                            if ($pyear == $thisyear) {
                                if ($pmonth == $thismonth) {
                                    $b = $b + $invoice_data["total"];
                                    $e = $e + $invoice_data["qty"];
                                }
                            }
                        }

                        ?>
                        <h1 style="font-weight: 550;">Rs.<?php echo $a; ?>.00</h1>
                        <span>Today Income</span>
                    </div>
                    <div>
                        <span class="las la-clipboard-list"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1 style="font-weight: 550;">Rs.<?php echo $b; ?>.00</h1>
                        <span>Monthly Income</span>
                    </div>
                    <div>
                        <span class="las la-clipboard-list"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1 style="font-weight: 550;"><?php echo $f; ?></h1>
                        <span>Total Sellings</span>
                    </div>
                    <div>
                        <span class="lab la-google-wallet"></span>
                    </div>
                </div>

            </div>


            <hr>
            <div style="background-color: white;">
                <br>
                <!-- chart -->
                <div style="width: 50%; margin: 0 auto; text-align: center;">
                    <h2 class="text-center fw-bold text-danger">Most Sold Product</h2>
                    <canvas id="myChart"></canvas>
                </div>
                <!-- chart -->
                <br>
            </div>

            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="font-weight: 550;">Manage All Products</h4>
                        </div>

                        <div class="card-body" style="padding: 10 50px;">

                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-success">
                                        <th scope="col">#</th>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col" class="text-end">Status</th>
                                    </tr>
                                </thead>
                                <?php
                                $query = "SELECT * FROM `product`";
                                $pageno;

                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $product_rs = Database::search($query);
                                $product_num = $product_rs->num_rows;

                                $results_per_page = 10;
                                $number_of_pages = ceil($product_num / $results_per_page);

                                $page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
                                $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                $selected_num = $selected_rs->num_rows;

                                for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();
                                ?>

                                    <tbody>
                                        <tr>
                                            <th scope="row"><?php echo $selected_data["id"]; ?></th>
                                            <td><?php
                                                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                $image_num = $image_rs->num_rows;

                                                if ($image_num == 0) {
                                                ?>
                                                    <img src="resource/mobile_images/iphone_12.jpeg" width="10px" height="10px" />
                                                <?php
                                                } else {
                                                    $image_data = $image_rs->fetch_assoc();
                                                ?>
                                                    <img src="<?php echo $image_data["img_path"]; ?>" style="width: 53px; height: 53px;" />
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $selected_data["title"]; ?></td>
                                            <td><?php echo $selected_data["price"]; ?></td>
                                            <td><?php echo $selected_data["qty"]; ?></td>
                                            <td><?php

                                                if ($selected_data["status_status_id"] == 1) {
                                                ?>
                                                    <button id="pb<?php echo $selected_data['id']; ?>" onclick="blockProduct('<?php echo $selected_data['id']; ?>');" style="background-color: #db1e1e; border: none; padding: 5px 10px; border-radius: 5px; color: white; font-weight: bold; cursor: pointer;">Block</button>
                                                <?php
                                                } else {
                                                ?>
                                                    <button id="pb<?php echo $selected_data['id']; ?>" onclick="blockProduct('<?php echo $selected_data['id']; ?>');" style="background-color: #08a096; border: none; padding: 5px 10px; border-radius: 5px; color: white; font-weight: bold; cursor: pointer;">Unblock</button>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                <?php
                                }

                                ?>
                            </table>
                            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-lg justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <?php
                                        for ($x = 1; $x <= $number_of_pages; $x++) {
                                            if ($x == $pageno) {
                                        ?>
                                                <li class="page-item active">
                                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>

                                        <li class="page-item">
                                            <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="customers">

                    <div class="card">
                        <div class="card-header">
                            <h4 style="font-weight: 550;">Manage Users</h4>
                        </div>
                        <div class="card-body" style="padding: 10 50px;">

                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-success">
                                        <th scope="col">Users</th>
                                        <th scope="col" class="text-end">status</th>
                                    </tr>
                                </thead>
                                <?php

                                $query = "SELECT * FROM `user`";
                                $pageno;

                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $user_rs = Database::search($query);
                                $user_num = $user_rs->num_rows;

                                $results_per_page = 20;
                                $number_of_pages = ceil($user_num / $results_per_page);

                                $page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
                                $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                $selected_num = $selected_rs->num_rows;

                                for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();

                                ?>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <div class="info">
                                                    <?php
                                                    $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $selected_data["email"] . "'");
                                                    $profile_img_num = $profile_img_rs->num_rows;

                                                    if ($profile_img_num == 1) {
                                                        $profile_img_data = $profile_img_rs->fetch_assoc();
                                                    ?>
                                                        <img src="<?php echo $profile_img_data["path"]; ?>" width="40px" height="40px" />
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="resource/new_user.svg" width="40px" height="40px" />
                                                    <?php
                                                    }
                                                    ?>

                                                    <div>
                                                        <h4 style="font-weight: 800;"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></h4>
                                                        <small style="opacity: 80%;"><?php echo $selected_data["email"]; ?></small>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="contact">

                                                    <span class="las la-phone" title="<?php echo $selected_data["mobile"]; ?>"></span>
                                                    &nbsp;
                                                    <?php
                                                    if ($selected_data["status_status_id"] == 1) {
                                                    ?>
                                                        <button id="ub<?php echo $selected_data["email"]; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');" style="background-color: #db1e1e; border: none; padding: 5px 10px; border-radius: 5px; color: white; font-weight: bold; cursor: pointer;">Block</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button id="ub<?php echo $selected_data["email"]; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');" style="background-color: #08a096; border: none; padding: 5px 10px; border-radius: 5px; color: white; font-weight: bold; cursor: pointer;">Unblock</button>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                <?php } ?>

                            </table>

                        </div>
                    </div>
                    <br>


                    <div class="card">
                        <div class="card-header">
                            <h4 style="font-weight: 550;">Manage Categories</h4>
                        </div>
                        <div class="card-body" style="padding: 10 50px;">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-success">
                                        <th scope="col">Category</th>
                                        <th scope="col" class="text-end">status</th>
                                    </tr>
                                </thead>
                                <?php
                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <div class="info">
                                                    <div>
                                                        <h4 style="font-size: 15px; font-weight: 50%;"><?php echo $category_data["cat_name"]; ?></h4>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                <!-- <div class="contact">
                                                    <span style="cursor: pointer;"><i class="ri-delete-bin-line"></i></span>
                                                </div> -->
                                                <div class="contact">
                                                    <span class="delete-category" style="cursor: pointer;" data-category-id="<?php echo $category_data["cat_id"]; ?>"><i class="ri-delete-bin-line"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                }
                                    ?>

                                    </tbody>

                            </table>
                            <div class="customer">
                                <div class="info">
                                    <div>
                                        <h4 style="font-size: 15px; font-weight: 50%;">Add New Ctegorie</h4>
                                    </div>
                                </div>
                                <div class="contact">
                                    <button onclick="addNewCategory();" style="background-color: #08a096; border: none; padding: 5px 10px; border-radius: 5px; color: white; font-weight: bold; cursor: pointer;">Add New Category</button>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>



        </main>

        <!-- modal 2 -->
        <div class="modal" tabindex="-1" id="addCategoryModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <label class="form-label">New Category Name : </label>
                            <input type="text" class="form-control" id="n" />
                        </div>
                        <div class="col-12 mt-2">
                            <label class="form-label">Enter Your Email : </label>
                            <input type="text" class="form-control" id="e" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="verifyCategory();">Save New Category</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal 2 -->
        <!-- modal 3 -->
        <div class="modal" tabindex="-1" id="addCategoryVerificationModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Verification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="refresh();"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 mt-3 mb-3">
                            <label class="form-label">Enter Your Verification Code : </label>
                            <input type="text" class="form-control" id="txt" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveCategory();">Verify & Save</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal 3 -->



        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="bootstrap.js"></script>
        <script src="script.js"></script>
    </body>

    </html>


<?php

} else {
?>

    <script>
        window.location = "404_error.php";
    </script>

<?php
}
?>