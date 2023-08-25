<?php
require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . '/../app/app.php';

use MVC\Router;
use Controllers\HomeController;
use Controllers\AdminController;
use Controllers\StudentController;
use Controllers\TeacherController;


$router = new Router();

$router->get('/', [HomeController::class, 'index']);

// login
$router->get('/student/login', [StudentController::class, 'login']);
$router->get('/teacher/login', [TeacherController::class, 'login']);
$router->get('/admin/login', [AdminController::class, 'login']);

// auth panel

$router->checkRoutes();