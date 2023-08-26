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

$router->get('/teacher/login', [TeacherController::class, 'login']);

$router->get('/admin/login', [AdminController::class, 'login']);
$router->post('/admin/login', [AdminController::class, 'login']);

// auth panel

$router->checkRoutes();