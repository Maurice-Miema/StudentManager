<?php

    // Vérifier le bon chemin du fichier DataBase.php
    $databaseFile = realpath(__DIR__ . "/../App/config/DataBase.php");

    if (!$databaseFile) {
        die("Erreur : Impossible de trouver le fichier DataBase.php. Vérifie le chemin.");
    }

    require_once $databaseFile;

    try {
        // Créer une instance de la classe Database
        $database = new Database();
        
        // Obtenir la connexion
        $conn = $database->getConnection();
        
        if ($conn) {
            echo "✅ Connexion réussie à la base de données !";
        } else {
            echo "Connexion échouée.";
        }
    } catch (Exception $e) {
        echo " Erreur : " . $e->getMessage();
    }
?>
