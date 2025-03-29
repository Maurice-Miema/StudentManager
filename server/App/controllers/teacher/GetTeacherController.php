<?php
    require_once __DIR__ . "/../../models/teacher/GetTeacher.php";

    class GetTeacherController {
        public function getTeacherContro() {
            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                if (!isset($_GET["id_professeur"])) {
                    echo json_encode(["message" => "Données incomplètes"]);
                    http_response_code(400);
                    exit();
                }

                $id_professeur = $_GET["id_professeur"];
                $teacher = new GetTeacher();
                $result = $teacher->getTeacher($id_professeur);

                if (isset($result["error"])) {
                    echo json_encode(["message" => "Échec de la récupération", "error" => $result["error"]]);
                    http_response_code(500);
                } else {
                    echo json_encode($result);
                    http_response_code(200);
                }
                exit(); // Arrête l'exécution du script après la réponse
            }
        }
    }
?>
