<?php
declare(strict_types=1);

// Provides escaping, redirects, and notification helpers.
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function app_url(string $path = ''): string
{
    global $config;

    $baseUrl = rtrim((string) ($config['app']['base_url'] ?? ''), '/');

    if ($path === '') {
        return $baseUrl === '' ? '/' : $baseUrl . '/';
    }

    return $baseUrl . '/' . ltrim($path, '/');
}

function redirect_to(string $path): void
{
    header('Location: ' . app_url($path));
    exit;
}

function request_method_is(string $method): bool
{
    return strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET')) === strtoupper($method);
}

function set_flash_message(string $type, string $message): void
{
    $_SESSION['_flash'][$type][] = $message;
}

function consume_flash_messages(): array
{
    $messages = $_SESSION['_flash'] ?? [];
    unset($_SESSION['_flash']);

    return is_array($messages) ? $messages : [];
}

function abort_request(int $statusCode, string $message): void
{
    http_response_code($statusCode);
    echo e($message);
    exit;
}
