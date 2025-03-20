<?php
// Importer les fichiers et récupérer les routes
$studentRoutes = require __DIR__ . "/StudentRoutes.php";
$authRoutes = require __DIR__ . "/auth/AuthRoute.php";
$teacherRoads = require __DIR__ . "/TeacherRoads.php";

// Fusionner toutes les routes
$routes = array_merge($studentRoutes, $authRoutes, $teacherRoads);

// Fonction pour gérer les requêtes
function handleRequest($uri, $method, $routes) {
    if (isset($routes[$uri]) && isset($routes[$uri][$method])) {
        $routes[$uri][$method]();
    } else {
        echo json_encode(["message" => "Route non trouvée"]);
        http_response_code(404);
        exit;
    }
}

// Récupérer l'URI et la méthode HTTP
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Gérer la requête avec les routes fusionnées
handleRequest($uri, $method, $routes);
