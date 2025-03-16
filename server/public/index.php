<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json");

    require_once __DIR__ . "/../routes/web.php";
?>
