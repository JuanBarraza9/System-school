<?php 

namespace Controller;

use MVC\Router;
use Model\Alumno;
use Classes\Email;

class StudentController {

    public static function login(Router $router)
    {

        $router->render('/auth/login', [
            'user' => 'Estudiante',
            'titulo' => 'Iniciar Sesión',
            'user' => 'Estudiante'
        ]);
    }

    public static function register(Router $router)
    {
        $usuario = new Alumno;

        // Alertas vacias
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar(array_map('trim', $_POST));
            $alertas = $usuario->validarNuevaCuenta();

            // Revisar que alerta este vacio
            if(empty($alertas)) {
                // Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();


                if($resultado->num_rows) {
                    $alertas = Alumno::getAlertas();
                } else {
                    // Hashear el Password
                    $usuario->hashPassword();

                    // Generar un Token único
                    $usuario->crearToken();
                    
                    // Enviar el Email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarConfirmacion();
                    
                    // Crear el usuario
                    $resultado = $usuario->guardarAlumno();
                    
                    if($resultado) {
                        header('Location: /student/message');
                    }
                }
            }
        }

        $router->render('/auth/register', [
            'user' => 'Estudiante',
            'titulo' => 'Registro',
            'user' => 'Estudiante',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }


    public static function message(Router $router) {
        $router->render('auth/student/message', [
            'titulo' => 'Instrucciones'
        ]);
    }

    public static function confirm(Router $router) {
        $alertas = [];
        $token = san($_GET['token']);
        $usuario = Alumno::where('token', trim($token));

        if(empty($usuario)) {
            // Mostrar mensaje de error
            Alumno::setAlerta('error', 'Token No Válido');
        } else {
            // Modificar a usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardarAlumno();

            Alumno::setAlerta('exito', 'Su cuenta se confirmó correctamente!');
        }
       
        // Obtener alertas
        $alertas = Alumno::getAlertas();

        // Renderizar la vista
        $router->render('auth/student/confirm-account', [
            'alertas' => $alertas
        ]);
    }
}