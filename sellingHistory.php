<?php

include "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Selling History | Admins | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />



    <link rel="icon" href="resource/logo.svg" />
</head>

<body>


    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light mt-3 mb-3">
                <div class="row">
                    <div class="col-12 col-lg-3 mt-2 mb-2">
                        <div class="col-12 bg-light text-center">
                            <label class="form-label text-danger fw-bold fs-1">Selling History</label>
                        </div>
                    </div>

                </div>
            </div>
            <div style="padding: 0 15px;">
                <table class="table">
                    <thead style="background-color: #E3E6F3;;">
                        <tr>
                            <th scope="col"><label class="form-label fs-5 fw-bold text-black">Invoice ID</label></th>
                            <th scope="col"><label class="form-label fs-5 fw-bold text-black">Product</label></th>
                            <th scope="col"><label class="form-label fs-5 fw-bold text-black">Buyer</label></th>
                            <th scope="col"><label class="form-label fs-5 fw-bold text-black">Amount</label></th>
                            <th scope="col"><label class="form-label fs-5 fw-bold text-black">Quantity</label></th>
                            <th scope="col"><label class="form-label fs-5 fw-bold text-black">Status</label></th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $query = "SELECT * FROM `invoice`";
                        $pageno;

                        if (isset($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }

                        $invoice_rs = Database::search($query);
                        $invoice_num = $invoice_rs->num_rows;

                        $results_per_page = 20;
                        $number_of_pages = ceil($invoice_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
                        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                        $selected_num = $selected_rs->num_rows;

                        for ($x = 0; $x < $selected_num; $x++) {
                            $selected_data = $selected_rs->fetch_assoc();
                        ?>
                            <tr>
                                <th scope="row"><?php echo $selected_data["invoice_id"]; ?></th>

                                <?php

                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();

                                ?>

                                <td><?php echo $product_data["title"]; ?></td>

                                <?php

                                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                                $user_data = $user_rs->fetch_assoc();

                                ?>

                                <td><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>
                                <td>Rs. <?php echo $selected_data["total"]; ?> .00</td>
                                <td><?php echo $selected_data["qty"]; ?></td>
                                <td>
                                    <div class="col-6 bg-white d-grid">
                                        <?php
                                        if ($selected_data["status"] == 0) {
                                        ?>
                                            <button class="btn btn-success fw-bold  id=" btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Confirm Order</button>
                                        <?php
                                        } else if ($selected_data["status"] == 1) {
                                        ?>
                                            <button class="btn btn-warning fw-bold " id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Packing</button>
                                        <?php
                                        } else if ($selected_data["status"] == 2) {
                                        ?>
                                            <button class="btn btn-info fw-bold " id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Dispatch</button>
                                        <?php
                                        } else if ($selected_data["status"] == 3) {
                                        ?>
                                            <button class="btn btn-primary fw-bold " id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Shipping</button>
                                        <?php
                                        } else if ($selected_data["status"] == 4) {
                                        ?>
                                            <button class="btn btn-danger fw-bold " id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Delivered</button>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                    </tbody>

                </table>

            </div>


        </div>

    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>

