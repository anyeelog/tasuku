<?php

namespace Model;

class Task extends ActiveRecord {

  protected static $table = 'tasks';
  protected static $columnsDB = ['id', 'name', 'status', 'project_id'];

  public $id;
  public $name;
  public $status;
  public $project_id;

  public function __construct($args = []) {

    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->status = $args['status'] ?? 0;
    $this->project_id = $args['project_id'] ?? '';

  }

}
