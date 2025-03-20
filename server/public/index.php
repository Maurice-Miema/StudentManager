<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    require_once __DIR__ . "/../routes/web.php";
?>
