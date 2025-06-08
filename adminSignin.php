<!doctype html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="bootstrap.css">

</head>

<body>
    <section class="ftco-section" style="background-color: #d2e4e3;">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="img" style="background-image: url(resource/IMG-20230923-WA0005.jpg);"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Admin Sign In</h3>
                                </div>

                            </div>
                            <form action="#" class="signin-form">
                                <div class="form-group mt-3">
                                    <input type="email" id="e" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Admin Email</label>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3" onclick="adminVerification();">Send Verification Code</button>
                                </div>

                            </form>
                            <p class="text-center">Back to Customer<a data-toggle="tab" href="index.php"> Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal" tabindex="-1" id="verificationModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Admin Verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Enter Your Verification Code</label>
                    <input type="text" class="form-control" id="vcode">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>