<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Statistics';
$pageSubtitle = 'Manage homepage statistics';

// Handle Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_stat'])) {
    $key = $conn->real_escape_string($_POST['stat_key']);
    $value = $conn->real_escape_string($_POST['stat_value']);
    $label = $conn->real_escape_string($_POST['stat_label']);
    $icon = $conn->real_escape_string($_POST['icon']);
    $order = intval($_POST['sort_order']);
    
    $conn->query("INSERT INTO stats (stat_key, stat_value, stat_label, icon, sort_order) VALUES ('$key', '$value', '$label', '$icon', $order)");
    $success = "Stat added successfully!";
}

// Handle Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_stats'])) {
    foreach ($_POST['stat_value'] as $id => $val) {
        $id = intval($id);
        $val = $conn->real_escape_string($val);
        $label = $conn->real_escape_string($_POST['stat_label'][$id]);
        $icon = $conn->real_escape_string($_POST['stat_icon'][$id]);
        $order = intval($_POST['stat_order'][$id]);
        $visible = isset($_POST['stat_visible'][$id]) ? 1 : 0;
        
        $conn->query("UPDATE stats SET stat_value='$val', stat_label='$label', icon='$icon', sort_order=$order, is_visible=$visible WHERE id=$id");
    }
    $success = "Stats updated!";
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM stats WHERE id = $id");
    $success = "Stat deleted.";
}

$stats = $conn->query("SELECT * FROM stats ORDER BY sort_order ASC");

include 'includes/layout.php';
?>

<?php if (isset($success)): ?>
<div style="background: #ffddda; color: #a10014; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e5bdba; display: flex; align-items: center; gap: 12px;">
    <span class="material-symbols-outlined">check_circle</span>
    <?php echo $success; ?>
</div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 350px 1fr; gap: 24px;">
    <!-- Add New Stat -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Add New Stat</h2>
        <form method="POST">
            <input type="hidden" name="add_stat" value="1">
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Stat Key (unique)</label>
                <input type="text" name="stat_key" placeholder="e.g., active_members" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Stat Value</label>
                <input type="text" name="stat_value" placeholder="e.g., 100+" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Stat Label</label>
                <input type="text" name="stat_label" placeholder="e.g., ACTIVE MEMBERS" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Icon (Material Symbol)</label>
                <input type="text" name="icon" placeholder="e.g., group" class="input">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Sort Order</label>
                <input type="number" name="sort_order" value="0" class="input">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined">add</span>
                Add Stat
            </button>
        </form>
    </div>

    <!-- Stats List -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">All Statistics</h2>
        <form method="POST">
            <input type="hidden" name="update_stats" value="1">
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Value</th>
                            <th>Label</th>
                            <th>Icon</th>
                            <th>Visible</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($s = $stats->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <input type="number" name="stat_order[<?php echo $s['id']; ?>]" value="<?php echo $s['sort_order']; ?>" style="width: 60px; padding: 8px; border: 1px solid #e3e3dd; border-radius: 8px;">
                            </td>
                            <td>
                                <input type="text" name="stat_value[<?php echo $s['id']; ?>]" value="<?php echo htmlspecialchars($s['stat_value']); ?>" style="width: 80px; padding: 8px; border: 1px solid #e3e3dd; border-radius: 8px;">
                            </td>
                            <td>
                                <input type="text" name="stat_label[<?php echo $s['id']; ?>]" value="<?php echo htmlspecialchars($s['stat_label']); ?>" style="width: 140px; padding: 8px; border: 1px solid #e3e3dd; border-radius: 8px;">
                            </td>
                            <td>
                                <input type="text" name="stat_icon[<?php echo $s['id']; ?>]" value="<?php echo htmlspecialchars($s['icon']); ?>" style="width: 100px; padding: 8px; border: 1px solid #e3e3dd; border-radius: 8px;">
                            </td>
                            <td>
                                <input type="checkbox" name="stat_visible[<?php echo $s['id']; ?>]" <?php echo $s['is_visible'] ? 'checked' : ''; ?>>
                            </td>
                            <td>
                                <a href="stats.php?delete=<?php echo $s['id']; ?>" onclick="return confirm('Delete this stat?')" style="color: #ba1a1a;">
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