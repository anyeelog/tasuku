<?php

namespace Controllers;
use MVC\Router;
use Model\Project;
use Model\User;


class DashboardController {

  public static function index(Router $router) {

    session_start();
    isAuth();

    $id = $_SESSION['id'];
    $projects = Project::belongsTo('user_id', $id);

    $router->render('dashboard/index', [
      'title' => '| Dashboard',
      'projects' => $projects
    ]);

  }

  public static function create_project(Router $router) {
    session_start();
    isAuth();

    $alerts = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $project = new Project($_POST);

      // Validations
      $alerts = $project->validateProject();

      if(empty($alerts)) {
        // Generate unique URL
        $project->url = md5(uniqid());
        // Store the owner of the project
        $project->user_id = $_SESSION['id'];
        // Save
        $project->save();
        // Redirect to the newly created project
        header('Location: /project?id=' . $project->url);
      }
    }

    $router->render('dashboard/newproject', [
      'alerts' => $alerts,
      'title' => '| Create Project'
    ]);

  }

  public static function project(Router $router) {

    session_start();
    isAuth();

    $token = $_GET['id'];
    if(!$token) {
      header('Location: /dashboard');
    }

    // Check owner of the project
    $project = Project::where('url', $token);
    if($project->user_id !== $_SESSION['id']) {
      header('Location: /dashboard');
    }

    $router->render('dashboard/project', [
      'title' => '| ' . $project->project,
      'project' => $project->project,
      'description' => $project->description
    ]);

  }

  public static function profile(Router $router) {
    session_start();
    isAuth();

    $alerts = [];
    $user = User::find($_SESSION['id']);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      $user->sync($_POST);
      $alerts = $user->validateProfile();

      if(empty($alerts)) {
        // Save user
        $user->save();
      }
    }

    $router->render('dashboard/profile', [
      'title' => '| Profile',
      'user' => $user,
      'alerts' => $alerts
    ]);

  }

}
