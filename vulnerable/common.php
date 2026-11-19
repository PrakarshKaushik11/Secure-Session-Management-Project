<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';

// INTENTIONALLY INSECURE: no HttpOnly/Secure flag and no session ID rotation.
// Lab-only fixation hook: choose a known ID before session_start(). Never copy this pattern into real apps.
if (isset($_GET['lab_sid']) && preg_match('/^[a-zA-Z0-9,-]{16,64}$/', (string) $_GET['lab_sid'])) {
    session_id((string) $_GET['lab_sid']);
}
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => false,
    'httponly' => false,
    'samesite' => 'Lax',
]);
ini_set('session.use_strict_mode', '0');
ini_set('session.use_only_cookies', '1');
session_start();
