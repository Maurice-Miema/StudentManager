<?php
require_once __DIR__ . "/../../models/groupe/GetGroupe.php";

class GetGroupeController {
    public function getGroupeController() {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $groupe = new GetGroupe();
            $result = $groupe->getAllGroupes();

            if (isset($result["error"])) {
                echo json_encode(["message" => "Erreur de récupération", "error" => $result["error"]]);
                http_response_code(500);
            } else {
                echo json_encode($result);
                http_response_code(200);
            }
        } else {
            echo json_encode(["message" => "Méthode non autorisée"]);
            http_response_code(405);
        }
    }
}
?>