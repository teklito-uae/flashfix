<?php
require_once __DIR__ . '/../config.php';

$hash = password_hash('flashfix@hiba123!@#', PASSWORD_BCRYPT);
$pdo->prepare("UPDATE admins SET password_hash = ? WHERE username = 'admin'")->execute([$hash]);

echo "✅ Password updated! Now <a href='login.php'>login here</a> and DELETE this file.";
