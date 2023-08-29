<?php

function debuguear($var) : string {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function san($html) : string {
    $san = htmlspecialchars($html);
    return $san;
}

// Función que revisa que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}