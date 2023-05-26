<?php

require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use ofernandoavila\Community\Helper\EntityManagerCreator;

global $applicationMode;

$applicationMode = 'dev';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../src/config');
$dotenv->load();

$entityManager = EntityManagerCreator::createEntityManager();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
