<?php

require_once '../vendor/autoload.php';

use ofernandoavila\Community\Core\Config;
use ofernandoavila\Community\Core\Core;
use ofernandoavila\Community\Core\Router;
use ofernandoavila\Community\Helper\EntityManagerCreator;

global $router, $core, $applicationMode, $em;

$applicationMode = 'dev';

require_once __DIR__ . '/../src/Helper/Redirect.php';
require_once __DIR__ . '/../src/Helper/Debug.php';


date_default_timezone_set('America/Sao_Paulo');

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../src/config');
$dotenv->load();

$em = EntityManagerCreator::createEntityManager();

session_start();
session_regenerate_id();


$core = new Core($applicationMode);
$router = new Router();

require_once __DIR__ . '/../routes.php';

try {
    $core->Init();
} catch (\Exception $e) {
    global $data;

    $data['config'] = Config::GetConfigs($applicationMode);

    ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header');
    echo '<pre>';
    throw $e;
}