<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'juan', '', 'system_school');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}