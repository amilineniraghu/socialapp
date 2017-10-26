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
        <?php if($_SESSION['fb_id']) {?>
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
                                aria-expanded="false"><?php echo $_SESSION['fb_pic']; ?></a>
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
                <div class="card ">
                    <table class="table" id="table">
                        <tr>
                            <th>Profile Attribute</th>
                            <th>Profile Info</th>
                            <th>Editable</th>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td contenteditable="true" id="email"></td>
                            <td>
                                <span class="badge badge-success">Yes</span></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td contenteditable="true" id="firstname"></td>
                            <td>
                                <span class="badge badge-success">Yes</span></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td contenteditable="true" id="lastname"></td>
                            <td>
                                <span class="badge badge-success">Yes</span></td>
                        </tr>
                        <tr>
                            <td>Provider</td>
                            <td id="provider"></td>
                            <td>
                                <span class="badge badge-danger">No</span></td>
                        </tr>
                        <tr>
                            <td>Provider Id</td>
                            <td id="providerid"></td>
                            <td>
                                <span class="badge badge-danger">No</span></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td id="gender"></td>
                            <td>
                                <span class="badge badge-danger">No</span></td>
                        </tr>
                        <tr>
                            <td>Locale</td>
                            <td id="locale"></td>
                            <td>
                                <span class="badge badge-danger">No</span></td>
                        </tr>
                        <tr>
                            <td>Link</td>
                            <td id="link"></td>
                            <td>
                                <span class="badge badge-danger">No</span></td>
                        </tr>
                    </table>

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
    <script>
        $(document).ready(function () {
            var uid = "<?php echo $_SESSION['fb_id']?>";
            var provider = "facebook";
            // call restapi & display in table
            var rootURL = "http://localhost/socialapp/public/api/users/facebook/<?php echo $_SESSION['fb_id']?>";
            $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL,
                dataType: "json",
                data: null,
                success: function (data, textStatus, jqXHR) {
                    arr[1][1].text(data[0].email);
                    arr[2][1].text(data[0].first_name);
                    arr[3][1].text(data[0].last_name);
                    arr[4][1].text(data[0].hybridauth_provider_name);
                    arr[5][1].text(data[0].hybridauth_provider_uid);

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

            $('#updateprofile').click(function () {

                var arr = $('#table > tbody > tr').map(function () {
                    return $(this)
                        .children()
                        .map(function () {
                            return $(this);
                        });
                });

                console.log(arr[2][1].text());
                console.log(arr[3][1].text());
                console.log(arr[4][1].text());
                console.log(arr[5][1].text());
                console.log(arr[6][1].text());

                var JSONObject = {
                    'email': arr[2][1].text(),
                    'first_name': arr[3][1].text(),
                    'last_name': arr[4][1].text(),
                    'hybridauth_provider_name': arr[5][1].text(),
                    'hybridauth_provider_uid': arr[6][1].text()
                };

                $.ajax({
                    type: "PUT",
                    url: "http://localhost/socialapp/public/api/users/update",
                    contentType: "application/json",
                    data: JSON.stringify(JSONObject),
                    dataType: "json",
                    async: true,
                    success: function (result) {
                        console.log("success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(jqXHR.status + ' ' + jqXHR.responseText);
                    }
                });

            });
        });
    </script>
</body>
</html>