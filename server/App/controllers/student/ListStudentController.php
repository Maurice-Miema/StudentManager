<?php
    require_once __DIR__ . "/../../models/student/ListStudent.php";

    class ListStudentController {
        public function listStudent() {
            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                $teacher = new ListStudent();
                $result = $teacher->getStudent();

                if ($result !== false) {
                    echo json_encode($result);
                    http_response_code(200);
                } else {
                    echo json_encode(["message" => "Aucun professeur trouvé"]);
                    http_response_code(404);
                }
            }
        }
    }
?>
