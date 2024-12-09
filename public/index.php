<?php

// to get out of public folder to the project base path
const BASE_PATH = __DIR__ . '/../';

// importing helper functions
require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {

  // Ex: $class = Core\Database, it will become Core/Database
  $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);

  // require the classes
  require base_path("{$class}.php");
});

// create router object
$router = new \Core\Router();

$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Start Session
session_start();

// delte old room images from public
$files = scandir(base_path("public"));
foreach ($files as $file) {
  if (mime_content_type($file) === 'image/jpeg' && $file !== "{$_SESSION['pfp']}") {
    unlink(base_path("public/$file"));
  }
}

// dump($_SESSION);

// go to controller of the current uri, for example: if the url is '/' it goes to 'controllers/index.php'
$router->route($uri, $method);

// go to user home if there is a session
if ( isset($_SESSION['email']) && $uri === '/' ) {
  header("Location: /home");
}