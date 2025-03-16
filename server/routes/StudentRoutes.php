<?php
    require_once __DIR__ . "/../App/controllers/student/AddStudentController.php";

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    if ($uri === "/add-student" && $method === "POST") {
        $controller = new AddStudentController();
        $controller->store();
    } else {
        echo json_encode(["message" => "Route non trouvée"]);
        http_response_code(404);
    }
?>