<?php

namespace ofernandoavila\Community\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;

class EntityManagerCreator
{
    public static function createEntityManager()
    {
        $systemConfig = require __DIR__ . '/../config/config.php';
        // Create a simple "default" Doctrine ORM configuration for Attributes
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: array(__DIR__ . "/../Model", __DIR__ . "/../Core"),
            isDevMode: true,
        );

        $config->setNamingStrategy(new UnderscoreNamingStrategy(CASE_LOWER));

        // configuring the database connection
        $connection = DriverManager::getConnection([
            'dbname' => $systemConfig['database']['database'],
            'user' => $systemConfig['database']['user'],
            'password' => $systemConfig['database']['password'],
            'host' => $systemConfig['database']['host'],
            'driver' => 'pdo_mysql'
        ], $config);

        // obtaining the entity manager
        return new EntityManager($connection, $config);
    }
}
