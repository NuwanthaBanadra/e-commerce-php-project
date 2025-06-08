<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style_2.css" />
    <link rel="stylesheet" href="bootstrap.css" />

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
                        <li><a href="userProfile.php" class="active">My Profile</a></li>
                        <li><a href="myProducts.php">My Product</a></li>
                        <li><a href="purchasingHistory.php">History</a></li>
                        <li><a href="contactUs.php">Contact</a></li>
                        <li><a href="cart.php" class="far fa-shopping-bag"></a></li>
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

                $email = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
                user.gender_gender_id=gender.gender_id WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                city.district_district_id=district.district_id INNER JOIN `province` ON 
                district.province_province_id=province.province_id WHERE `user_email`='" . $email . "'");

                $user_details = $details_rs->fetch_assoc();
                $image_details = $image_rs->fetch_assoc();
                $address_details = $address_rs->fetch_assoc();

            ?>
                <div class="col-12 ">
                    <div class="row" style="background-color: #07b6aa;">

                        <div class="col-12 bg-body rounded mt-4 mb-4">
                            <div style="padding: 10px 50px;">

                                <div class="card">
                                    <div class="p-3 py-5">
                                        <div class="row">
                                            <div class="col-12 col-sm-auto mb-3">
                                                <div class="mx-auto" style="width: 140px;">
                                                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                                                        <?php

                                                        if (empty($image_details["path"])) {
                                                        ?>
                                                            <img src="resource/new_user.svg" class="rounded mt-5" style="width: 150px;" id="img" />
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="<?php echo $image_details["path"]; ?>" class="rounded mt-10" id="img" style="width: 150px;" />
                                                        <?php
                                                        }

                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                <div class="text-center text-sm-left mb-2 mb-sm-0 ">
                                                    <h4 class="pt-sm-2 pb-1 mb-0  text-start fw-bold"><?php echo $user_details["fname"] . " " . $user_details["lname"] ?></h4>
                                                    <p class="mb-0 text-start fw-bold" style="opacity: 70%; margin-top: 10px;"><?php echo $email; ?></p>

                                                    <div class="mt-2 text-start">
                                                        <input type="file" class="d-none" id="profileimage" />
                                                        <label for="profileimage" class="btn btn-primary fw-bold" onclick="changeProfileImg();">Change Image</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Settings</h4>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <label class="form-label">First Name</label>
                                                <input id="fname" type="text" class="form-control" value="<?php echo $user_details["fname"]; ?>" />
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Last Name</label>
                                                <input id="lname" type="text" class="form-control" value="<?php echo $user_details["lname"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Mobile</label>
                                                <input id="mobile" type="text" class="form-control" value="<?php echo $user_details["mobile"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" value="<?php echo $user_details["password"]; ?>" readonly />
                                                    <span class="input-group-text bg-primary" id="basic-addon2">
                                                        <i class="bi bi-eye-slash-fill text-white"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $user_details["email"]; ?>" />
                                            </div>


                                            <div class="col-12">
                                                <label class="form-label">Address Line 01</label>

                                                <?php
                                                if (empty($address_details["line1"])) {
                                                ?>
                                                    <input id="line1" type="text" class="form-control" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input id="line1" type="text" class="form-control" value="<?php echo $address_details["line1"]; ?>" />
                                                <?php
                                                }
                                                ?>

                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Address Line 02</label>
                                                <?php
                                                if (empty($address_details["line2"])) {
                                                ?>
                                                    <input id="line2" type="text" class="form-control" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input id="line2" type="text" class="form-control" value="<?php echo $address_details["line2"]; ?>" />
                                                <?php
                                                }
                                                ?>
                                            </div>

                                            <?php
                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");
                                            ?>

                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    for ($x = 0; $x < $province_rs->num_rows; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                                                                                        if (!empty($address_details["province_id"])) {
                                                                                                                            if ($province_data["province_id"] == $address_details["province_id"]) {
                                                                                                                        ?>selected<?php
                                                                                                                                }
                                                                                                                            }
                                                                                                                                    ?>>
                                                            <?php echo $province_data["province_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    for ($x = 0; $x < $district_rs->num_rows; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["district_id"]; ?>" <?php
                                                                                                                        if (!empty($address_details["district_id"])) {
                                                                                                                            if ($district_data["district_id"] == $address_details["district_id"]) {
                                                                                                                        ?>selected<?php
                                                                                                                                }
                                                                                                                            }

                                                                                                                                    ?>>
                                                            <?php echo $district_data["district_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">City</label>
                                                <select class="form-select" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    for ($x = 0; $x < $city_rs->num_rows; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["city_id"]; ?>" <?php
                                                                                                                if (!empty($address_details["city_id"])) {
                                                                                                                    if ($city_data["city_id"] == $address_details["city_id"]) {
                                                                                                                ?>selected<?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>>
                                                            <?php echo $city_data["city_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Postal Code</label>
                                                <?php
                                                if (empty($address_details["postal_code"])) {
                                                ?>
                                                    <input id="pcode" type="text" class="form-control" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input id="pcode" type="text" class="form-control" value="<?php echo $address_details["postal_code"]; ?>" />
                                                <?php
                                                }
                                                ?>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" value="<?php echo $user_details["gender_name"]; ?>" readonly />
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn btn-primary fw-bold" onclick="updateProfile();">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- <div class="col-md-4 text-center">
                                    <div class="row">
                                        <?php include "banner.php" ?>
                                    </div>
                                </div> -->

                            </div>
                        </div>

                    </div>
                </div>
            <?php

            } else {
            ?>

                <script>
                    window.location = "404_error.php";
                </script>

            <?php
            }

            ?>

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="script_2.js"></script>
</body>

</html>