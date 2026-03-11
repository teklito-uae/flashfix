<?php
/**
 * FlashFix Support - Admin Dashboard
 */
require_once __DIR__ . '/../config.php';
requireAdminLogin();

$stats = getTicketStats($pdo);

// Recent tickets
$stmt = $pdo->query("
    SELECT t.*, c.email as customer_email, c.company as customer_company
    FROM tickets t
    JOIN customers c ON c.id = t.customer_id
    ORDER BY t.updated_at DESC
    LIMIT 15
");
$recentTickets = $stmt->fetchAll();

// Today's new tickets
$stmt = $pdo->query("SELECT COUNT(*) FROM tickets WHERE DATE(created_at) = CURDATE()");
$todayCount = $stmt->fetchColumn();

// Unassigned tickets
$stmt = $pdo->query("SELECT COUNT(*) FROM tickets WHERE assigned_admin_id IS NULL AND status NOT IN ('closed','resolved')");
$unassigned = $stmt->fetchColumn();

$currentPage = 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | <?php echo SITE_NAME; ?> Admin</title>
    <link rel="stylesheet" href="<?php echo url('/assets/css/style.css'); ?>">
</head>
<body>
<div class="admin-layout">

    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <h2>Flash<span class="accent">Fix</span></h2>
            <small>Support Admin Panel</small>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section">Main</div>
            <a href="<?php echo url('/admin/index.php'); ?>" class="active">
                <span class="nav-icon">📊</span> Dashboard
            </a>
            <a href="<?php echo url('/admin/tickets.php'); ?>">
                <span class="nav-icon">🎫</span> All Tickets
                <?php if ($stats['open'] > 0): ?>
                    <span class="badge badge-open" style="margin-left:auto;"><?php echo $stats['open']; ?></span>
                <?php endif; ?>
            </a>
            <div class="nav-section">Quick Filters</div>
            <a href="<?php echo url('/admin/tickets.php?status=open'); ?>">
                <span class="nav-icon">🔵</span> Open
                <span style="margin-left:auto;font-size:12px;color:var(--text-soft);"><?php echo $stats['open']; ?></span>
            </a>
            <a href="<?php echo url('/admin/tickets.php?status=in-progress'); ?>">
                <span class="nav-icon">🟡</span> In Progress
                <span style="margin-left:auto;font-size:12px;color:var(--text-soft);"><?php echo $stats['in-progress']; ?></span>
            </a>
            <a href="<?php echo url('/admin/tickets.php?status=waiting'); ?>">
                <span class="nav-icon">🟣</span> Waiting
                <span style="margin-left:auto;font-size:12px;color:var(--text-soft);"><?php echo $stats['waiting']; ?></span>
            </a>
            <a href="<?php echo url('/admin/tickets.php?status=resolved'); ?>">
                <span class="nav-icon">🟢</span> Resolved
                <span style="margin-left:auto;font-size:12px;color:var(--text-soft);"><?php echo $stats['resolved']; ?></span>
            </a>
            <a href="<?php echo url('/admin/tickets.php?status=closed'); ?>">
                <span class="nav-icon">⚫</span> Closed
                <span style="margin-left:auto;font-size:12px;color:var(--text-soft);"><?php echo $stats['closed']; ?></span>
            </a>
        </nav>
        <div class="sidebar-footer">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                <div class="user-avatar" style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--accent));display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#fff;">
                    <?php echo strtoupper(substr($_SESSION['admin_name'], 0, 1)); ?>
                </div>
                <div>
                    <div style="font-size:13px;font-weight:600;"><?php echo sanitize($_SESSION['admin_name']); ?></div>
                    <div style="font-size:11px;color:var(--text-soft);">Administrator</div>
                </div>
            </div>
            <a href="<?php echo url('/admin/logout.php'); ?>" class="btn btn-secondary btn-sm btn-block" style="font-size:12px;">
                Sign Out
            </a>
        </div>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <div style="display:flex;align-items:center;gap:12px;">
                <button class="mobile-menu-toggle" onclick="toggleSidebar()">☰</button>
                <h1>Dashboard</h1>
            </div>
            <div style="font-size:13px;color:var(--text-soft);">
                <?php echo date('l, M j, Y'); ?>
            </div>
        </header>

        <div class="admin-content">
            <?php echo renderFlash(); ?>

            <div class="stats-grid">
                <div class="stat-card fade-in-up">
                    <div class="stat-icon blue">🎫</div>
                    <div class="stat-value"><?php echo $stats['total']; ?></div>
                    <div class="stat-label">Total Tickets</div>
                </div>
                <div class="stat-card fade-in-up">
                    <div class="stat-icon cyan">🆕</div>
                    <div class="stat-value"><?php echo $todayCount; ?></div>
                    <div class="stat-label">Today's New</div>
                </div>
                <div class="stat-card fade-in-up">
                    <div class="stat-icon yellow">⏳</div>
                    <div class="stat-value"><?php echo $stats['open'] + $stats['in-progress']; ?></div>
                    <div class="stat-label">Active</div>
                </div>
                <div class="stat-card fade-in-up">
                    <div class="stat-icon red">🔴</div>
                    <div class="stat-value"><?php echo $unassigned; ?></div>
                    <div class="stat-label">Unassigned</div>
                </div>
                <div class="stat-card fade-in-up">
                    <div class="stat-icon green">✅</div>
                    <div class="stat-value"><?php echo $stats['resolved']; ?></div>
                    <div class="stat-label">Resolved</div>
                </div>
                <div class="stat-card fade-in-up">
                    <div class="stat-icon purple">📁</div>
                    <div class="stat-value"><?php echo $stats['closed']; ?></div>
                    <div class="stat-label">Closed</div>
                </div>
            </div>

            <div class="card fade-in-up">
                <div class="card-header">
                    <h3>Recent Tickets</h3>
                    <a href="<?php echo url('/admin/tickets.php'); ?>" class="btn btn-secondary btn-sm">View All →</a>
                </div>
                <?php if (empty($recentTickets)): ?>
                    <div class="empty-state">
                        <div class="empty-icon">📋</div>
                        <h3>No Tickets Yet</h3>
                        <p>Tickets submitted by customers will appear here.</p>
                    </div>
                <?php else: ?>
                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Case ID</th>
                                    <th>Subject</th>
                                    <th>Customer</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentTickets as $t): ?>
                                <tr>
                                    <td><a href="<?php echo url('/admin/ticket.php?id=' . $t['id']); ?>" class="case-link"><?php echo sanitize($t['case_id']); ?></a></td>
                                    <td><a href="<?php echo url('/admin/ticket.php?id=' . $t['id']); ?>" class="subject-text"><?php echo sanitize($t['subject']); ?></a></td>
                                    <td class="text-sm text-muted"><?php echo sanitize($t['customer_email']); ?></td>
                                    <td><?php echo priorityBadge($t['priority']); ?></td>
                                    <td><?php echo statusBadge($t['status']); ?></td>
                                    <td class="text-sm text-muted"><?php echo sanitize($t['category']); ?></td>
                                    <td class="text-sm text-muted"><?php echo timeAgo($t['updated_at']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo url('/assets/js/app.js'); ?>"></script>
</body>
</html>
