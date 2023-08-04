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
    $this->verified = $arr['verified'] ?? 0;

  }

  // Validates signup
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

  // Validates login
  public function validateLogin() {

    if(!$this->email) {
      self::$alerts['error'][] = 'Email is required.';
    }
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      self::$alerts['error'][] = 'Invalid email.';
    }
    if(!$this->password) {
      self::$alerts['error'][] = 'Password is required.';
    }
    return self::$alerts;

  }

  // Validates email
  public function validateEmail() {
    if(!$this->email) {
      self::$alerts['error'][] = 'Email is required.';
    }
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      self::$alerts['error'][] = 'Invalid email.';
    }
    return self::$alerts;
  }

  // Validates password
  public function validatePassword() {
    if(!$this->password) {
      self::$alerts['error'][] = 'Password is required.';
    }
    if(strlen($this->password) < 6) {
      self::$alerts['error'][] = 'Password must contain at least 6 characters.';
    }
    return self::$alerts;
  }

  // Validates user profile
  public function validateProfile() {
    if(!$this->name) {
      self::$alerts['error'][] = 'Name is required.';
    }
    if(!$this->email) {
      self::$alerts['error'][] = 'Email is required.';
    }
    return self::$alerts;
  }

  // Hashes password
  public function hashPassword() {
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  // Creates token
  public function createToken() {
    $this->token = uniqid();
    // $this->token = md5(uniqid());
  }

}
