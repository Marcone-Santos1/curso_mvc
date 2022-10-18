<?php

use \App\Http\Response;
use App\Controller\Pages;

// rota home
$obRouter->get('/', [
    function() {
        return new Response(200, Pages\Home::getHome());
    }
]);

// rota sobre
$obRouter->get('/sobre', [
    function() {
        return new Response(200, Pages\About::getHome());
    }
]);
