<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Contact Admins | eShop</title>

    <link rel="icon" href="resource/logo.png" />
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
    <link rel="stylesheet" href="assets/css/style3.css">
    <link rel="stylesheet" href="assets/css/responsive.css">


</head>

<body>
<section id="header_">
        <a href=""><img src="resource/logo.png" class="" alt=""></a>

        <div>
            <ul id="navbar">
                <li><a href="home.php">Home</a></li>
                <li><a href="userProfile.php">My Profile</a></li>
                <li><a href="myProducts.php">My Product</a></li>
                <li><a href="watchlist.php">Watchlist</a></li>
                <li><a href="purchasingHistory.php">Purchase History</a></li>
                <li><a href="contactUs.php" class="active">Contact</a></li>
                <li><a href="cart.php" class="far fa-shopping-bag"></a></li>
                <li onclick="signout();"><a class="ri-logout-box-r-line" style="font-size: 20px;"></a></li>
                <li><a id="close" class="far fa-times" style="margin-top: -90px;"></a></li>
            </ul>
        </div>
        <div id="mob">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <?php
    session_start();
    include "connection.php";

    $mail = $_SESSION["u"]["email"];
    ?>

    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width">Contact with Admins</h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->
    <div class="pd-ltr-20 xs-pd-20-10" style="padding: 0px 0px 0;">
        <div class="min-height-200px">

            <div class="bg-white border-radius-4 box-shadow mb-30">
                <div class="row no-gutters">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="chat-list bg-light-gray">
                            <div class="chat-search">
                                <select class="col-12 badge-dark border-radius-4 p-2" id="select_user">
                                    <option value="0">Select User</option>
                                    <?php
                                    $select_rs = Database::search("SELECT * FROM `user`");
                                    $select_num = $select_rs->num_rows;
                                    for ($z = 0; $z < $select_num; $z++) {
                                        $selected_data = $select_rs->fetch_assoc();
                                        if ($selected_data["email"] != $mail) {
                                    ?>
                                            <option value="<?php echo $selected_data["email"]; ?>">
                                                <?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="notification-list chat-notification-list customscroll" style="padding: 0px;">

                                <?php

                                $msg_rs = Database::search("SELECT DISTINCT * FROM `chat` WHERE `to`='" . $mail . "' ORDER BY `date_time` DESC");
                                $msg_num = $msg_rs->num_rows;

                                ?>
                                <ul>
                                    <li>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Received</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sent</button>
                                            </li>
                                        </ul>


                                    </li>

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="" id="message_box">

                                            <?php

                                            for ($x = 0; $x < $msg_num; $x++) {
                                                $msg_data = $msg_rs->fetch_assoc();

                                                $sender = $msg_data["from"];

                                                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $sender . "'");

                                                $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $sender . "'");

                                                $user_data = $user_rs->fetch_assoc();
                                                $img_data = $img_rs->fetch_assoc();

                                                if ($msg_data["status"] == 0) {
                                            ?>
                                                    <div class="list-group rounded-0" onclick="viewMessage('<?php echo $sender; ?>');">
                                                        <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-primary">

                                                            <div class="media">

                                                                <?php
                                                                if (isset($img_data["path"])) {
                                                                ?>
                                                                    <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="resource/new_user.svg" width="50px" class="rounded-circle">
                                                                <?php
                                                                }
                                                                ?>

                                                                <div class="me-4">
                                                                    <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                        <h6 class="mb-0 fw-bold"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></h6>
                                                                        <small class="small fw-bold">&nbsp;<?php echo $msg_data["date_time"]; ?></small>

                                                                    </div>
                                                                    <p class="mb-0">&nbsp;<?php echo $msg_data["content"]; ?></p>
                                                                </div>
                                                            </div>
                                                        </a>

                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="list-group rounded-0" onclick="viewMessage('<?php echo $sender; ?>');">
                                                        <a href="#" class="list-group-item list-group-item-action text-dark rounded-0 bg-body">

                                                            <div class="media">

                                                                <?php
                                                                if (isset($user_data["path"])) {
                                                                ?>
                                                                    <img src="<?php echo $user_data["path"]; ?>" width="50px" class="rounded-circle">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" width="50px" class="rounded-circle">
                                                                <?php
                                                                }
                                                                ?>

                                                                <div class="me-4">
                                                                    <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                        <h6 class="mb-0 fw-bold"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></h6>
                                                                        <small class="small fw-bold">&nbsp;<?php echo $msg_data["date_time"]; ?></small>

                                                                    </div>
                                                                    <p class="mb-0">&nbsp;<?php echo $msg_data["content"]; ?></p>
                                                                </div>
                                                            </div>
                                                        </a>

                                                    </div>
                                            <?php
                                                }
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                        <div class="" id="message_box">

                                            <?php

                                            $msg_rs2 = Database::search("SELECT DISTINCT * FROM `chat` WHERE `from`='" . $mail . "' ORDER BY `date_time` DESC");
                                            $msg_num2 = $msg_rs2->num_rows;

                                            for ($y = 0; $y < $msg_num2; $y++) {
                                                $msg_data2 = $msg_rs2->fetch_assoc();

                                                $receiver = $msg_data2["to"];

                                                $user_rs2 = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON 
                                                user.email=profile_img.user_email WHERE `email`='" . $receiver . "'");

                                                $user_data2 = $user_rs2->fetch_assoc();

                                            ?>

                                                <div class="list-group rounded-0" onclick="viewMessage('<?php echo $receiver; ?>');">
                                                    <a href="#" class="list-group-item list-group-item-action text-black rounded-0 ">
                                                        <div class="media">

                                                            <?php
                                                            if (isset($user_data2["path"])) {
                                                            ?>
                                                                <img src="<?php echo $user_data2["path"]; ?>" width="50px" class="rounded-circle">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="resource/new_user.svg" width="50px" class="rounded-circle">
                                                            <?php
                                                            }
                                                            ?>

                                                            <div class="me-4">
                                                                <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                    <h6 class="mb-0 fw-bold"> &nbsp;me</h6>
                                                                    <small class="small fw-bold">&nbsp;<?php echo $msg_data2["date_time"]; ?></small>

                                                                </div>
                                                                <p class="mb-0">&nbsp;<?php echo $msg_data2["content"]; ?></p>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                            <?php
                                            }

                                            ?>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="chat-detail">

                            <div class="chat-box">
                                <div class="chat-desc customscroll">
                                    <ul>
                                        <div class="col-12 px-0">
                                            <div class="row px-4 py-5 text-white chat_box" id="chat_box">

                                                <!-- view area -->

                                            </div>

                                        </div>
                                </div>
                                <div class="chat-footer">

                                    <div class="file-upload">
                                        <a href="#"></a>
                                    </div>
                                    <div class="chat_text_area">

                                        <input type="text" style="margin-top: 100px;" class="form-control rounded border-0 py-3 bg-light" placeholder="Type a message ..." aria-describedby="send_btn" id="msg_txt" />

                                    </div>

                                    <button class="btn btn-light fs-2" style="margin-top: 100px;" id="send_btn" onclick="send_msg();"><i class="bi bi-send-fill fs-1"></i></button>

                                </div>
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
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="script1.js"></script>
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>

</body>

</html>