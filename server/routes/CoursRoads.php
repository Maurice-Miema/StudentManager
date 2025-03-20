<?php
require_once __DIR__ . "/../App/controllers/cours/AddCourController.php";

// Retourner les routes au lieu de les exécuter immédiatement
return [
    "/add-cours" => [
        "POST" => function() {
            $controller = new AddCoursController();
            $controller->addcourscontroller();
            exit;
        }
    ],
];
