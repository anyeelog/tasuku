<?php

namespace Model;

class Task extends ActiveRecord {

  protected static $table = 'tasks';
  protected static $columnsDB = ['id', 'name', 'description', 'status', 'project_id'];

  public $id;
  public $name;
  public $description;
  public $status;
  public $project_id;

  public function __construct($args = []) {

    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->status = $args['status'] ?? 0;
    $this->project_id = $args['project_id'] ?? '';

  }

}
