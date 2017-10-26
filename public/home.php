<?php
   if(!session_id()) {
    session_start();
 }
?>
<!DOCTYPE html>
<html>
    <head>
        <!--Import materialize.css-->
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/mdb.min.css">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <?php if($_SESSION['oauth_uid']) {?>
        <!--Navbar -->
        <header>
            <nav class="mb-1 navbar navbar-expand-lg navbar-dark indigo lighten-1">
                <div class="container">
                    <a class="navbar-brand" href="#">SocialApp</a>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent-5"
                        aria-controls="navbarSupportedContent-5"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-5">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="home.php">Home
                                    <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="profile.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="links.php">Links</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="nodes.php">Nodes</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto nav-flex-icons">
                            <li class="nav-item avatar dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    id="navbarDropdownMenuLink-5"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"><?php echo $_SESSION['picture']; ?></a>
                                <div
                                    class="dropdown-menu dropdown-menu-right dropdown-purple"
                                    aria-labelledby="navbarDropdownMenuLink-5">
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!--/.Navbar -->
        <!--Main container-->
        <main class="mt-5">
            <div class="container">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-7 mb-4">

                        <!--Featured image -->
                        <div class="view overlay hm-white-light z-depth-1-half">
                            <img
                                src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg"
                                class="img-fluid "
                                alt="">
                            <div class="mask"></div>
                        </div>

                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-5 mb-4">

                        <h2>Some awesome heading</h2>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis pariatur
                            quod ipsum atque quam dolorem voluptate officia sunt placeat consectetur alias
                            fugit cum praesentium ratione sint mollitia, perferendis natus quaerat!</p>
                        <a href="https://mdbootstrap.com/" class="btn btn-primary">Get it now!</a>

                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-12 mb-4">

                        <!--Card-->
                        <div class="card">

                            <!--Card image-->
                            <div class="view overlay hm-white-slight">
                                <img
                                    src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(72).jpg"
                                    class="img-fluid"
                                    alt="">
                                <a href="#">
                                    <div class="mask"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title">Card title</h4>
                                <!--Text-->
                                <p class="card-text">Some quick example text to build on the card title and make
                                    up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Button</a>
                            </div>

                        </div>
                        <!--/.Card-->

                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4">

                        <!--Card-->
                        <div class="card">

                            <!--Card image-->
                            <div class="view overlay hm-white-slight">
                                <img
                                    src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(74).jpg"
                                    class="img-fluid"
                                    alt="">
                                <a href="#">
                                    <div class="mask"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title">Card title</h4>
                                <!--Text-->
                                <p class="card-text">Some quick example text to build on the card title and make
                                    up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Button</a>
                            </div>

                        </div>
                        <!--/.Card-->

                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4">

                        <!--Card-->
                        <div class="card">

                            <!--Card image-->
                            <div class="view overlay hm-white-slight">
                                <img
                                    src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(75).jpg"
                                    class="img-fluid"
                                    alt="">
                                <a href="#">
                                    <div class="mask"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title">Card title</h4>
                                <!--Text-->
                                <p class="card-text">Some quick example text to build on the card title and make
                                    up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Button</a>
                            </div>

                        </div>
                        <!--/.Card-->

                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->
            </main>
            <!--Footer-->
            <footer class="page-footer blue center-on-small-only">

                <!--Footer Links-->
                <div class="container">
                    <div class="row">

                        <!--First column-->
                        <div class="col-md-6">
                            <h5 class="title">Footer Content</h5>
                            <p>Here you can use rows and columns here to organize your footer content.</p>
                        </div>
                        <!--/.First column-->

                        <!--Second column-->
                        <div class="col-md-6">
                            <h5 class="title">Links</h5>
                            <ul>
                                <li>
                                    <a href="#!">Link 1</a>
                                </li>
                                <li>
                                    <a href="#!">Link 2</a>
                                </li>
                                <li>
                                    <a href="#!">Link 3</a>
                                </li>
                                <li>
                                    <a href="#!">Link 4</a>
                                </li>
                            </ul>
                        </div>
                        <!--/.Second column-->
                    </div>
                </div>
                <!--/.Footer Links-->

                <!--Copyright-->
                <div class="footer-copyright">
                    <div class="container-fluid">
                        © 2017 Copyright:
                        <a href="https://www.socialapp.com">
                            socialapp.com
                        </a>

                    </div>
                </div>
                <!--/.Copyright-->

            </footer>
            <!--/.Footer-->

        </div>
        <?php } ?>
        <!--Main container-->
        <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/popper.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
        <script></script>
    </body>
</html>