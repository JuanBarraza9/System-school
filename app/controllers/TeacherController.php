<?php 

namespace Controller;

use MVC\Router;

class TeacherController {

    public static function login(Router $router)
    {

        $router->render('auth/login', [
            'user' => 'Docente',
            'titulo' => 'Iniciar Sesión',
            'user' => 'Docente'
        ]);
    }
}