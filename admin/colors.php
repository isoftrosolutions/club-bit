<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Theme Colors';
$pageSubtitle = 'Customize site theme and colors';

// Handle Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_colors'])) {
    foreach ($_POST['color_value'] as $id => $value) {
        $id = intval($id);
        $value = $conn->real_escape_string($value);
        $conn->query("UPDATE site_colors SET color_value = '$value' WHERE id = $id");
    }
    $success = "Colors updated successfully!";
}

$colors = $conn->query("SELECT * FROM site_colors ORDER BY category, sort_order");

include 'includes/layout.php';
?>

<?php if (isset($success)): ?>
<div style="background: #ffddda; color: #a10014; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e5bdba; display: flex; align-items: center; gap: 12px;">
    <span class="material-symbols-outlined">check_circle</span>
    <?php echo $success; ?>
</div>
<?php endif; ?>

<div class="card" style="max-width: 900px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2 style="font-size: 18px; font-weight: 700;">Theme Colors</h2>
    </div>

    <form method="POST">
        <input type="hidden" name="update_colors" value="1">
        
        <?php 
        $current_category = '';
        while($c = $colors->fetch_assoc()): 
            if($c['category'] !== $current_category):
                if($current_category !== '') echo '</div>';
                $current_category = $c['category'];
        ?>
            <div style="margin-bottom: 32px;">
                <h3 style="font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #5c403d; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid #e3e3dd;">
                    <?php echo ucfirst($c['category']); ?> Colors
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px;">
        <?php endif; ?>
                    <div style="background: #fafaf3; padding: 16px; border-radius: 12px; border: 1px solid #e3e3dd;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;"><?php echo $c['color_name']; ?></label>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <input type="color" name="color_value[<?php echo $c['id']; ?>]" value="<?php echo $c['color_value']; ?>" style="width: 48px; height: 48px; border: none; border-radius: 8px; cursor: pointer;">
                            <input type="text" value="<?php echo $c['color_value']; ?>" readonly style="flex: 1; padding: 8px 12px; border: 1px solid #e3e3dd; border-radius: 8px; font-family: monospace; font-size: 14px; background: #fff;">
                        </div>
                        <div style="margin-top: 8px; width: 100%; height: 24px; background: <?php echo $c['color_value']; ?>; border-radius: 4px; border: 1px solid #e3e3dd;"></div>
                    </div>
        <?php endwhile; ?>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-outlined">save</span>
            Save All Colors
        </button>
    </form>
</div>

<div class="card" style="max-width: 900px; margin-top: 24px;">
    <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 16px;">Preview</h2>
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; padding: 24px; background: #fafaf3; border-radius: 12px;">
        <div style="text-align: center; padding: 16px; background: var(--primary); color: var(--on-primary); border-radius: 8px;">
            <div style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Primary</div>
        </div>
        <div style="text-align: center; padding: 16px; background: #ffffff; border: 1px solid var(--outline); border-radius: 8px;">
            <div style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Surface</div>
        </div>
        <div style="text-align: center; padding: 16px; background: var(--surface-variant); color: var(--on-surface); border-radius: 8px;">
            <div style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Variant</div>
        </div>
        <div style="text-align: center; padding: 16px; background: var(--error); color: var(--on-error); border-radius: 8px;">
            <div style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Error</div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>