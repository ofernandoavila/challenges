<?php

return array(
    'prefix' => '/challenges/community',
    'template_dir' => __DIR__ . '/../templates/',
    'base_url' => 'http://localhost/challenges/community',
    'storage_url' => 'http://localhost/community_storage',
    'storage_dir' => $_ENV['LOCAL_STORAGE_DIR'],
    'scripts_dir' => 'http://localhost/challenges/useful',
    'database' => [
        'host' => $_ENV['DB_HOST'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'] ?? '',
        'database' => $_ENV['DB_DATABASE'],
        'port' => 3306
    ]
);