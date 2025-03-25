<?php
require_once __DIR__ . "/../App/controllers/groupe/AddGroupeController.php";
require_once __DIR__ . "/../App/controllers/groupe/UpdateGroupeController.php";
require_once __DIR__ . "/../App/controllers/groupe/DeleteGroupeController.php";
require_once __DIR__ . "/../App/controllers/groupe/GetGroupeController.php";

// Retourner les routes au lieu de les exécuter immédiatement
return [
    "/add-groupe" => [
        "POST" => function() {
            $controller = new AddGroupeController();
            $controller->addgroupecontroller();
            exit;
        }
    ],
    "/update-groupe" => [
        "PUT" => function() {
            $controller = new UpdateGroupeController();
            $controller->updateGroupeController();
            exit;
        }
    ],
    "/delete-groupe" => [
        "DELETE" => function() {
            $controller = new DeleteGroupeController();
            $controller->deleteGroupeController();
            exit;
        }
    ],
    "/get-groupe" => [
        "GET" => function() {
            $controller = new GetGroupeController();
            $controller->getGroupeController();
            exit;
        }
    ],
];
