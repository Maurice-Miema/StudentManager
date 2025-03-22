<?php
require_once __DIR__ . "/../App/controllers/notes/AddNoteController.php";
require_once __DIR__ . "/../App/controllers/notes/GetNoteController.php";
require_once __DIR__ . "/../App/controllers/notes/DeleteNoteController.php";


// Retourner les routes au lieu de les exécuter immédiatement
return [
    "/add-note" => [
        "POST" => function() {
            $controller = new AddNoteController();
            $controller->addnotecontroller();
            exit;
        }
    ],
    "/get-note" => [
        "GET" => function() {
            $controller = new GetNoteController();
            $controller->getNotesByStudent();
            exit;
        }
    ],
    "/delete-note" => [
        "DELETE" => function() {
            $controller = new DeleteNoteController();
            $controller->delete();
            exit;
        }
    ]
];
