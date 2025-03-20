<?php
require_once __DIR__ . "/../../App/controllers/auth/AuthController.php";

// Retourner les routes au lieu de les exécuter immédiatement
return [
    "/login" => [
        "POST" => function() {
            $controller = new AuthController();
            $controller->login();
            exit;
        }
    ],
];
