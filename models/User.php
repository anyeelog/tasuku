<?php

namespace Model;

class User extends ActiveRecord {

  protected static $table = 'users';
  protected static $columnsDB = ['id', 'name', 'email', 'password', 'token', 'verified'];

  public $id;
  public $name;
  public $email;
  public $password;
  public $passwordrepeat;
  public $token;
  public $verified;

  public function __construct($arr = []) {

    $this->id = $arr['id'] ?? null;
    $this->name = $arr['name'] ?? '';
    $this->email = $arr['email'] ?? '';
    $this->password = $arr['password'] ?? '';
    $this->passwordrepeat = $arr['passwordrepeat'] ?? '';
    $this->token = $arr['token'] ?? '';
    $this->verified = $arr['verified'] ?? '';

  }

  public function validate() {

    if(!$this->name) {
      self::$alerts['error'][] = 'Name is required.';
    }
    if(!$this->email) {
      self::$alerts['error'][] = 'Email is required.';
    }
    if(!$this->password) {
      self::$alerts['error'][] = 'Password is required.';
    }
    if(strlen($this->password) < 6) {
      self::$alerts['error'][] = 'Password must contain at least 6 characters.';
    }
    if($this->password !== $this->passwordrepeat) {
      self::$alerts['error'][] = 'Passwords do not match.';
    }

    return self::$alerts;

  }

}
