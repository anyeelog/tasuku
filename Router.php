<?php

namespace MVC;

class Router {

  public $routesGET = [];
  public $routesPOST = [];

  public function get($url, $fn) {
    $this->routesGET[$url] = $fn;
  }

  public function post($url, $fn) {
    $this->routesPOST[$url] = $fn;
  }

  public function testRoutes() {

    $actualUrl = $_SERVER['PATH_INFO'] ?? '/';
    $method = $_SERVER['REQUEST_METHOD'];

    if($method === 'GET') {
      $fn = $this->routesGET[$actualUrl] ?? null;
    } else {
      $fn = $this->routesPOST[$actualUrl] ?? null;
    }

    if($fn) {
      // url exists and there's an associated function
      call_user_func($fn, $this);
    } else {
      echo "Page not found";
    }

  }

  // View
  public function render($view, $datas = []) {

    foreach($datas as $key => $value) {
      $$key = $value;
    }

    ob_start(); // Stores in the memory for a moment

    include_once __DIR__ . "/views/$view.php";
    $content = ob_get_clean(); // Cleans the Buffer
    include_once __DIR__ . "/views/layout.php";

  }

}
