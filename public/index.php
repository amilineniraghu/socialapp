<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';


$app = new \Slim\App;

$app->add(new \Tuupola\Middleware\Cors([
    "origin" => ["*"],
    "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
    "headers.allow" => ["Authorization", "If-Match", "If-Unmodified-Since"],
    "headers.expose" => ["Etag"],
    "credentials" => true,
    "cache" => 86400
]));

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");
    return $response;
});

require '../src/routes/visitors.php';
$app->run();