<?php
    require_once __DIR__ . "/../App/controllers/teacher/AddTeacherController.php";

    return [
        "/add-teacher" => [
            "POST" => function() {
                $controller = new AddTeacherController();
                $controller->teacher();
                exit;
            }
        ],
    ]
?>