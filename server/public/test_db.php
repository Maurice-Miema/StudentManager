<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../App/config/DataBase.php";

$db = new Database();
$conn = $db->getConnection();

if ($conn) {
    echo json_encode(["message" => "Connexion réussie"]);
} else {
    echo json_encode(["message" => "Échec de la connexion"]);
}
?>

