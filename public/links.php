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
        <style>
        .anyClass {
                height:500px;
                overflow-y: scroll;
            }

        .favcolor{
            color:red;
        }
        </style>
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
        <div class="row">
            <div class="col-lg-8">
                <!--Card-->
                <div class="card">
                    <!--Card content-->
                    <div class="card-body">
                            <!-- First column -->
                            <div class="col-md-12">
                                <div class="list-group anyClass" id="listgroup">

                                </div>
                            <!-- First column -->
                        </div>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add</a>
                    </div>

                </div>
                <!--/.Card-->
            </div>
            <div class="col-lg-4">
                <!--Card-->
                <div class="card">
                    <!--Card content-->
                    <div class="card-body">
                    <div class="col-md-12">
                        <div class="list-group" id="categorygroup">

                        </div>
                    </div>
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
            <label for="link-name" class="col-form-label">Link Name:</label>
            <input type="text" class="form-control" id="link_name">
          </div>
          <div class="form-group">
            <label for="hyperlink" class="col-form-label">Link:</label>
            <input type="text" class="form-control" id="hyperlink">
          </div>
          <div class="form-group">
          <label class="control-label">Category</label>
            <div class="selectContainer">
                <select class="form-control" name="size" id="category">
                    <option value="">Choose a Category</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Education">Education</option>
                    <option value="Sports">Sports</option>
                    <option value="Technology">Technology</option>
                    <option value="News">News</option>
                    <option value="Others">Others</option>
                </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="savelink">Save changes</button>
      </div>
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


            function loadLinksByCategoryName(category) {
                var categoryURL = "/socialapp/public/api/links/<?php echo $_SESSION['oauth_uid']?>/"+category;
                $.ajax({
                    type: 'GET',
                    contentType: 'application/json',
                    url: categoryURL,
                    dataType: "json",
                    data: null,
                    success: function (data, textStatus, jqXHR) {
                        $('#listgroup').empty();
                        console.log(data.length);
                        if (data.length > 0){
                            for (var x = 0; x < data.length; x++) {
                                $('#listgroup').append(addLIItem(data[x].hyperlink,data[x].category,data[x].id));
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('addWine error: ' + textStatus);
                    }
                });
            }

        function showSelectedCategory(category) {
            loadLinksByCategoryName(category);
        }


        function updateFav(categoryid) {
            //alert(category);
            var myClass = $("#"+categoryid).attr("class");
            var n = myClass.search("favcolor");

            if(n == -1)
            {
                var JSONObject = {
                    'id': categoryid,
                    'fav': 0,
                };

                //set color as 0 in database and change the icon color
                var categoryURL = "/socialapp/public/api/links/updatefav";
                $.ajax({
                    type: 'PUT',
                    contentType: 'application/json',
                    url: categoryURL,
                    dataType: "json",
                    data: JSON.stringify(JSONObject),
                    success: function (data, textStatus, jqXHR) {
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //alert('addWine error: ' + textStatus);
                    }
                });

            }else{
                var JSONObject = {
                    'id': categoryid,
                    'fav': 1,
                };

                //set color as 1 in database and change the icon color
                var categoryURL = "/socialapp/public/api/links/updatefav";
                $.ajax({
                    type: 'PUT',
                    contentType: 'application/json',
                    url: categoryURL,
                    dataType: "json",
                    data: JSON.stringify(JSONObject),
                    success: function (data, textStatus, jqXHR) {
                        // console.log(data.length);
                        // if (data.length > 0){
                        //     for (var x = 0; x < data.length; x++) {
                        //         console.log(addCategory(data[x].category));
                        //         $('#categorygroup').append(addCategory(data[x].category,data[x].count));
                        //     }
                        // }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //alert('addWine error: ' + textStatus);
                    }
                });
            }

        }

        function deleteLink(target){

            var JSONObject = {
                    'id': target,
                };

                //set color as 1 in database and change the icon color
                var categoryURL = "/socialapp/public/api/links/delete";
                $.ajax({
                    type: 'DELETE',
                    contentType: 'application/json',
                    url: categoryURL,
                    dataType: "json",
                    data: JSON.stringify(JSONObject),
                    success: function (data, textStatus, jqXHR) {
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //alert('addWine error: ' + textStatus);
                    }
                });

        }

        function addLIItem(link,category,id) {
                return "<div class='list-group-item list-group-item-light'>"+
                "<div class='d-flex flex-row justify-content-end '>"+
                "<div class='p-2'><a href=''><i class='fa fa-heart fa-2x' onclick='updateFav(\""+id+"\")'aria-hidden='true' id='"+id+"'></i></a></div>"+
                "<div class='mr-auto p-2 text-primary'>"+link+"</div>"+
                "<div class='p-2'><h4><span class='badge badge-pill bg-primary'>"+category+"</span></h4></div>"+
                "<a href=''><i class='fa fa-times' style='color:red' onclick='deleteLink(\""+id+"\")' aria-hidden='true'></i></a>"+
                "</div>";
        }

        function addCategory(category,count){
            var color;
            if(category == "Entertainment"){
                color = "pink";
            }else if (category == 'Education'){
                color = "light-blue";
            }else if (category == "Sports"){
                color = "indigo";
            }else if (category == "Others"){
                color = "purple";
            }else if (category == "Technology"){
                color = "purple";
            }

            //return "<a href='#' onclick='showDiv(\""+category+"\")'><span class='badge badge-pill "+ color+"'>"+category+"</span></a>";

            return "<a href='#' onclick='showSelectedCategory(\""+category+"\")'><li class='list-group-item d-flex justify-content-between align-items-center'>"+
            category+ "<span class='badge badge-primary badge-pill'>"+count+"</span>"+
                    "</li></a>";

        }


        $(document).ready(function () {
            
            // call restapi & display
            function loadlinks() {
                var rootURL = "/socialapp/public/api/links/<?php echo $_SESSION['oauth_uid']?>";
                $.ajax({
                    type: 'GET',
                    contentType: 'application/json',
                    url: rootURL,
                    dataType: "json",
                    data: null,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data.length);
                        if (data.length > 0){
                            for (var x = 0; x < data.length; x++) {
                                $('#listgroup').append(addLIItem(data[x].hyperlink,data[x].category,data[x].id));
                                console.log(data[x].id);
                                if(data[x].fav == 0){
                                    $("#"+data[x].id).addClass("favcolor");
                                    //$("#"+data[x].id).css( "color", "red");    
                                }
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('addWine error: ' + textStatus);
                    }
                });
            }
            loadlinks();

            function loadCategories() {
                console.log(<?php echo $_SESSION['oauth_uid']?>);
                var categoryURL = "/socialapp/public/api/links/categories/<?php echo $_SESSION['oauth_uid']?>";
                $.ajax({
                    type: 'GET',
                    contentType: 'application/json',
                    url: categoryURL,
                    dataType: "json",
                    data: null,
                    success: function (data, textStatus, jqXHR) {
                        console.log(data.length);
                        if (data.length > 0){
                            for (var x = 0; x < data.length; x++) {
                                console.log(addCategory(data[x].category));
                                $('#categorygroup').append(addCategory(data[x].category,data[x].count));
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('addWine error: ' + textStatus);
                    }
                });
            }
           
            loadCategories();

            

            $("#savelink").click(function() { 
                var addLinkURL = "/socialapp/public/api/links/add/";
                var linkname = $("#link_name").val();
                var hyperlink = $("#hyperlink").val();
                var category = $("#category").val();
                var oauthid = <?php echo $_SESSION['oauth_uid']?>;
                var fav = '0';
                var temp = ""+oauthid+""
                console.log(<?php echo $_SESSION['oauth_uid']?>);
                console.log(temp);
                var JSONObject = {
                    'oauthid': oauthid,
                    'linkname': $("#link_name").val(),
                    'hyperlink': $("#hyperlink").val(),
                    'fav': fav,
                    'category':$("#category").val()
                };

                $.ajax({
                    type: 'POST',
                    contentType: 'application/json; charset=utf-8',
                    url: addLinkURL,
                    dataType: "json",
                    data: JSON.stringify(JSONObject),
                    success: function (data, textStatus, jqXHR) {
                        alert('success');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //alert('addWine error: ' + textStatus);
                        //$('#exampleModal').modal('hide');
                        $('#listgroup').empty();
                        loadlinks();

                        $('#categorygroup').empty();
                        loadCategories();

                        
                    }
                });



            });
 
        });
   
    </script>
</body>
</html>