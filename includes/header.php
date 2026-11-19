<?php
$pageTitle = $pageTitle ?? 'Dashboard';
$mode = $mode ?? 'Lab';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?> · <?= e(APP_NAME) ?></title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header class="topbar">
  <a class="brand" href="../index.php"><span class="brand-mark">S</span><span>SESSION<span class="muted">LAB</span></span></a>
  <nav><a href="../index.php">Overview</a><a href="../vulnerable/login.php">Vulnerable</a><a href="../secure/login.php">Secure</a></nav>
  <span class="mode-pill"><?= e($mode) ?> environment</span>
</header>
<main class="container">
