<?php

require_once '../vendor/autoload.php';

use ofernandoavila\Community\Core\Core;
use ofernandoavila\Community\Core\Router;

global $router, $core;

session_start();
session_regenerate_id();

require_once __DIR__ . '/../src/Helper/Redirect.php';

$core = new Core();
$router = new Router();

require_once __DIR__ . '/../routes.php';

$core->Init();