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
            <div class="col-md-3">
            </div>
                <div class="col-md-6">
                    <!--Card-->
                    <div class="card ">
                        <div class="ml-5 mr-5 mt-3">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successalert">
                            <strong>Profile Updated successfully !!</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                            <div class=" row">
                                <label for="email" class="col-sm-3 col-form-label"><strong>Email</strong></label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control-plaintext" id="email">
                                </div>
                            </div>
                            <div class="row">
                                <label for="firstname" class="col-sm-3 col-form-label"><strong>First Name</strong></label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" id="firstname">
                                </div>
                            </div>
                            <div class="row">
                                <label for="lastname" class="col-sm-3 col-form-label"><strong>Last Name</strong></label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" id="lastname">
                                </div>
                            </div>
                            <div class="row">
                                <label for="provider" class="col-sm-3 col-form-label"><strong>Provider</strong></label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" id="provider" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label for="providerid" class="col-sm-3 col-form-label"><strong>Provider Id</strong></label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" id="providerid" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label for="gender" class="col-sm-3 col-form-label"><strong>Gender</strong></label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" id="gender" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label for="locale" class="col-sm-3 col-form-label"><strong>Locale</strong></label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" id="locale" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <label for="link" class="col-sm-3 col-form-label"><strong>Link</strong></label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" id="link" readonly>
                                </div>
                            </div>
                            <!--Card content-->
                            <div class="card-body">
                                <a href="#" class="btn btn-primary" id="editprofile">Save Profile</a>
                                <a href="profile.php" class="btn btn-primary" id="viewprofile">View Profile</a>
                            </div>
                           
                        </div>
                    </div>
                    <!--/.Card-->
                </div>
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
            $('#successalert').hide();
            // call restapi & display in table
            var rootURL = "http://localhost/socialapp/public/api/users/<?php echo $_SESSION['oauth_provider']?>/<?php echo $_SESSION['oauth_uid']?>";
            $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL,
                dataType: "json",
                data: null,
                success: function (data, textStatus, jqXHR) {
                    $('#email').val(data[0].email);
                    $('#firstname').val(data[0].first_name);
                    $('#lastname').val(data[0].last_name);
                    $('#provider').val(data[0].hybridauth_provider_name);
                    $('#providerid').val(data[0].hybridauth_provider_uid);
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

            $('#editprofile').click(function () {
                var JSONObject = {
                    'email': $('#email').val(),
                    'first_name': $('#firstname').val(),
                    'last_name': $('#lastname').val(),
                    'hybridauth_provider_name': $('#provider').val(),
                    'hybridauth_provider_uid': $('#providerid').val()
                };

                $.ajax({
                    type: "PUT",
                    url: "http://localhost/socialapp/public/api/users/update",
                    contentType: "application/json",
                    data: JSON.stringify(JSONObject),
                    dataType: "json",
                    async: true,
                    success: function (result) {
                    // Display a success toast, with a title
                       // alert(result);
                    },
                    error: function (result) {
                        //alert(result);
                        $('#successalert').show();
                    }
                });

            });
        });
    </script>
</body>
</html>