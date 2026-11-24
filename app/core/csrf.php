<?php
declare(strict_types=1);

// Generates and validates CSRF tokens.
function csrf_token(): string
{
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }

    return (string) $_SESSION['_csrf_token'];
}

function verify_csrf_token(?string $token): bool
{
    $storedToken = $_SESSION['_csrf_token'] ?? '';

    return is_string($token)
        && is_string($storedToken)
        && $token !== ''
        && hash_equals($storedToken, $token);
}

function require_valid_csrf_token(?string $token = null): void
{
    $token = $token ?? ($_POST['csrf_token'] ?? null);

    if (!verify_csrf_token(is_string($token) ? $token : null)) {
        abort_request(403, 'Invalid CSRF token.');
    }
}
