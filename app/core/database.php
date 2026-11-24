<?php
declare(strict_types=1);

// Creates the MySQL connection using PDO.
function create_pdo(array $databaseConfig): PDO
{
    $requiredKeys = ['host', 'port', 'name', 'user', 'password', 'charset'];

    foreach ($requiredKeys as $key) {
        if (!array_key_exists($key, $databaseConfig)) {
            throw new InvalidArgumentException("Missing database configuration key: {$key}");
        }
    }

    $dsn = sprintf(
        'mysql:host=%s;port=%d;dbname=%s;charset=%s',
        $databaseConfig['host'],
        (int) $databaseConfig['port'],
        $databaseConfig['name'],
        $databaseConfig['charset']
    );

    return new PDO(
        $dsn,
        (string) $databaseConfig['user'],
        (string) $databaseConfig['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
}
