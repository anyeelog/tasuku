<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\DashboardController;
use Controllers\TaskController;

$router = new Router();


// Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Create account
$router->get('/signup', [LoginController::class, 'signup']);
$router->post('/signup', [LoginController::class, 'signup']);

// Forgot password
$router->get('/forgotpassword', [LoginController::class, 'forgotPassword']);
$router->post('/forgotpassword', [LoginController::class, 'forgotPassword']);

// Creating a new password
$router->get('/restorepassword', [LoginController::class, 'restorePassword']);
$router->post('/restorepassword', [LoginController::class, 'restorePassword']);

// Creating account
$router->get('/message', [LoginController::class, 'message']);
$router->get('/verified', [LoginController::class, 'verified']);

// Personal Dashboard
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/newproject', [DashboardController::class, 'create_project']);
$router->post('/newproject', [DashboardController::class, 'create_project']);
$router->get('/project', [DashboardController::class, 'project']);
$router->get('/profile', [DashboardController::class, 'profile']);
$router->post('/profile', [DashboardController::class, 'profile']);

// API for Tasks
$router->get('/api/tasks', [TaskController::class, 'index']);
$router->post('/api/task', [TaskController::class, 'create']);
$router->post('/api/task/update', [TaskController::class, 'update']);
$router->post('/api/task/delete', [TaskController::class, 'delete']);




// Checks and validates routes, asigns Controller functions if they exist
$router->testRoutes();
