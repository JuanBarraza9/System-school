<?php 

namespace Controllers;

use MVC\Router;

class AdminController {

    public static function login(Router $router)
    {

        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'user' => 'Administrador'
        ]);
    }
}