<?php
require __DIR__ . '/../app/app.php';


use Controller\HomeController;
use Controller\AdminController;
use Controller\StudentController;
use Controller\TeacherController;
use MVC\Router;


$router = new Router();

$router->get('/', [HomeController::class, 'index']);

// login
$router->get('/student/login', [StudentController::class, 'login']);
$router->get('/student/register', [StudentController::class, 'register']);
$router->post('/student/register', [StudentController::class, 'register']);
// confirm
$router->get('/student/message', [StudentController::class, 'message']);
$router->get('/student/confirm-account', [StudentController::class, 'confirm']);


$router->get('/teacher/login', [TeacherController::class, 'login']);

$router->get('/admin/login', [AdminController::class, 'login']);
$router->post('/admin/login', [AdminController::class, 'login']);
$router->get('/admin/logout', [AdminController::class, 'logout']);


// AREA PRIVADA
$router->get('/admin/dashboard', [AdminController::class, 'index']);


$router->checkRoutes();