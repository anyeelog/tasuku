<?php

namespace Controllers;
use Model\Project;
use Model\Task;

class TaskController {

  public static function index() {

  }

  public static function create() {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      session_start();
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
        'message' => 'Task created correctly'
      ];

      echo json_encode($response);
    }

  }

  public static function update() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

    }
  }

  public static function delete() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

    }
  }

}
