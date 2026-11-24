<?php
declare(strict_types=1);

// Loads local configuration and initializes shared application dependencies.
$configPath = __DIR__ . '/config/config.local.php';

if (!is_file($configPath)) {
    throw new RuntimeException(
        'Missing local configuration. Copy config.example.php to config.local.php before running the application.'
    );
}

$config = require $configPath;

if (!is_array($config) || !isset($config['database'], $config['app'])) {
    throw new RuntimeException('Application configuration is incomplete.');
}

$sessionName = (string) ($config['app']['session_name'] ?? 'cobuild_session');
$secureCookies = (bool) ($config['app']['secure_cookies'] ?? false);

if (session_status() === PHP_SESSION_NONE) {
    session_name($sessionName);
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $secureCookies,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

require_once __DIR__ . '/core/helpers.php';
require_once __DIR__ . '/core/database.php';
require_once __DIR__ . '/core/auth.php';
require_once __DIR__ . '/core/csrf.php';
require_once __DIR__ . '/core/validation.php';

$pdo = create_pdo($config['database']);
