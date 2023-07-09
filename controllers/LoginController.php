<?php

namespace Controllers;
use MVC\Router;
use Model\User;
use Classes\Email;

class LoginController {

  public static function login(Router $router) {

    $alerts = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new User($_POST);
      $alerts = $auth->validateLogin();

      if(empty($alerts)) {
        // Verifies if user exists
        $user = User::where('email', $auth->email);

        if(!$user) {
          User::setAlert('error', 'User does not exist.');
        } else if (!$user->verified) {
          User::setAlert('error', 'User not verified. Check your email inbox.');
        } else {
          // User exists and it's verified
          if(password_verify($_POST['password'], $user->password)) {
            // Logging user
            session_start();
            $_SESSION['id'] = $user->id;
            $_SESSION['name'] = $user->name;
            $_SESSION['email'] = $user->email;
            $_SESSION['login'] = true;
            debug($_SESSION);
            // Redirect
            header('Location: /home');
          } else {
            User::setAlert('error', 'Incorrect password.');
          }
        }
      }
    }

    $alerts = User::getAlerts();

    $router->render('auth/login', [
      'title' => '| Login',
      'alerts' => $alerts
    ]);

  }

  public static function logout() {


  }

  public static function signup(Router $router) {

    $alerts = [];
    $user = new User;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user->sync($_POST);
      $alerts = $user->validate();

      if(empty($alerts)) {
        $userExists = User::where('email', $user->email);

        if($userExists) {
          User::setAlert('error', 'User is already registered.');
          $alerts = User::getAlerts();
        } else {
          // Hashes password
          $user->hashPassword();
          // Deletes password repeat
          unset($user->passwordrepeat);
          // Generates token
          $user->createToken();
          // Creates new user
          $result = $user->save();

          // Send confirmation email
          $email = new Email($user->email, $user->name, $user->token);
          $email->sendConfirmation();

          if($result) {
            header('Location: /message');
          }
        }
      }
    }

    $router->render('auth/signup', [
      'title' => '| Signup',
      'user' => $user,
      'alerts' => $alerts
    ]);

  }

  public static function forgotPassword(Router $router) {

    $alerts = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user = new User($_POST);
      $alerts = $user->validateEmail();

      if(empty($alerts)) {
        $user = User::where('email', $user->email);

        if($user && $user->verified) {
          // Generates new token
          $user->createToken();
          unset($user->passwordrepeat);

          // Updates user
          $user->save();

          // Sends email
          $email = new Email($user->email, $user->name, $user->token);
          $email->sendInstructions();

          // Success alert
          User::setAlert('success', 'Email was sent correctly.');

        } else {
          User::setAlert('error', 'User does not exist.');
        }
      }
    }

    $alerts = User::getAlerts();

    $router->render('auth/forgotpassword', [
      'title' => '| Forgot password',
      'alerts' => $alerts
    ]);

  }

  public static function restorePassword(Router $router) {

    $token = s($_GET['token']);
    $show = true;

    if(!$token) {
      header('Location: /');
    }

    // Looks for user with that token
    $user = User::where('token', $token);

    if(empty($user)) {
      User::setAlert('errordiv', 'Invalid token.');
      $show = false;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user->sync($_POST);
      $alerts = $user->validatePassword();

      if(empty($alerts)) {
        // Hash new password
        $user->hashPassword();
        // Remove token and repeat password
        unset($user->token);
        // Save new information
        $result = $user->save();
        // Redirect
        if($result) {
          header('Location: /');
        }
      }
    }

    $alerts = User::getAlerts();

    $router->render('auth/restorepassword', [
      'title' => '| Restore password',
      'alerts' => $alerts,
      'show' => $show
    ]);

  }

  public static function message(Router $router) {

    $router->render('auth/message', [
      'title' => '| Account created'
    ]);

  }

  public static function verified(Router $router) {

    $token = s($_GET['token']);

    if(!$token) {
      header('Location: /');
    }

    // Find user with same token
    $user = User::where('token', $token);

    if(empty($user)) {
      // User not found
      User::setAlert('error', 'Invalid token');
    } else {
      // Verify user
      $user->verified = 1;
      unset($user->token);
      unset($user->passwordrepeat);

      $user->save();
    }
    $alerts = User::getAlerts();


    $router->render('auth/verified', [
      'title' => '| Account verified',
      'alerts' => $alerts
    ]);

  }

}
