<?php 

namespace Controllers;

use MVC\Router;

class TeacherController {

    public static function login(Router $router)
    {

        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'user' => 'Maestro'
        ]);
    }
}