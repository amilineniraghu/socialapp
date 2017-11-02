<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/api/users', function (Request $request, Response $response) {
    $sql = "SELECT * FROM users";
    echo("single get");
    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        echo json_encode($users);
    } catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}';
    }
});

$app->get('/api/users/{provider}/{uid}', function (Request $request, Response $response,$args) {
    $provider = $args['provider'];
    $uid = $args['uid'];

    $sql = "SELECT * FROM `users` WHERE `hybridauth_provider_name`='$provider' AND `hybridauth_provider_uid`=$uid";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        echo json_encode($users);
    } catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}';
    }
});

$app->post('/api/users/add', function (Request $request, Response $response) {
       $data = $request->getParsedBody();
     
       $ticket_data = [];
       $ticket_data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
       $ticket_data['first_name'] = filter_var($data['first_name'], FILTER_SANITIZE_STRING);
       $ticket_data['last_name'] = filter_var($data['last_name'], FILTER_SANITIZE_STRING);
       $ticket_data['hybridauth_provider_name'] = filter_var($data['hybridauth_provider_name'], FILTER_SANITIZE_STRING);
       $ticket_data['hybridauth_provider_uid'] = filter_var($data['hybridauth_provider_uid'], FILTER_SANITIZE_STRING);

        // let generate a random password for the user
        $password = md5(str_shuffle( "0123456789abcdefghijklmnoABCDEFGHIJ"));
    
        $sql = "INSERT INTO users(email,password,first_name,last_name,hybridauth_provider_name,	hybridauth_provider_uid,created_at)	
        VALUES (:email,:password,:first_name,:last_name,:hybridauth_provider_name,:hybridauth_provider_uid,NOW())";
      
        try{
            $db = new db();
            $conn = $db->connect();
            $stmt = $conn->prepare($sql);
            
            $stmt->bindParam("email",$ticket_data['email']);
            $stmt->bindParam("password",$password);
            $stmt->bindParam("first_name", $ticket_data['first_name']);
            $stmt->bindParam("last_name", $ticket_data['last_name']);
            $stmt->bindParam("hybridauth_provider_name", $ticket_data['hybridauth_provider_name']);
            $stmt->bindParam("hybridauth_provider_uid", $ticket_data['hybridauth_provider_uid']);
                       
            $stmt->execute();

            } catch(PDOException $e){
                echo '{"error":{"text":'.$e->getMessage().'}';
            }
    });

    $app->put('/api/users/update', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $ticket_data = [];
        $ticket_data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
        $ticket_data['first_name'] = filter_var($data['first_name'], FILTER_SANITIZE_STRING);
        $ticket_data['last_name'] = filter_var($data['last_name'], FILTER_SANITIZE_STRING);
        $ticket_data['hybridauth_provider_name'] = filter_var($data['hybridauth_provider_name'], FILTER_SANITIZE_STRING);
        $ticket_data['hybridauth_provider_uid'] = filter_var($data['hybridauth_provider_uid'], FILTER_SANITIZE_STRING);
 
        $email = $ticket_data['email'];
        $first_name = $ticket_data['first_name'];
        $last_name = $ticket_data['last_name']; 
        $provider = $ticket_data['hybridauth_provider_name'];
        $provideruid = $ticket_data['hybridauth_provider_uid'];
       
        $sql = "UPDATE users SET email = '$email',first_name = '$first_name',last_name = '$last_name' WHERE hybridauth_provider_name = '$provider' AND hybridauth_provider_uid = '$provideruid'";

         try{
             $db = new db();
             $conn = $db->connect();
             $stmt = $conn->prepare($sql);
             $stmt->execute();
             echo json_encode("{'success':'200'}");
             } catch(PDOException $e){
                 echo '{"error":{"text":'.$e->getMessage().'}';
             }
     });
    
     $app->get('/api/links/{oauthid}', function (Request $request, Response $response,$args) {
        $oauthid = $args['oauthid'];
   
        $sql = "SELECT * FROM `links` WHERE `oauthid`='$oauthid'";
    
        try{
            $db = new db();
            $db = $db->connect();
            $stmt = $db->query($sql);
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db=null;
            echo json_encode($users);
        } catch(PDOException $e){
            echo '{"error":{"text":'.$e->getMessage().'}';
        }
    });

    $app->post('/api/links/add', function (Request $request, Response $response,$args) {
        $data = $request->getParsedBody();
        $operation = "sucess";
          $link_data = [];
          $link_data['oauthid'] = filter_var($data['oauthid'], FILTER_SANITIZE_STRING);
          $link_data['linkname'] = filter_var($data['linkname'], FILTER_SANITIZE_STRING);
          $link_data['hyperlink'] = filter_var($data['hyperlink'], FILTER_SANITIZE_STRING);
          $link_data['fav'] = filter_var($data['fav'], FILTER_SANITIZE_STRING);
          $link_data['category'] = filter_var($data['category'], FILTER_SANITIZE_STRING);
          

          $sql = "INSERT INTO links(oauthid,linkname,hyperlink,fav,category)	
          VALUES (:oauthid,:linkname,:hyperlink,:fav,:category)";
        
          try{
                $db = new db();
                $conn = $db->connect();
                $stmt = $conn->prepare($sql);
                
                $stmt->bindParam("oauthid",$link_data['oauthid']);
                $stmt->bindParam("linkname", $link_data['linkname']);
                $stmt->bindParam("hyperlink",$link_data['hyperlink']);
                $stmt->bindParam("fav", $link_data['fav']);
                $stmt->bindParam("category", $link_data['category']);
                $stmt->execute();
                echo json_encode($operation);
              } catch(PDOException $e){
                  echo '{"error":{"text":'.$e->getMessage().'}';
              }
    });

    $app->get('/api/links/categories/{oauthid}', function (Request $request, Response $response,$args) {
        $oauthid = $args['oauthid'];

        //$sql = "SELECT DISTINCT category,COUNT(DISTINCT(category)) FROM `links` WHERE `oauthid`='$oauthid'";
        $sql = "SELECT category,COUNT(*) as count FROM links WHERE `oauthid`='$oauthid' GROUP BY category ORDER BY count DESC;";
        try{
            $db = new db();
            $db = $db->connect();
            $stmt = $db->query($sql);
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db=null;
            echo json_encode($users);
        } catch(PDOException $e){
            echo '{"error":{"text":'.$e->getMessage().'}';
        }
    });

    $app->get('/api/links/{uid}/{category}', function (Request $request, Response $response,$args) {
        
        $uid = $args['uid'];
        $category = $args['category'];
    
        $sql = "SELECT * FROM `links` WHERE `oauthid`='$uid' AND `category`='$category'";
    
        try{
            $db = new db();
            $db = $db->connect();
            $stmt = $db->query($sql);
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db=null;
            echo json_encode($users);
        } catch(PDOException $e){
            echo '{"error":{"text":'.$e->getMessage().'}';
        }
    });

    $app->put('/api/links/updatefav', function (Request $request, Response $response) {
        $operation = "{ name: 'John', time: '2pm' }";
        $data = $request->getParsedBody();
        
          $ticket_data = [];
          $ticket_data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
          $ticket_data['fav'] = filter_var($data['fav'], FILTER_SANITIZE_STRING);
          $id = $ticket_data['id'];
          $fav = $ticket_data['fav'];


        $sql = "UPDATE links SET fav='$fav' WHERE id='$id'";

         try{
             $db = new db();
             $conn = $db->connect();
             $stmt = $conn->prepare($sql);
             $stmt->execute();
             echo json_encode($operation);
             } catch(PDOException $e){
                 echo '{"error":{"text":'.$e->getMessage().'}';
             }
     });

     $app->delete('/api/links/delete', function (Request $request, Response $response) {
         $data = $request->getParsedBody();

           $ticket_data = [];
           $ticket_data['id'] = filter_var($data['id'], FILTER_SANITIZE_STRING);
           $id = $ticket_data['id'];

         $sql = "DELETE FROM links WHERE id='$id'";

          try{
              $db = new db();
              $conn = $db->connect();
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              //echo json_encode("{'success':'200'}");
              } catch(PDOException $e){
                  echo '{"error":{"text":'.$e->getMessage().'}';
              }
      });

    ?>