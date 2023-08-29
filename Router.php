<?php

namespace MVC;

use function App\isAuth;

class Router 
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function checkRoutes()
    {

        // almacena la ruta solicitada
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ( $fn ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            header('/');
            $this->render('include/404',[
                'titulo' => 'Error',
                'mensaje' => 'Oops! La ruta fue no encontrada.'
            ]);
        }
    }

    public function render($view, $datos = [])
    {
        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  
            // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, 
            // pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); //  inicia el buffer de salida en PHP

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/resources/views/$view.php";
        $contenido = ob_get_clean(); //  detiene el almacenamiento en el buffer y recupera su contenido
        include_once __DIR__ . '/resources/views/layout.php';
    }

    public function renderAdmin($view, $datos = [])
    {
        // Leer los datos que se pasan a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  
        }
    
        ob_start();
    
        // Incluir la vista en el diseño del panel de administración
        include_once __DIR__ . "/resources/views/auth/admin/$view.php";
        $contenido = ob_get_clean(); //  detiene el almacenamiento en el buffer y recupera su contenido
        
        if(!isset($_SESSION['login'])) {
            header('Location: /');
        } else {
            include_once __DIR__ . '/resources/views/auth/layout-auth.php';
        }
        
    }

}