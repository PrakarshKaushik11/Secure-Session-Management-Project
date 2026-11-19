<?php
declare(strict_types=1);

const APP_NAME = 'Secure Session Management Lab';
const IDLE_TIMEOUT_SECONDS = 300; // 5 minutes for the demonstration.
const ABSOLUTE_TIMEOUT_SECONDS = 1800; // 30 minutes maximum session lifetime.

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $submitted = $_POST['csrf_token'] ?? '';
    if (!is_string($submitted) || !hash_equals($_SESSION['csrf_token'] ?? '', $submitted)) {
        http_response_code(419);
        exit('Request expired or invalid. Go back and try again.');
    }
}
