<?php
declare(strict_types=1);

// Checks login status and identifies the current user.
function current_user_id(): ?int
{
    $userId = $_SESSION['user_id'] ?? null;

    if (is_int($userId) && $userId > 0) {
        return $userId;
    }

    if (is_string($userId) && ctype_digit($userId) && (int) $userId > 0) {
        return (int) $userId;
    }

    return null;
}

function is_logged_in(): bool
{
    return current_user_id() !== null;
}

function require_login(): int
{
    $userId = current_user_id();

    if ($userId === null) {
        set_flash_message('error', 'Please log in to continue.');
        redirect_to('login.php');
    }

    return $userId;
}

function login_user(int $userId): void
{
    if ($userId <= 0) {
        throw new InvalidArgumentException('A valid user ID is required.');
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = $userId;
    $_SESSION['authenticated_at'] = time();
}

function logout_user(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $cookieParams = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $cookieParams['path'],
            $cookieParams['domain'],
            (bool) $cookieParams['secure'],
            (bool) $cookieParams['httponly']
        );
    }

    session_destroy();
}
