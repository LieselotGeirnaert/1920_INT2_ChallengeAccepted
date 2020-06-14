<?php
/*
 *
*/
session_start();

// commenten voor uploaden

ini_set('display_errors', true);
error_reporting(E_ALL);

// basic .env file parsing
if (file_exists("../.env")) {
  $variables = parse_ini_file("../.env", true);
  foreach ($variables as $key => $value) {
    putenv("$key=$value");
  }
}

// eventueel nog met een session werken

// set routes
$routes = array(
  'home' => array(
    'controller' => 'Pages',
    'action' => 'home'
  ),
  'hoehinderen' => array(
    'controller' => 'Pages',
    'action' => 'hoehinderen'
  ),
  'hinderoverzicht' => array(
    'controller' => 'Pages',
    'action' => 'hinderoverzicht'
  ),
  'hindersituaties' => array(
    'controller' => 'Pages',
    'action' => 'hindersituaties'
  ),
  'maakervaring' => array(
    'controller' => 'Pages',
    'action' => 'maakervaring'
  )
);

if(empty($_GET['page'])) {
  $_GET['page'] = 'home';
}
if(empty($routes[$_GET['page']])) {
  header('Location: index.php');
  exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once __DIR__ . '/controller/' . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();
