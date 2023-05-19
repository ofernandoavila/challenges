<?php

require_once '../vendor/autoload.php';

use ofernandoavila\Community\Core\Core;
use ofernandoavila\Community\Core\Router;

global $router, $core;

$core = new Core();
$router = new Router();

require_once __DIR__ . '/../routes.php';

$core->Init();