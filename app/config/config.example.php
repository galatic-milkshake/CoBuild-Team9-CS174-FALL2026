<?php
// Provides placeholder configuration values for local development.

return [
    'database' => [
        'host' => 'localhost',
        'port' => 3306,
        'name' => 'cobuild',
        'user' => 'your_database_user',
        'password' => 'your_database_password',
        'charset' => 'utf8mb4',
    ],
    'app' => [
        'base_url' => '',
        'session_name' => 'cobuild_session',
        'secure_cookies' => false,
    ],
];
