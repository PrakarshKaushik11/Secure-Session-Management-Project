<?php
require __DIR__ . '/common.php';
if (empty($_SESSION['user_id'])) redirect('login.php');
$pageTitle = 'Vulnerable dashboard'; $mode = 'Vulnerable'; include __DIR__ . '/../includes/header.php';
?>
<div class="hero"><div class="eyebrow">VULNERABLE SESSION · AUTHENTICATED</div><h1>Welcome, <?= e((string)$_SESSION['username']) ?></h1><p>This page is intentionally weak. The same session identifier remains in use after login and there is no inactivity expiry.</p></div>
<div class="grid"><section class="card"><h3>Current session ID</h3><div class="stat" style="color:var(--red)"><?= e(session_id()) ?></div><p class="small">This is deliberately exposed for the local demonstration. Do not expose real session IDs in production.</p></section><section class="card"><h3>Cookie configuration</h3><table class="table"><tr><td>HttpOnly</td><td>False</td></tr><tr><td>Secure</td><td>False</td></tr><tr><td>SameSite</td><td>Lax</td></tr><tr><td>Session rotation</td><td>No</td></tr><tr><td>Idle timeout</td><td>None</td></tr></table></section></div>
<div class="notice danger">Observation: record the session ID on the login page before authentication and compare it with this value. It remains unchanged.</div><a class="btn danger" href="logout.php">Logout</a>
<?php include __DIR__ . '/../includes/footer.php'; ?>
