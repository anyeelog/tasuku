<?php

namespace Model;

class Project extends ActiveRecord {

  protected static $table = 'projects';
  protected static $columnsDB = ['id', 'project', 'description', 'url', 'user_id'];

  public $id;
  public $project;
  public $description;
  public $url;
  public $user_id;

  public function __construct($arr = []) {
    $this->id = $arr['id'] ?? null;
    $this->project = $arr['project'] ?? '';
    $this->description = $arr['description'] ?? '';
    $this->url = $arr['url'] ?? '';
    $this->user_id = $arr['user_id'] ?? '';
  }

  public function validateProject() {
    if(!$this->project) {
      self::$alerts['error'][] = 'Name of the project is required';
    }
    return self::$alerts;
  }

}
