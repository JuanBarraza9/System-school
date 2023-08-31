<?php 

namespace Controller;

use MVC\Router;
use Model\Admin;

use function App\debuguear;

class AdminController {

    //* iniciar sesion
    public static function login(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // autenticar
            $admin = new Admin($_POST);
            $alertas = $admin->validarLogin();

            if(empty($alertas)) {
                // Comprobar que exista el usuario
                $usuario = Admin::where('username', $admin->username);
                
                if($usuario) {
                    if($admin->contraseña === $usuario->contraseña){
                        // Autenticar el usuario
                        session_start();

                        // Configura el tiempo de expiración en segundos (por ejemplo, 30 minutos)
                        $tiempoExpiracion = 3600; // 1 hora
                        session_set_cookie_params($tiempoExpiracion);
                        session_cache_expire($tiempoExpiracion);
                        session_set_cookie_params($tiempoExpiracion);
                        
                        // Establece el tiempo de vida de la sesión en segundos
                        ini_set('session.gc_maxlifetime', $tiempoExpiracion);

                        $_SESSION['cod_Admin'] = $usuario->cod_Admin;
                        $_SESSION['username'] = $usuario->username;
                        $_SESSION['login'] = true;

                        // Redireccionamiento
                        header('Location: /admin/dashboard');

                        
                    } else {
                        Admin::setAlerta('error', 'Contrseña incorrecta');
                    }
                    
                } else {
                    Admin::setAlerta('error', 'El Usuario no existe!');
                }

            }
        }

        $alertas = Admin::getAlertas();

        // Render a la vista
        $router->render('auth/login', [
            'user' => 'Administrador',
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }


    public static function index(Router $router) {
        session_start();
        
        $router->renderAuth('admin/dashboard', [
            'user' => 'Admin',
            'username' => $_SESSION['username'],
        ]);
    }


}