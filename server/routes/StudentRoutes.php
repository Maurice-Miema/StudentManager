<?php
require_once __DIR__ . "/../App/controllers/student/AddStudentController.php";
require_once __DIR__ . "/../App/controllers/student/UpdateStudentController.php";
require_once __DIR__ . "/../App/controllers/student/DeleteStudentController.php";
require_once __DIR__ . "/../App/controllers/student/StudentGroupController.php";
require_once __DIR__ . "/../App/controllers/student/ListStudentController.php";


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
    ],
    "/student-group" => [
        "POST" => function() {
            $controller = new StudentGroupeController();
            $controller->studentgroupecontroller();
            exit;
        }
    ],
    "/list-student" => [
        "GET" => function() {
            $controller = new ListStudentController();
            $controller->listStudent();
            exit;
        }
    ],
];
