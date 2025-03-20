<?php
require_once __DIR__ . "/../App/controllers/groupe/AddGroupeController.php";

// Retourner les routes au lieu de les exécuter immédiatement
return [
    "/add-Groupe" => [
        "POST" => function() {
            $controller = new AddGroupeController();
            $controller->addgroupecontroller();
            exit;
        }
    ],
];
