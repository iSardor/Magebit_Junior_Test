<?php

// TODO Implement Autoloading
require_once('./Controllers/IndexController.php');
require_once('./Controllers/AdminController.php');
require_once('./Controllers/ErrorController.php');
require_once('./Controllers/SubscribeController.php');
require_once('./Controllers/DeleteSubscriberController.php');

class Router {
  /**
   * Used to map the string $controllerName to the actual controller object
   *
   * @param $controllerList Array
   */
  private $controllersList = [
    'index' => 'IndexController',
    'admin' => 'AdminController',
    'subscribe' => 'SubscribeController',
    'deletesubscriber' => 'DeleteSubscriberController',
    'notFound' => 'ErrorController'
  ];

  /**
   * @param $controllerName String
   */
  protected $controllerName;
  
  /**
   * @param $actionName String
   */
  protected $actionName;

  public function __construct($controllerName) {   
    $this->controllerName = $controllerName;
  }
  
  public function getController() {
    $hasController = array_key_exists($this->controllerName, $this->controllersList);
    
    if  ($hasController) {
      return new $this->controllersList[$this->controllerName]();
    } else {
      /** TODO ImplementN */
      return new $this->controllersList['notFound']();
    }
  }
}
