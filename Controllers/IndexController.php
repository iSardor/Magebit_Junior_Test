<?php
require_once('./Core/ControllerInterface.php');
require_once('./Core/View.php');

class IndexController implements ControllerInterface {
  public function getView() {
    $view = new View('index.phtml'); 
    $view->styleFiles = ['index.css'];
    $view->scriptFiles = ['script.js'];
    return $view;
  }
}