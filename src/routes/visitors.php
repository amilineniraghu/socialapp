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

    ?>