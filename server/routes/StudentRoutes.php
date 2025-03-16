<?php
    require_once __DIR__ . "/../App/controllers/student/AddStudentController.php";
    require_once __DIR__ . "/../App/controllers/student/UpdateStudentController.php";

    // Fonction pour gérer les routes
    function handleRequest($uri, $method) {
        $routes = [
            // Route pour ajouter un étudiant
            "/add-student" => [
                "POST" => function() {
                    $controller = new AddStudentController();
                    $controller->store();
                }
            ],
            // Route pour mettre à jour un étudiant
            "/update-student" => [
                "PUT" => function() {
                    $controllerUpdate = new UpdateStudentController();
                    $controllerUpdate->store();
                }
            ]
        ];

        // Vérification si la route existe
        if (isset($routes[$uri]) && isset($routes[$uri][$method])) {
            // Exécution de la fonction correspondante
            $routes[$uri][$method]();
        } else {
            // Gestion de l'erreur si la route n'est pas trouvée
            echo json_encode(["message" => "Route non trouvée"]);
            http_response_code(404);
        }
    }

    // Récupération de l'URI et de la méthode HTTP
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    // Gestion de la requête
    handleRequest($uri, $method);
?>
