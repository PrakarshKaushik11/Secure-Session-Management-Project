<?php
require __DIR__ . '/config/app.php';
$pageTitle = 'Overview';
include __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="eyebrow">CYBERSECURITY MINI PROJECT · PHP + MYSQL</div>
  <h1>Understand sessions.<br><span style="color:var(--green)">Secure the identity.</span></h1>
  <p>A controlled demonstration of session fixation, session hijacking risks, and practical PHP mitigations. Compare an intentionally weak implementation with a hardened one.</p>
  <div class="notice">Lab safety: run this project only on your own computer using localhost. The vulnerable module is intentionally insecure and must never be deployed or exposed to a network.</div>
</section>
<div class="grid">
  <article class="card"><div class="icon">⚠️</div><span class="tag">INTENTIONALLY INSECURE</span><h2>Vulnerable demo</h2><p>Shows a session ID that persists across login, permissive cookie settings, and no idle timeout. Includes a lab-only fixation demonstration.</p><a class="btn danger" href="vulnerable/login.php">Open vulnerable demo</a></article>
  <article class="card"><div class="icon">🛡️</div><span class="tag">HARDENED IMPLEMENTATION</span><h2>Secure demo</h2><p>Regenerates the ID after login, uses cookie protections, enforces idle and absolute expiry, validates requests and destroys sessions on logout.</p><a class="btn" href="secure/login.php">Open secure demo</a></article>
  <article class="card"><div class="icon">📘</div><span class="tag">PROJECT NOTES</span><h2>What to compare</h2><p>Record the session ID before and after login, cookie attributes, timeout behaviour and logout behaviour in both versions.</p><a class="btn secondary" href="#checklist">View test checklist</a></article>
</div>
<section id="checklist" class="card"><h2>Evidence checklist</h2><table class="table"><tr><th>Test</th><th>Vulnerable</th><th>Secure</th></tr><tr><td>Session ID changes after login</td><td>No</td><td>Yes</td></tr><tr><td>HttpOnly cookie</td><td>No</td><td>Yes</td></tr><tr><td>Secure cookie on HTTPS</td><td>No</td><td>Yes</td></tr><tr><td>Idle / absolute timeout</td><td>No</td><td>Yes</td></tr><tr><td>Logout invalidates session</td><td>Basic cleanup only</td><td>Server + cookie cleanup</td></tr></table><p class="small">For a local HTTP test, the secure cookie's Secure flag is disabled automatically because browsers do not send Secure cookies over plain HTTP. Use localhost HTTPS to demonstrate Secure=true.</p></section>
<?php include __DIR__ . '/includes/footer.php'; ?>
