<?php

//Database Connection for localhost 
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('BASE_URL', 'http://localhost/php-functions-class/');
    define('UPLOAD_URL', 'http://localhost/php-functions-class/uploads/');
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "php-function-class";
} else { //Database Connection for Live Hosting
    define('BASE_URL', 'http://www.example.com/');
    define('UPLOAD_URL', 'http://www.example.com/uploads/');
    $host = "localhost";
    $user = "example";
    $password = "password";
    $database = "php-function-class";
}  
//You can add multiple connections here by if - else if , if you are working on more than 2 servers 


$connection = mysqli_connect("$host", "$user", "$password", "$database");
