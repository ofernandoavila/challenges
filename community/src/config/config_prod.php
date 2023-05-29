<?php

return array(
    'prefix' => '/challenges/community',
    'template_dir' => __DIR__ . '/../templates/',
    'base_url' => 'https://ofernandoavila.avilamidia.com/challenges/community',
    'storage_url' => 'https://ofernandoavila.avilamidia.com/community_storage',
    'scripts_dir' => 'https://ofernandoavila.avilamidia.com/challenges/useful',
    'database' => [
        'host' => $_ENV['DB_HOST_PROD'],
        'user' => $_ENV['DB_USER_PROD'],
        'password' => $_ENV['DB_PASSWORD_PROD'],
        'database' => $_ENV['DB_DATABASE_PROD'],
        'port' => 3306
    ]
);