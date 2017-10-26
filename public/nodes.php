<?php
    session_start();
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
                            <li class="nav-item">
                                <a class="nav-link" href="home.php">Home</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="links.php">Links</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="nodes.php">Nodes<span class="sr-only">(current)</span></a>
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

            <div class="col-lg-12">
                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <div class="card-body">
                        <a href="#" class="btn btn-primary">Update</a>
                    </div>

                </div>
                <!--/.Card-->
            </div>
        </div>
    </main>

    <?php } ?>
    <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
    <script></script>
</body>
</html>