<?php
require_once('./Router.php');

$uri = $_SERVER['REQUEST_URI'];
$uriArray = explode('/', $uri);
array_shift($uriArray); // Remove first part as its always empty string

$controllerName = empty($uriArray[0]) ? 'index' : $uriArray[0];


$router = new Router(preg_replace('/(\?.+)$/', '', $controllerName));

$controller = $router->getController();
$view = $controller->getView();

// Return the template
$view->getHtml();
