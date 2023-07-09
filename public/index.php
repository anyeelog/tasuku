<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
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




// Checks and validates routes, asigns Controller functions if they exist
$router->testRoutes();
