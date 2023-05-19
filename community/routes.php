<?php

global $router;

$router->get('/', function() {
    echo '<h1>Hello World!</h1>';
});