<?php
require_once __DIR__ . "/../../models/teacher/ListTeacher.php";

class ListTeacherController {
    public function listTeacher() {
        if ($_SERVER["REQUEST_METHOD"] !== "GET") {
            echo json_encode(["message" => "Méthode non autorisée"]);
            http_response_code(405); // 405 = Method Not Allowed
            exit();
        }

        $teacher = new ListTeacher();
        $result = $teacher->getTeacher();

        if ($result !== false) {
            echo json_encode($result);
            http_response_code(200);
        } else {
            echo json_encode(["message" => "Aucun professeur trouvé"]);
            http_response_code(404);
        }
    }
}
?>
