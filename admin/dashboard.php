<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Dashboard';
$pageSubtitle = 'Overview of Club Abhiyanta\'s digital ecosystem';

$members_count = $conn->query("SELECT COUNT(*) as total FROM members")->fetch_assoc()['total'];
$team_count = $conn->query("SELECT COUNT(*) as total FROM leadership_team")->fetch_assoc()['total'];
$gallery_count = $conn->query("SELECT COUNT(*) as total FROM gallery")->fetch_assoc()['total'];
$messages_count = $conn->query("SELECT COUNT(*) as total FROM contacts")->fetch_assoc()['total'];

$recent_members = $conn->query("SELECT * FROM members ORDER BY created_at DESC LIMIT 5");
$recent_team = $conn->query("SELECT * FROM leadership_team ORDER BY created_at DESC LIMIT 5");

include 'includes/layout.php';
?>

<!-- Stats Grid - Match Index Page Style -->
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 48px;">
    <div style="text-align: center; padding: 24px; background: #ffffff; border: 1px solid #e3e3dd; border-radius: 16px;">
        <div style="font-size: 42px; font-weight: 700; color: #a10014; font-family: 'Montserrat', sans-serif;"><?php echo $members_count; ?></div>
        <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #5c403d; margin-top: 8px;">Total Members</div>
    </div>
    <div style="text-align: center; padding: 24px; background: #ffffff; border: 1px solid #e3e3dd; border-radius: 16px;">
        <div style="font-size: 42px; font-weight: 700; color: #a10014; font-family: 'Montserrat', sans-serif;"><?php echo $team_count; ?></div>
        <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #5c403d; margin-top: 8px;">Leadership Team</div>
    </div>
    <div style="text-align: center; padding: 24px; background: #ffffff; border: 1px solid #e3e3dd; border-radius: 16px;">
        <div style="font-size: 42px; font-weight: 700; color: #a10014; font-family: 'Montserrat', sans-serif;"><?php echo $gallery_count; ?></div>
        <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #5c403d; margin-top: 8px;">Gallery Items</div>
    </div>
    <div style="text-align: center; padding: 24px; background: #ffffff; border: 1px solid #e3e3dd; border-radius: 16px;">
        <div style="font-size: 42px; font-weight: 700; color: #a10014; font-family: 'Montserrat', sans-serif;"><?php echo $messages_count; ?></div>
        <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #5c403d; margin-top: 8px;">Total Inquiries</div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card" style="margin-bottom: 48px;">
    <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 24px;">Quick Actions</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        <a href="members.php?action=add" class="btn btn-primary">
            <span class="material-symbols-outlined">person_add</span>
            New Member
        </a>
        <a href="team.php" class="btn btn-secondary">
            <span class="material-symbols-outlined">groups</span>
            Manage Team
        </a>
        <a href="gallery.php" class="btn btn-secondary">
            <span class="material-symbols-outlined">cloud_upload</span>
            Upload Photos
        </a>
        <a href="settings.php" class="btn btn-secondary">
            <span class="material-symbols-outlined">settings</span>
            Site Settings
        </a>
    </div>
</div>

<!-- Tables Grid -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <!-- Recent Members -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h2 style="font-size: 20px; font-weight: 700;">Recent Members</h2>
            <a href="members.php" style="color: #a10014; font-weight: 600; font-size: 14px; text-decoration: none;">View All</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($m = $recent_members->fetch_assoc()): ?>
                <tr>
                    <td>
                        <div style="font-weight: 600;"><?php echo htmlspecialchars($m['name']); ?></div>
                        <div style="font-size: 12px; color: #5c403d;"><?php echo htmlspecialchars($m['email']); ?></div>
                    </td>
                    <td>
                        <span class="badge <?php echo $m['status'] === 'active' ? 'badge-active' : 'badge-pending'; ?>">
                            <?php echo $m['status']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="members.php?edit=<?php echo $m['id']; ?>" style="color: #a10014; text-decoration: none;">
                            <span class="material-symbols-outlined" style="font-size: 20px;">edit</span>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Executive Team -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h2 style="font-size: 20px; font-weight: 700;">Executive Team</h2>
            <a href="team.php" style="color: #a10014; font-weight: 600; font-size: 14px; text-decoration: none;">Edit Team</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Position</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php while($t = $recent_team->fetch_assoc()): ?>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; border-radius: 8px; background: #e3e3dd; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px;">
                                <?php echo strtoupper(substr($t['name'], 0, 1)); ?>
                            </div>
                            <span style="font-weight: 600;"><?php echo htmlspecialchars($t['name']); ?></span>
                        </div>
                    </td>
                    <td>
                        <span style="font-size: 13px; font-weight: 600; color: #a10014;"><?php echo htmlspecialchars($t['position']); ?></span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <?php if($t['email']): ?>
                            <a href="mailto:<?php echo $t['email']; ?>" style="color: #5c403d; text-decoration: none;">
                                <span class="material-symbols-outlined" style="font-size: 18px;">email</span>
                            </a>
                            <?php endif; ?>
                            <?php if($t['phone']): ?>
                            <a href="tel:<?php echo $t['phone']; ?>" style="color: #5c403d; text-decoration: none;">
                                <span class="material-symbols-outlined" style="font-size: 18px;">phone</span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
@media (max-width: 1024px) {
    div[style*="grid-template-columns: repeat(4, 1fr)"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    div[style*="grid-template-columns: 1fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
}
@media (max-width: 640px) {
    div[style*="grid-template-columns: repeat(4, 1fr)"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>