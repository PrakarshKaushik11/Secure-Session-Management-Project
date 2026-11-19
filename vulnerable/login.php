<?php
require __DIR__ . '/common.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = db()->prepare('SELECT id, username, password_hash FROM users WHERE username = ?');
    $stmt->execute([trim((string)($_POST['username'] ?? ''))]);
    $user = $stmt->fetch();
    if ($user && password_verify((string)($_POST['password'] ?? ''), $user['password_hash'])) {
        // INTENTIONALLY INSECURE: session ID is not regenerated after authentication.
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['username'] = $user['username'];
        redirect('dashboard.php');
    }
    $error = 'Invalid username or password.';
}
$pageTitle = 'Vulnerable login'; $mode = 'Vulnerable'; include __DIR__ . '/../includes/header.php';
?>
<div class="card form"><div class="eyebrow">VULNERABLE MODULE</div><h1>Sign in</h1><p class="sub">This version intentionally omits key session protections.</p><div class="notice danger">Lab-only fixation hook: append <code>?lab_sid=LABSESSIONID123456</code> to this page in your own local browser to select a known demo ID.</div><?php if ($error): ?><div class="notice danger"><?= e($error) ?></div><?php endif; ?><form method="post"><label class="field">Username<input name="username" required autocomplete="username"></label><label class="field">Password<input type="password" name="password" required autocomplete="current-password"></label><button class="btn danger" type="submit">Sign in to vulnerable demo</button></form><p class="small">Demo credentials: student / LabPass@123</p></div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
