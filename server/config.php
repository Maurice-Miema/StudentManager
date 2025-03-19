<?php
function loadEnv($path) {
    if (!file_exists($path)) {
        die("Le fichier .env est introuvable : " . $path);
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, '"');
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
}

// Charger .env avec un chemin absolu
loadEnv(__DIR__ . "/.env");
