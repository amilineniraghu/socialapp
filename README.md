# socialapp
PHP app to showcase usage of slim3 framework.

Technology used:
---------------------
1) Slim 3.8 for RESTful services
2) PHP 7.1.9
3) MYSQL 5.7.19
4) apache 2.4.27
5) facebook/graph-sdk: 5.6

Test Credentials:
----------
email:
open_qebxpad_user@tfbnw.net
pwd:
Test*123#


REST API
-----------
$app->post('/api/users/add', function (Request $request, Response $response) {
$app->put('/api/users/update', function (Request $request, Response $response) {
$app->get('/api/users/{provider}/{uid}', function (Request $request, Response $response,$args) {
$app->get('/api/users', function (Request $request, Response $response) {

Login URL
-----------
http://localhost/socialapp/public/login.php

Installation:
----------------
1) download Wamp server and install it in its default directory.
2) copy paste the socialapp folder into directory of C:/wamp64/www
and launch URL http://localhost/socialapp/public/login.php
3) if you are using anyother server for hosting webapp then some source needs to be modified.