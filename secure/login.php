<?php
require __DIR__ . '/common.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = db()->prepare('SELECT id, username, password_hash FROM users WHERE username = ?');
    $stmt->execute([trim((string)($_POST['username'] ?? ''))]);
    $user = $stmt->fetch();
    if ($user && password_verify((string)($_POST['password'] ?? ''), $user['password_hash'])) {
        // Rotate the ID at the privilege boundary to mitigate session fixation.
        session_regenerate_id(true);
        $_SESSION = [
            'user_id' => (int)$user['id'],
            'username' => $user['username'],
            'created_at' => time(),
            'last_activity' => time(),
            'csrf_token' => bin2hex(random_bytes(32)),
        ];
        redirect('dashboard.php');
    }
    $error = 'Invalid username or password.';
}
$pageTitle = 'Secure login'; $mode = 'Secure'; include __DIR__ . '/../includes/header.php';
?>
<div class="card form"><div class="eyebrow">HARDENED MODULE</div><h1>Secure sign in</h1><p class="sub">This version rotates the session ID after successful authentication and applies cookie protections.</p><?php if ($error): ?><div class="notice danger"><?= e($error) ?></div><?php endif; ?><form method="post"><label class="field">Username<input name="username" required autocomplete="username"></label><label class="field">Password<input type="password" name="password" required autocomplete="current-password"></label><button class="btn" type="submit">Sign in securely</button></form><p class="small">Demo credentials: student / LabPass@123</p></div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
