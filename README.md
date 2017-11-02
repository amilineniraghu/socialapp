# socialapp
This PHP app showcases usage of slim3 framework to create Restful webservices and also how to use social authentication using google and facebook.

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


Login URL
-----------
http://localhost/socialapp/public/login.php

Installation:
----------------
1) Download zip file from github and extract it. Rename the folder as socialapp.

2) Create a database with name socialapp and import the sql "socialapp.sql" located in socialapp/sql folder mentioned in previous step into mysql database.

3) Download Wamp server and install it in its default directory.

4) Copy paste the "socialapp" folder into directory of C:/wamp64/www and launch URL http://localhost/socialapp/public/login.php