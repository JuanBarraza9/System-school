<?php 

namespace Controller;

use MVC\Router;
use Model\Alumno;
use Classes\Email;

class StudentController {

    public static function login(Router $router)
    {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // autenticar
            $alumno = new Alumno($_POST);
            $alertas = $alumno->validarLogin();

            if(empty($alertas)) {
                // Comprobar que exista el usuario
                $usuario = Alumno::where('email', $alumno->email);
                
                if($usuario) {
                    if($usuario->comprobarPasswordAndVerificado($alumno->password)){
                        // Autenticar el usuario
                        session_start();

                        // Configura el tiempo de expiración en segundos (por ejemplo, 30 minutos)
                        $tiempoExpiracion = 7200; // 1 hora
                        session_set_cookie_params($tiempoExpiracion);
                        session_cache_expire($tiempoExpiracion);
                        session_set_cookie_params($tiempoExpiracion);
                        
                        // Establece el tiempo de vida de la sesión en segundos
                        ini_set('session.gc_maxlifetime', $tiempoExpiracion);

                        $_SESSION['cod_Alumno'] = $usuario->cod_Alumno;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['login'] = true;

                        // Redireccionamiento
                        header('Location: /student/dashboard');

                        
                    } else {
                        Alumno::setAlerta('error', 'Contrseña incorrecta');
                    }
                    
                } else {
                    Alumno::setAlerta('error', 'El Usuario no existe!');
                }

            }
        }

        $alertas = Alumno::getAlertas();

        $router->render('/auth/login', [
            'user' => 'Estudiante',
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
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

    public static function forget(Router $router) {
        
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alumno = new Alumno($_POST);
            $alertas = $alumno->validarEmail();

            if(empty($alertas)) {
                 $usuario = Alumno::where('email', $alumno->email);

                 if($usuario && $usuario->confirmado === "1") {
                        
                    // Generar un token
                    $usuario->crearToken();
                    $usuario->guardarAlumno();

                    //  Enviar el email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarInstrucciones();

                    // Alerta de exito
                    Alumno::setAlerta('exito', 'Revisa tu email');
                 } else {
                    Alumno::setAlerta('error', 'El Usuario no existe o no está confirmado');
                     
                 }
            } 
        }

        $alertas = Alumno::getAlertas();

        $router->render('auth/student/forget-password', [
            'user' => 'Estudiante',
            'titulo' => 'Recuperar contrseña',
            'alertas' => $alertas
        ]);
        
    }

    public static function recover(Router $router) {

        $alertas = [];
        $error = false;

        $token = san($_GET['token']);

        // Buscar usuario por su token
        $usuario = Alumno::where('token', $token);

        if(empty($usuario)) {
            Alumno::setAlerta('error', 'Token No Válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer el nuevo password y guardarlo
            $password = new Alumno($_POST);
            $alertas = $password->validarPasswordRecovery();

            if(empty($alertas)) {
                $usuario->password = null;

                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardarAlumno();
                if($resultado) {
                    header('Location: /');
                }
            }
        }

        $alertas = Alumno::getAlertas();

        $router->render('auth/student/recover', [
            'user' => 'Estudiante',
            'titulo' => 'Nueva contraseña',
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    // AREA PRIVADA METHODS
    public static function index(Router $router) {
        session_start();
        

        $router->renderAuth('student/dashboard', [
            'user' => 'student',
            'nombre' => $_SESSION['nombre'],
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }


}