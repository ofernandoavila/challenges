<?php

require_once '../vendor/autoload.php';

use ofernandoavila\Community\Core\Core;
use ofernandoavila\Community\Core\Router;

global $router, $core, $applicationMode;

$applicationMode = 'dev';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../src/config');
$dotenv->load();

session_start();
session_regenerate_id();

require_once __DIR__ . '/../src/Helper/Redirect.php';

$core = new Core($applicationMode);
$router = new Router();

require_once __DIR__ . '/../routes.php';

$core->Init();