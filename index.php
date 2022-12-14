<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;

define('URL', 'http://localhost/cursos/estudoPHP/estudoMVC/mvc');

View::init([
    'URL'=> URL
]);

$obRouter = new Router(URL);

include __DIR__ . "/routes/pages.php";

// imprime o response da rota
$obRouter->run()->sendResponse();