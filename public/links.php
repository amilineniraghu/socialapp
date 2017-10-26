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
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
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
                            <a class="nav-link" href="profile.php">Profile
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="links.php">Links<span class="sr-only">(current)</span></a>
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

            <div class="col-lg-12">
                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <div class="card-body">
                        <div class="row">
                            <!-- First column -->
                            <div class="col-md-8">
                                <div class="list-group" id="listgroup">
                                    
                                </div>
                            </div>
                            <!-- First column -->
                        </div>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add</a>
                    </div>

                </div>
                <!--/.Card-->
            </div>
        </div>

        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Link Name:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Link:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Link:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
    // basically return (or print out) string of resource
        
    function addLIItem(link,category) {
                return "<div class='list-group-item list-group-item-light'>"+
                "<div class='d-flex flex-row justify-content-end '>"+
                "<div class='p-2'><a href=''><i class='fa fa-heart fa-2x' style='color:red' aria-hidden='true'></i></a></div>"+
                "<div class='mr-auto p-2 text-primary'>"+link+"</div>"+
                "<div class='p-2'><h4><span class='badge badge-pill bg-primary'>"+category+"</span></h4></div>"+
                "</div>";
        }

        $(document).ready(function () {
            // call restapi & display
            var rootURL = "/socialapp/public/api/links/<?php echo $_SESSION['oauth_uid']?>";
            $.ajax({
                type: 'GET',
                contentType: 'application/json',
                url: rootURL,
                dataType: "json",
                data: null,
                success: function (data, textStatus, jqXHR) {
                    for (var x = 0; x < data.length; x++) {
                        $('#listgroup').append(addLIItem(data[x].hyperlink,data[x].category));
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('addWine error: ' + textStatus);
                }
            });
        });
    
    
    </script>
</body>
</html>