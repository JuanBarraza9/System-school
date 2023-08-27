<?php 

namespace Controller;

use MVC\Router;

class StudentController {

    public static function login(Router $router)
    {

        $router->render('/auth/login', [
            'user' => 'Estudiante',
            'titulo' => 'Iniciar Sesión',
            'user' => 'Estudiante'
        ]);
    }
}