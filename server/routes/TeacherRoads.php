<?php
    require_once __DIR__ . "/../App/controllers/teacher/AddTeacherController.php";
    require_once __DIR__ . "/../App/controllers/teacher/DeleteTeacherController.php";
    require_once __DIR__ . "/../App/controllers/teacher/UpdateTeacherController.php";
    require_once __DIR__ . "/../App/controllers/teacher/ListTeacherController.php";

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
        ],
        "/update-teacher" => [
            "PUT" => function() {
                $controllerUpdate = new UpdateTeacherController();
                $controllerUpdate->store();
                exit;
            }
        ],
        "/list-teacher" => [ // 🔹 Route pour lister les professeurs
            "GET" => function() {
                $controllerList = new ListTeacherController();
                $controllerList->listTeacher(); // Appel de la méthode pour lister les professeurs
                exit;
            }
        ]
    ];
?>