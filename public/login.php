<?php

require_once 'fbconfig.php';
require_once 'gpConfig.php';

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SocialApp Login Form</title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/mdb.min.css">
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
        -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]> <script
        src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> <script
        src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <main class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <section class="form-elegant">
                            <!--Form without header-->
                            <div class="card">

                                <div class="card-body mx-4">

                                    <!--Header-->
                                    <div class="text-center">
                                        <h3 class="dark-grey-text mb-5">
                                            <strong>Sign in</strong>
                                        </h3>
                                    </div>

                                    <!--Body-->
                                    <div class="md-form">
                                        <input type="text" id="Form-email1" class="form-control">
                                        <label for="Form-email1">Your email</label>
                                    </div>

                                    <div class="md-form pb-3">
                                        <input type="password" id="Form-pass1" class="form-control">
                                        <label for="Form-pass1">Your password</label>
                                        <p class="font-small blue-text d-flex justify-content-end">Forgot
                                            <a href="#" class="blue-text ml-1">
                                                Password?</a>
                                        </p>
                                    </div>

                                    <div class="text-center mb-3">
                                        <button type="button" class="btn  btn-default btn-block btn-rounded z-depth-1a">Sign in</button>
                                    </div>
                                    <p
                                        class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-2">
                                        or Sign in with:</p>
                                    <div class="row my-4 d-flex justify-content-center">
                                        <!--Facebook-->
                                        <a class="btn btn-primary active" href="<?php echo $loginUrl; ?>">
                                            <i class="fa fa-facebook  fa-lg"></i>
                                            Facebook</a>
                                            
                                        <!--Twitter-->
                                        <a class="btn btn-info active" href="#">
                                            <i class="fa fa-twitter  fa-lg"></i>
                                            Twitter</a>
                                        <!--Google +-->
                                        <a class="btn btn-danger active" href="<?php echo $loginGoogleURL; ?>">
                                            <i class="fa fa-google-plus  fa-lg"></i>
                                            Google Plus
                                        </a>
                                    </div>
                                </div>

                                <!--Footer-->
                                <div class="modal-footer mx-5 pt-3 mb-1">
                                    <p class="font-small grey-text d-flex justify-content-end">Not a member?
                                        <a href="#" class="blue-text ml-1">
                                            Sign Up</a>
                                    </p>
                                </div>

                            </div>
                            <!--/Form without header-->

                        </section>
                    </div>
                </div>
            </div>
        </main>
        <!-- Javascript -->
        <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/popper.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../assets/js/mdb.min.js"></script>

        <!--[if lt IE 10]> <script src="assets/js/placeholder.js"></script> <![endif]-->

    </body>

</html>