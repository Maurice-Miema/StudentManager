<?php
    return [
        'secret_key' => 'mau159rice987456miema951#$@%^dfdg45613', // Remplace par une clé secrète forte
        'algorithm' => 'HS256', // Algorithme utilisé pour signer le token
        'issuer' => 'http://localhost:8000', // Le domaine ou l’application qui émet le token
        'audience' => 'http://localhost:8000', // Destinataire du token
        'expiration_time' => 3600 // Durée de validité du token en secondes (1 heure)
    ];
?>
