<?php
    require_once __DIR__ . "/../App/controllers/teacher/AddTeacherController.php";
    require_once __DIR__ . "/../App/controllers/teacher/DeleteTeacherController.php";

    return [
        "/add-teacher" => [
            "POST" => function() {
                $controller = new AddTeacherController();
                $controller->teacher();
                exit;
            }
        ],
        "/delete-teacher" => [
            "DELETE" => function() {
                $controllerDelete = new DeleteTeacherController();
                $controllerDelete->delete();
                exit;
            }
        ]
    ];
?>