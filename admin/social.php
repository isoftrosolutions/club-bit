<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Social Links';
$pageSubtitle = 'Manage social media links';

// Handle Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_social'])) {
    foreach ($_POST['url'] as $id => $url) {
        $id = intval($id);
        $url = $conn->real_escape_string($url);
        $order = intval($_POST['social_order'][$id]);
        $visible = isset($_POST['social_visible'][$id]) ? 1 : 0;
        
        $conn->query("UPDATE social_links SET url='$url', sort_order=$order, is_visible=$visible WHERE id=$id");
    }
    $success = "Social links updated!";
}

// Handle Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_social'])) {
    $platform = $conn->real_escape_string($_POST['platform']);
    $name = $conn->real_escape_string($_POST['platform_name']);
    $url = $conn->real_escape_string($_POST['url']);
    $icon = $conn->real_escape_string($_POST['icon']);
    $order = intval($_POST['sort_order']);
    
    $conn->query("INSERT INTO social_links (platform, platform_name, url, icon, sort_order) VALUES ('$platform', '$name', '$url', '$icon', $order)");
    $success = "Social link added!";
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM social_links WHERE id = $id");
    $success = "Link deleted.";
}

$social = $conn->query("SELECT * FROM social_links ORDER BY sort_order ASC");

include 'includes/layout.php';
?>

<?php if (isset($success)): ?>
<div style="background: #ffddda; color: #a10014; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e5bdba; display: flex; align-items: center; gap: 12px;">
    <span class="material-symbols-outlined">check_circle</span>
    <?php echo $success; ?>
</div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 350px 1fr; gap: 24px;">
    <!-- Add New -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Add Social Platform</h2>
        <form method="POST">
            <input type="hidden" name="add_social" value="1">
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Platform Key</label>
                <input type="text" name="platform" placeholder="e.g., facebook" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Display Name</label>
                <input type="text" name="platform_name" placeholder="e.g., Facebook" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">URL</label>
                <input type="url" name="url" placeholder="https://..." class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Icon (Material Symbol)</label>
                <input type="text" name="icon" placeholder="e.g., facebook" class="input">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Sort Order</label>
                <input type="number" name="sort_order" value="0" class="input">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined">add</span>
                Add Platform
            </button>
        </form>
    </div>

    <!-- List -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">All Social Links</h2>
        <form method="POST">
            <input type="hidden" name="update_social" value="1">
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Platform</th>
                            <th>URL</th>
                            <th>Order</th>
                            <th>Visible</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($s = $social->fetch_assoc()): ?>
                        <tr>
                            <td style="font-weight: 600;">
                                <span class="material-symbols-outlined" style="vertical-align: middle; margin-right: 8px;"><?php echo $s['icon']; ?></span>
                                <?php echo htmlspecialchars($s['platform_name']); ?>
                            </td>
                            <td>
                                <input type="url" name="url[<?php echo $s['id']; ?>]" value="<?php echo htmlspecialchars($s['url']); ?>" style="width: 200px; padding: 8px; border: 1px solid #e3e3dd; border-radius: 8px;">
                            </td>
                            <td>
                                <input type="number" name="social_order[<?php echo $s['id']; ?>]" value="<?php echo $s['sort_order']; ?>" style="width: 60px; padding: 8px; border: 1px solid #e3e3dd; border-radius: 8px;">
                            </td>
                            <td>
                                <input type="checkbox" name="social_visible[<?php echo $s['id']; ?>]" <?php echo $s['is_visible'] ? 'checked' : ''; ?>>
                            </td>
                            <td>
                                <a href="social.php?delete=<?php echo $s['id']; ?>" onclick="return confirm('Delete?')" style="color: #ba1a1a;">
                                    <span class="material-symbols-outlined">delete</span>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 16px;">
                <span class="material-symbols-outlined">save</span>
                Save All Changes
            </button>
        </form>
    </div>
</div>

<style>
@media (max-width: 1024px) {
    div[style*="grid-template-columns: 350px 1fr"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>