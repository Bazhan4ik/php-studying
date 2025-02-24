<?php

namespace App;

class Router {
  protected $routes = [];

  private function addRoute($route, $controller, $action, $method) {
    $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
  }

  public function get($route, $controller, $action) {
    // $controller is one of the controllers in /controllers that will be used to execute $action
    $this->addRoute($route, $controller, $action, 'GET');
  }

  public function post($route, $controller, $action) {
    $this->addRoute($route, $controller, $action, 'POST');
  }

  /**
   * Determines which controller and action to execute
   */
  public function dispatch() {
    // this line returns a path with no params
    $uri = strtok($_SERVER['REQUEST_URI'], '?');
    // 
    $method = $_SERVER['REQUEST_METHOD'];

    // checks if the requested route exists
    if(array_key_exists($uri, $this->routes[$method])) {
      // if the route exists it creates an instance of the controller and executes the action for that controller;
      $controller = $this->routes[$method][$uri]['controller'];
      $action = $this->routes[$method][$uri]['action'];

      $controller = new $controller();
      $controller->$action();
    } else {
      throw new \Exception("No route found for URI: $uri");
    }
  }

}

?>