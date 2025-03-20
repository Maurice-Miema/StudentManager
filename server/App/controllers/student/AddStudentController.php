<?php
    require_once __DIR__ . "/../../models/student/AddStudent.php";

    class AddStudentController {
        public function store() {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $data = json_decode(file_get_contents("php://input"), true);
                
                // Vérification des données requises
                if (!isset($data["nom"], $data["postnom"], $data["matricule"], $data["password"], $data["role"], $data["promotion"], $data["annee_academique"])) {
                    echo json_encode(["message" => "Données incomplètes"]);
                    http_response_code(400);
                    exit();
                }

                $student = new AddStudentModel();
                $result = $student->addStudent(
                    $data["nom"],
                    $data["postnom"],
                    $data["matricule"],
                    $data["password"],
                    $data["role"],
                    $data["promotion"],
                    $data["annee_academique"]
                );

                if ($result === true) {
                    echo json_encode(["message" => "Utilisateur ajouté avec succès"]);
                    http_response_code(200);
                } else {
                    echo json_encode(["message" => "Échec de l'ajout", "error" => $result["error"]]);
                    http_response_code(500);
                }
            }
        }
    }
?>

