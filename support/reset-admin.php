<?php
require_once __DIR__ . '/config.php';

// The password you want to set
$newPassword = 'FlashFix@2026';
$email = 'admin@flashfixtechnologies.com';
$username = 'admin';

echo "<html><body style='font-family:sans-serif; padding:40px; line-height:1.6;'>";
echo "<h2>FlashFix Admin Recovery</h2>";

try {
    $hash = password_hash($newPassword, PASSWORD_DEFAULT);
    
    // Check if admin exists
    $stmt = $pdo->prepare("SELECT id FROM admins WHERE email = ? OR username = ?");
    $stmt->execute([$email, $username]);
    $admin = $stmt->fetch();

    if ($admin) {
        // Update existing admin
        $stmt = $pdo->prepare("UPDATE admins SET password_hash = ?, is_active = 1 WHERE id = ?");
        $stmt->execute([$hash, $admin['id']]);
        echo "<div style='color:green; font-weight:bold;'>✅ Admin password updated successfully!</div>";
    } else {
        // Create new admin if not found
        $stmt = $pdo->prepare("INSERT INTO admins (username, email, password_hash, full_name, is_active) VALUES (?, ?, ?, ?, 1)");
        $stmt->execute([$username, $email, $hash, 'Flash Fix Admin']);
        echo "<div style='color:green; font-weight:bold;'>✅ Admin account created successfully!</div>";
    }

    echo "<p><strong>Login URL:</strong> <a href='" . url('/admin/login.php') . "'>" . url('/admin/login.php') . "</a><br>";
    echo "<strong>Username:</strong> admin<br>";
    echo "<strong>Password:</strong> " . $newPassword . "</p>";
    
    echo "<div style='background:#fee; border:1px solid #fcc; padding:15px; border-radius:8px; margin-top:20px;'>";
    echo "<strong style='color:red;'>SECURITY ALERT:</strong> Delete this file (<code>reset-admin.php</code>) from your server immediately after use!";
    echo "</div>";

} catch (Exception $e) {
    echo "<div style='color:red; font-weight:bold;'>❌ Error: " . htmlspecialchars($e->getMessage()) . "</div>";
    echo "<p>Check your database connection settings in <code>config.php</code>.</p>";
}

echo "</body></html>";
