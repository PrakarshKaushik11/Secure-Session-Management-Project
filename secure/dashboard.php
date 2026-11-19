<?php
require __DIR__ . '/common.php';
require_login();
$pageTitle = 'Secure dashboard'; $mode = 'Secure'; include __DIR__ . '/../includes/header.php';
$params = session_get_cookie_params();
?>
<div class="hero"><div class="eyebrow">SECURE SESSION · AUTHENTICATED</div><h1>Welcome, <?= e((string)$_SESSION['username']) ?></h1><p>Session protections are active. The full session token is intentionally not displayed.</p></div>
<div class="grid"><section class="card"><h3>Session identifier</h3><div class="stat" style="color:var(--green)"><?= e(substr(hash('sha256', session_id()), 0, 16)) ?>…</div><p class="small">SHA-256 fingerprint for visual comparison only; not the actual session ID.</p></section><section class="card"><h3>Cookie configuration</h3><table class="table"><tr><td>HttpOnly</td><td><?= $params['httponly'] ? 'Enabled' : 'Disabled' ?></td></tr><tr><td>Secure</td><td><?= $params['secure'] ? 'Enabled' : 'Disabled (local HTTP)' ?></td></tr><tr><td>SameSite</td><td><?= e((string)($params['samesite'] ?? '')) ?></td></tr><tr><td>Strict mode</td><td><?= ini_get('session.use_strict_mode') === '1' ? 'Enabled' : 'Disabled' ?></td></tr><tr><td>Idle timeout</td><td>5 minutes</td></tr><tr><td>Absolute timeout</td><td>30 minutes</td></tr></table></section></div>
<div class="notice safe">Security active: session ID regenerated at login, cookie is HttpOnly, SameSite=Strict, and timeout checks run on authenticated requests.</div><p class="sub">Last activity: <?= e(date('H:i:s', (int)$_SESSION['last_activity'])) ?> · Session created: <?= e(date('H:i:s', (int)$_SESSION['created_at'])) ?></p>
<form method="post" action="logout.php"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><button class="btn" type="submit">Secure logout</button></form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
