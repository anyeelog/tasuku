<?php

namespace Controllers;
use Model\Project;
use Model\Task;

class TaskController {

  public static function index() {

    $projectId = $_GET['id'];

    if(!$projectId) {
      header('Location: /dashboard');
    }

    $project = Project::where('url', $projectId);
    session_start();
    if(!$project || $project->user_id !== $_SESSION['id']) {
      header('Location: /404');
    }

    $tasks = Task::belongsTo('project_id', $project->id);

    echo json_encode(['tasks' => $tasks]);

  }

  public static function create() {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      session_start();

      // Checks if project exists
      $project = Project::where('url', $_POST['project_id']);

      if(!$project || $project->user_id !== $_SESSION['id']) {
        $response = [
          'type' => 'error',
          'message' => 'There was an error while creating the task.'
        ];
        echo json_encode($response);
        return;
      }

      // If everything is correct, create task
      $task = new Task($_POST);
      $task->project_id = $project->id;
      $result = $task->save();

      $response = [
        'type' => 'success',
        'id' => $result['id'],
        'message' => 'Task created correctly',
        'project_id' => $project->id
      ];

      echo json_encode($response);
    }

  }

  public static function update() {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      session_start();

      // Checks if project exists
      $project = Project::where('url', $_POST['url']);

      if(!$project || $project->user_id !== $_SESSION['id']) {
        $response = [
          'type' => 'error',
          'message' => 'There was an error while updating the task.'
        ];
        echo json_encode($response);
        return;
      }

      // If everything is correct, updates task
      $task = new Task($_POST);
      $task->project_id = $project->id;
      $result = $task->save();

      if($result) {

        $response = [
          'type' => 'success',
          'id' => $task->id,
          'project_id' => $project->id
        ];

        echo json_encode(['response' => $response]);

      }

    }

  }

  public static function delete() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      session_start();

      // Checks if project exists
      $project = Project::where('url', $_POST['url']);

      if(!$project || $project->user_id !== $_SESSION['id']) {
        $response = [
          'type' => 'error',
          'message' => 'There was an error while updating the task.'
        ];
        echo json_encode($response);
        return;
      }

      $task = new Task($_POST);
      $result = $task->delete();

      echo json_encode(['result' => $result]);

    }
  }

}
