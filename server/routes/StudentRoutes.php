<?php
require_once __DIR__ . "/../App/controllers/student/AddStudentController.php";
require_once __DIR__ . "/../App/controllers/student/UpdateStudentController.php";
require_once __DIR__ . "/../App/controllers/student/DeleteStudentController.php";

// Retourner les routes au lieu de les exécuter immédiatement
return [
    "/add-student" => [
        "POST" => function() {
            $controller = new AddStudentController();
            $controller->store();
            exit;
        }
    ],
    "/update-student" => [
        "PUT" => function() {
            $controllerUpdate = new UpdateStudentController();
            $controllerUpdate->store();
            exit;
        }
    ],
    "/delete-student" => [
        "DELETE" => function() {
            $controllerDelete = new DeleteStudentController();
            $controllerDelete->delete();
            exit;
        }
    ]
];
