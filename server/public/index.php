<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
        header("HTTP/1.1 200 OK");
        exit;
    }
    
    header("Access-Control-Allow-Origin: *"); 
    header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");    

    require_once __DIR__ . "/../routes/web.php";
?>