<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8" />
	<title>Invoice | eShop</title>

	<link rel="icon" href="resource/logo.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="bootstrap.css" />
	<link rel="stylesheet" href="style_7.css" />
	<link rel="stylesheet" href="style_8.css" />

	<style>
        body {
            margin-top: 20px;
            color: #484b51;
        }

        .text-secondary-d1 {
            color: #728299 !important;
        }

        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }

        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
        }

        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }

        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }
    </style>

</head>

<body>


	<?php
	session_start();

	include "connection.php";

	if (isset($_SESSION["u"])) {
		$umail = $_SESSION["u"]["email"];
		$oid = $_GET["id"];

	?>

		<div class="col-12 btn-toolbar justify-content-end">
			<button class="btn-dark  mt-1 border-radius-0 p-1" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
			&nbsp;
			<button class="btn-danger  mt-1 border-radius-0 p-1" onclick="printInvoice();"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
		</div>

		<div class="mobile-menu-overlay"></div>
		<div class="page-content container" >


			<div class="container px-0">
				<div class="row mt-4">
					<div class="col-12 col-lg-12">
						<div class="row">
							<div class="col-12">
								<div class="text-center text-150 fw-bold">
									<span class="text-default-d3">I N V O I C E</span>
								</div>
							</div>
						</div>
						<!-- .row -->

						<hr class="row brc-default-l1 mx-n1 mb-4" />
						<?php

						$address_rs = Database::search("SELECT * FROM user_has_address WHERE user_email='" . $umail . "'");
						$address_data = $address_rs->fetch_assoc();
						$invoice_rs = Database::search("SELECT * FROM invoice WHERE order_id='" . $oid . "'");
						$invoice_data = $invoice_rs->fetch_assoc();
						?>

						<div class="row">
							<div class="col-sm-6">
								<div>
									<span class="text-sm text-grey-m2 align-middle">To:</span>
									<span class="text-600 text-110 text-blue align-middle"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
								</div>
								<div class="text-grey-m2">
									<div class="my-1">
										<?php echo $address_data["line1"]; ?>
									</div>
									<div class="my-1">
										<?php echo $address_data["line2"]; ?>
									</div>
									<!-- <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">111-111-111</b></div> -->
								</div>
							</div>
							<!-- /.col -->

							<div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
								<hr class="d-sm-none" />
								<div class="text-grey-m2">
									<div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
										Invoice
									</div>

									<div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> <?php echo $oid; ?></div>

									<div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> <?php echo $invoice_data["date"]; ?></div>

									<div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">No:</span> <span class="badge badge-warning badge-pill px-25"><?php echo $invoice_data["invoice_id"]; ?></span></div>
								</div>
							</div>
							<!-- /.col -->
						</div>
						<?php

						$product_rs = Database::search("SELECT * FROM product WHERE id='" . $invoice_data["product_id"] . "'");
						$product_data = $product_rs->fetch_assoc();

						?>
						<div class="mt-4">
							<div class="row text-600 text-white bgc-default-tp1 py-25">
								<div class="col-9 col-sm-5">Description</div>
								<div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
								<div class="d-none d-sm-block col-sm-2">Unit Price</div>
								<div class="col-2">Amount</div>
							</div>

							<div class="text-95 text-secondary-d3">
								<div class="row mb-2 mb-sm-0 py-25">

									<div class="col-9 col-sm-5"><?php echo $product_data["title"]; ?></div>
									<div class="d-none d-sm-block col-2"><?php echo $invoice_data["qty"]; ?></div>
									<div class="d-none d-sm-block col-2 text-95">Rs. <?php echo $product_data["price"]; ?> .00</div>
									<div class="col-2 text-secondary-d2">Rs. <?php echo $invoice_data["total"]; ?> .00</div>
								</div>

							</div>

							<div class="row border-b-2 brc-default-l2"></div>

							<?php

							$city_rs = Database::search("SELECT * FROM city WHERE city_id='" . $address_data["city_city_id"] . "'");
							$city_data = $city_rs->fetch_assoc();

							$delivery = 0;

							if ($city_data["district_district_id"] == 2) {
								$delivery = $product_data["delivery_fee_colombo"];
							} else {
								$delivery = $product_data["delivery_fee_other"];
							}

							$t = $invoice_data["total"];
							$g = $t - $delivery;

							?>
							<div class="row mt-3">
								<div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
									Extra note such as company or payment information...
								</div>

								<div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
									<div class="row my-2">
										<div class="col-7 text-right">
											SubTotal
										</div>
										<div class="col-5">
											<span class="text-120 text-secondary-d1">Rs. <?php echo $g; ?> .00</span>
										</div>
									</div>

									<div class="row my-2">
										<div class="col-7 text-right">
											Delivery Fee
										</div>
										<div class="col-5">
											<span class="text-110 text-secondary-d1">Rs. <?php echo $delivery; ?> .00</span>
										</div>
									</div>

									<div class="row my-2 align-items-center bgc-primary-l3 p-2">
										<div class="col-7 text-right">
											Total Amount
										</div>
										<div class="col-5">
											<span class="text-150 text-success-d3 opacity-2">Rs. <?php echo $t; ?> .00</span>
										</div>
									</div>
								</div>
							</div>

							<hr />

							<div>
								<span class="text-secondary-d1 text-105 text-center">Thank you</span>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}

	?>

	<script src="bootstrap.bundle.js"></script>
	<script src="script.js"></script>
</body>

</html>