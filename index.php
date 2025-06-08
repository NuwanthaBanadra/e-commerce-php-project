<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SingnIn | Signup</title>
    <link rel="stylesheet" href="style_9.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body>


    <div id="container" class="container_">
        <!-- FORM SECTION -->
        <div class="row_">
            <!-- SIGN UP -->
            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-up">
                        <div class="col-12 d-none" id="msgdiv">
                            <div class="alert alert-danger" role="alert" id="msg">

                            </div>
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-user'></i>
                            <input type="text" placeholder="First Name" id="fname">
                        </div>
                        <div class="input-group">
                            <i class='bx bx-mail-send'></i>
                            <input type="text" placeholder="Last Name" id="lname">
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="email" placeholder="Email" id="email">
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" placeholder="Password" id="password">
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="text" placeholder="Contact Number" id="mobile">
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <select class="form-control" id="gender">

                                <?php

                                $rs = Database::search("SELECT * FROM `gender`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $data = $rs->fetch_assoc();
                                ?>

                                    <option value="<?php echo $data["gender_id"]; ?>">
                                        <?php echo $data["gender_name"]; ?>
                                    </option>

                                <?php
                                }

                                ?>

                            </select>
                        </div>
                        <button onclick="signup();">
                            Sign up
                        </button>
                        <p>
                            <span>
                                Already have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign in here
                            </b>
                        </p>
                    </div>
                </div>

            </div>
            <!-- END SIGN UP -->
            <!-- SIGN IN -->
            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-in">
                        <div class="col-12 d-none" id="msgdiv1">
                            <div class="alert alert-danger" role="alert" id="msg1">

                            </div>
                        </div>
                        <div class="input-group">
                            <?php
                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }
                            ?>
                            <i class='bx bxs-user'></i>
                            <input type="email" placeholder="Email" id="email2" value="<?php echo $email; ?>">
                        </div>
                        <div class="input-group">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" placeholder="Password" id="password2" value="<?php echo $password; ?>">
                        </div>
                        <div class="form-check">
                            <input class="" type="checkbox" id="rememberme" />
                            <label class="form-check-label">Remember Me</label>
                        </div>
                        <button onclick="signin();" id="liveToastBtn">
                            Sign in
                        </button>

                        <div style="padding-top: 10px;">
                            <button onclick="ad_();">

                                Admin Sign in
                            </button>
                        </div>

                        <p>
                            <b> <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a></b>
                        </p>
                        <p>
                            <span>
                                Don't have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign up here
                            </b>
                            <br>
                            <span>
                                Back to the
                            </span>
                            <a href="home.php">Home here</a>
                        </p>
                    </div>
                </div>
                <div class="form-wrapper">

                </div>
            </div>
            <!-- END SIGN IN -->
        </div>
        <!-- END FORM SECTION -->
        <!-- modal -->
        <div class="modal" tabindex="-1" id="fpmodal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Forgot Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-6">
                                <label class="form-label">New Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="np" />
                                    <button id="npb" class="btn btn-outline-secondary" type="button" onclick="showPassword1();">Show</button>
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Re-type Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="rnp" />
                                    <button id="rnpb" class="btn btn-outline-secondary" type="button" onclick="showPassword2();">Show</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Verification Code</label>
                                <input type="text" class="form-control" id="vcode" />
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- CONTENT SECTION -->
        <div class="row_ content-row">
            <!-- SIGN IN CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="text sign-in">
                    <h2>
                        Welcome <br> to Cara
                    </h2>

                </div>
                <div class="img sign-in">

                </div>
            </div>
            <!-- END SIGN IN CONTENT -->
            <!-- SIGN UP CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="img sign-up">

                </div>
                <div class="text sign-up">
                    <h2>
                        Join <br> with us
                    </h2>

                </div>
            </div>
            <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>

    <div class="background">
    </div>

    <!-- notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Notice</strong>
                <small>1 sec ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello,Welcome Back to Cara E-commerce Web Aplication !!!
            </div>
        </div>
    </div>
    <!-- notification -->

    <script>
        let container = document.getElementById('container')

        toggle = () => {
            container.classList.toggle('sign-in')
            container.classList.toggle('sign-up')
        }

        setTimeout(() => {
            container.classList.add('sign-in')
        }, 200)



        function ad_() {
            window.location = "adminSignin.php";
        }
    </script>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>


</html>