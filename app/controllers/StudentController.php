<?php 

namespace Controller;

use MVC\Router;

class StudentController {

    public static function login(Router $router)
    {

        $router->render('/auth/login', [
            'titulo' => 'Iniciar Sesión',
            'user' => 'Estudiante'
        ]);
    }
}