<?php
   if(!session_id()) {
    session_start();
 }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
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
                        <li class="nav-item active">
                            <a class="nav-link" href="profile.php">Profile
                                <span class="sr-only">(current)</span></a>
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
        <div class="row">
        <div class="col-lg-3">
        </div>
            <div class="col-lg-6">
                <!--Card-->
                <div class="card ">
                <div class="ml-5 mr-5 mt-3">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>Profile Attribute</th>
                                <th>Profile Info</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Email</td>
                            <td  id="email"></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td  id="firstname"></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td id="lastname"></td>
                        </tr>
                        <tr>
                            <td>Provider</td>
                            <td id="provider"></td>
                        </tr>
                        <tr>
                            <td>Provider Id</td>
                            <td id="providerid"></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td id="gender"></td>
                        </tr>
                        <tr>
                            <td>Locale</td>
                            <td id="locale"></td>
                        </tr>
                        <tr>
                            <td>Link</td>
                            <td id="link"></td>
                        </tr>
                        </tbody>
                    </table>
                   
                    <!--Card content-->
                    <div class="card-body">
                        <a href="editprofile.php" class="btn btn-primary" id="editprofile">Edit Profile</a>
                        <!-- <a href="#" class="btn btn-primary">Save Changes</a> -->
                    </div>
                    </div>
                </div>
                <!--/.Card-->
                </div>
            </div>
        </div>

    </main>
    <?php } ?>
    <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/popper.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
    <script>
        $(document).ready(function () {
           
            // call restapi & display in table
            var rootURL = "/socialapp/public/api/users/<?php echo $_SESSION['oauth_provider']?>/<?php echo $_SESSION['oauth_uid']?>";
            $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL,
                dataType: "json",
                data: null,
                success: function (data, textStatus, jqXHR) {
                    arr[0][1].text(data[0].email);
                    arr[1][1].text(data[0].first_name);
                    arr[2][1].text(data[0].last_name);
                    arr[3][1].text(data[0].hybridauth_provider_name);
                    arr[4][1].text(data[0].hybridauth_provider_uid);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('addWine error: ' + textStatus);
                }
            });

            var arr = $('#table > tbody > tr').map(function () {
                return $(this)
                    .children()
                    .map(function () {
                        return $(this);
                    });
            });
          
        });
    </script>
</body>
</html>