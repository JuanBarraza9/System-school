<?php 

namespace Controllers;

use MVC\Router;

class HomeController {

    public static function index(Router $router)
    {

        $router->render('welcome', [
            'titulo' => 'Home',
        ]);
    }
}