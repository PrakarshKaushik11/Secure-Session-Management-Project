<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';

$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
session_name('SECURESESSID');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => $isHttps, // true on HTTPS; false for local plain-HTTP development.
    'httponly' => true,
    'samesite' => 'Strict',
]);
ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_samesite', 'Strict');
session_start();

function require_login(): void
{
    if (empty($_SESSION['user_id'])) redirect('login.php');
    $now = time();
    $last = (int)($_SESSION['last_activity'] ?? $now);
    $created = (int)($_SESSION['created_at'] ?? $now);
    if (($now - $last) > IDLE_TIMEOUT_SECONDS || ($now - $created) > ABSOLUTE_TIMEOUT_SECONDS) {
        secure_logout('../index.php');
    }
    $_SESSION['last_activity'] = $now;
}

function secure_logout(string $destination): never
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires' => time() - 42000,
            'path' => $p['path'],
            'domain' => $p['domain'] ?? '',
            'secure' => (bool)$p['secure'],
            'httponly' => (bool)$p['httponly'],
            'samesite' => $p['samesite'] ?? 'Strict',
        ]);
    }
    session_destroy();
    redirect($destination);
}
