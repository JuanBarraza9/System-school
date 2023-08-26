<?php 

namespace Controller;

use MVC\Router;
use Model\Admin;

class AdminController {

    //* iniciar sesion
    public static function login(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // autenticar
            $admin = new Admin($_POST);
        }

        // Render a la vista
        $router->render('auth/login', [
            // Titulo dinamico
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }



}