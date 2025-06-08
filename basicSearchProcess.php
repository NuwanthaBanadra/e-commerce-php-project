<?php
include "connection.php";

$txt = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM product ";

if (!empty($txt) && $select == 0) {
    $query .= "WHERE title LIKE '%" . $txt . "%'";
} else if (empty($txt) && $select != 0) {
    $query .= "WHERE category_cat_id='" . $select . "'";
} else if (!empty($txt) && $select != 0) {
    $query .= "WHERE title LIKE '%" . $txt . "%' AND category_cat_id='" . $select . "'";
}
?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php
            $pageno;

            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;
            $results_per_page = 6;
            $number_of_pages = ceil($product_num / $results_per_page);
            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;
            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();
            ?>
                <div class="offset-lg-1 col-12 col-lg-3">
                    <div class="row justify-content-center">
                        <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem; border-radius: 15px;">

                            <?php
                            $img_rs = Database::search("SELECT * FROM product_img WHERE product_id='" . $selected_data["id"] . "'");
                            $img_data = $img_rs->fetch_assoc();
                            ?>
                            <img src="<?php echo $img_data["img_path"]; ?>" />
                            <div class="card-body ms-0 m-0 text-start">
                                <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>

                                <span class="card-text">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />

                                <?php
                                if ($selected_data["qty"] > 0) {

                                ?>
                                    <span class="card-text text-warning fw-bold">In Stock</span><br />
                                    <span class="card-text text-success fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</span><br /><br />
                                    <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="col-6 btn btn-success" style="font-weight: 500; border-radius: 5px; font-size: 15px;">
                                        Buy
                                    </a>
                                    <button style="width: 40px; height: 40px; line-height: 40px; border-radius: 50px; background-color: #e8f6ea; font-weight: 500; color: #088178; border: 1px solid #cce7d0; position: absolute; bottom: 20px; right: 10px; cursor: pointer; transition: 0.6s;">
                                        <i class="ri-shopping-cart-line " onclick="addToCart(<?php echo $product_data['id']; ?>);"></i>
                                    </button>
                                    <!-- <button class="col-2 btn btn-light border-dark" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);' style="border-radius: 100%;">
                                        <i class="bi bi-heart-fill text-dark" id="heart<?php echo $product_data["id"]; ?>" style="padding: -6px;"></i>
                                    </button> -->
                                <?php

                                } else {
                                ?>
                                    <span class="card-text text-danger fw-bold">Out Of Stock</span><br />
                                    <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br />
                                    <a href='#' class="col-12 btn btn-success disabled">Buy Now</a>
                                    <button class="cart">
                                        <i class="ri-shopping-cart-line i" onclick="addToCart(<?php echo $product_data['id']; ?>);"></i>
                                    </button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link" <?php if ($pageno <= 1) {
                                                        echo ("#");
                                                    } else {
                                                    ?> onclick="basicSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                            } ?> aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <?php
                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" onclick="basicSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>

                        <li class="page-item">
                            <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                        echo ("#");
                                                    } else {
                                                    ?> onclick="basicSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                            } ?> aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>