<?php
require __DIR__ . '/../app/app.php';


use Controller\HomeController;
use Controller\AdminController;
use Controller\StudentController;
use Controller\TeacherController;
use MVC\Router;


$router = new Router();

$router->get('/', [HomeController::class, 'index']);

// STUDENT
$router->get('/student/login', [StudentController::class, 'login']);
$router->post('/student/login', [StudentController::class, 'login']);
// register
$router->get('/student/register', [StudentController::class, 'register']);
$router->post('/student/register', [StudentController::class, 'register']);
// confirm
$router->get('/student/message', [StudentController::class, 'message']);
$router->get('/student/confirm-account', [StudentController::class, 'confirm']);
// forget password
$router->get('/student/forget-password', [StudentController::class, 'forget']);
$router->post('/student/forget-password', [StudentController::class, 'forget']);
// recover
$router->get('/student/recover', [StudentController::class, 'recover']);
$router->post('/student/recover', [StudentController::class, 'recover']);

// AREA PRIVADA
$router->get('/student/dashboard', [StudentController::class, 'index']);
$router->get('/student/logout', [StudentController::class, 'logout']);


// Teacher
$router->get('/teacher/login', [TeacherController::class, 'login']);

$router->get('/admin/login', [AdminController::class, 'login']);
$router->post('/admin/login', [AdminController::class, 'login']);
$router->get('/admin/logout', [AdminController::class, 'logout']);


// AREA PRIVADA
$router->get('/admin/dashboard', [AdminController::class, 'index']);


$router->checkRoutes();