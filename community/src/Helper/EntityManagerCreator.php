<?php

namespace ofernandoavila\Community\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;
use ofernandoavila\Community\Core\Config;

class EntityManagerCreator
{
    public static function createEntityManager()
    {
        global $configs;

        $systemConfig = $configs ?? Config::GetConfigs();
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
            'driver' => 'pdo_mysql',
            'driverOptions' => [
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '-03:00'",
                \PDO::ATTR_TIMEOUT => 10,
                \PDO::ATTR_PERSISTENT => false,
            ],
        ], $config);

        // obtaining the entity manager
        return new EntityManager($connection, $config);
    }
}
