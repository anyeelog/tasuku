<?php

namespace Controllers;
use MVC\Router;
use Model\User;

class LoginController {

  public static function login(Router $router) {

    if([$_SERVER['REQUEST_METHOD'] === 'POST']) {

    }

    $router->render('auth/login', [
      'title' => '| Login'
    ]);

  }

  public static function logout() {


  }

  public static function signup(Router $router) {

    $alerts = [];
    $user = new User;

    if([$_SERVER['REQUEST_METHOD'] === 'POST']) {
      $user->sync($_POST);
      $alerts = $user->validate();
    }

    $router->render('auth/signup', [
      'title' => '| Signup',
      'user' => $user,
      'alerts' => $alerts
    ]);

  }

  public static function forgotPassword(Router $router) {

    if([$_SERVER['REQUEST_METHOD'] === 'POST']) {

    }

    $router->render('auth/forgotpassword', [
      'title' => '| Forgot password'
    ]);

  }

  public static function restorePassword(Router $router) {

    if([$_SERVER['REQUEST_METHOD'] === 'POST']) {

    }

    $router->render('auth/restorepassword', [
      'title' => '| Restore password'
    ]);

  }

  public static function message(Router $router) {

    $router->render('auth/message', [
      'title' => '| Account created'
    ]);

  }

  public static function verified(Router $router) {

    $router->render('auth/verified', [
      'title' => '| Account verified'
    ]);

  }

}
