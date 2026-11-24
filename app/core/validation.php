<?php
declare(strict_types=1);

// Provides shared server-side input validation.
function validate_required_string($value, string $fieldName, int $maxLength = 255): array
{
    $errors = [];

    if (!is_string($value) || trim($value) === '') {
        $errors[] = "{$fieldName} is required.";
        return $errors;
    }

    $length = function_exists('mb_strlen')
        ? mb_strlen(trim($value))
        : strlen(trim($value));

    if ($length > $maxLength) {
        $errors[] = "{$fieldName} must be {$maxLength} characters or fewer.";
    }

    return $errors;
}

function validate_email_address($value, string $fieldName = 'Email'): array
{
    if (!is_string($value) || filter_var(trim($value), FILTER_VALIDATE_EMAIL) === false) {
        return ["{$fieldName} must be a valid email address."];
    }

    return [];
}

function validate_password($value, int $minimumLength = 8): array
{
    if (!is_string($value) || strlen($value) < $minimumLength) {
        return ["Password must be at least {$minimumLength} characters long."];
    }

    return [];
}
