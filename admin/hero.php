<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Hero Section';
$pageSubtitle = 'Manage homepage hero content';

// Handle Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_hero'])) {
    $updates = [
        'established_year' => $_POST['established_year'],
        'hero_tagline' => $_POST['hero_tagline'],
        'hero_description' => $_POST['hero_description'],
        'cta_button_text' => $_POST['cta_button_text'],
        'cta_button_link' => $_POST['cta_button_link'],
        'secondary_cta_text' => $_POST['secondary_cta_text'],
        'secondary_cta_link' => $_POST['secondary_cta_link']
    ];
    
    foreach ($updates as $key => $value) {
        $value = $conn->real_escape_string($value);
        $conn->query("UPDATE settings SET setting_value = '$value' WHERE setting_key = '$key'");
    }
    $success = "Hero section updated!";
}

// Handle Image Upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['hero_image']) && $_FILES['hero_image']['size'] > 0) {
    $target_dir = "../assets/images/";
    if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
    $filename = time() . '_hero.' . pathinfo($_FILES["hero_image"]["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $filename;
    $db_path = "assets/images/" . $filename;
    
    if (move_uploaded_file($_FILES["hero_image"]["tmp_name"], $target_file)) {
        $conn->query("UPDATE settings SET setting_value = '$db_path' WHERE setting_key = 'hero_image'");
        $success = "Hero image updated!";
    }
}

// Get current settings
$settings = [];
$res = $conn->query("SELECT setting_key, setting_value FROM settings");
while($row = $res->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

include 'includes/layout.php';
?>

<?php if (isset($success)): ?>
<div style="background: #ffddda; color: #a10014; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e5bdba; display: flex; align-items: center; gap: 12px;">
    <span class="material-symbols-outlined">check_circle</span>
    <?php echo $success; ?>
</div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <!-- Text Content -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Hero Content</h2>
        <form method="POST">
            <input type="hidden" name="update_hero" value="1">
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Badge Text (Established)</label>
                <input type="text" name="established_year" value="<?php echo isset($settings['established_year']) ? htmlspecialchars($settings['established_year']) : '2024'; ?>" class="input" placeholder="e.g., ESTABLISHED 2024 • BIRGUNJ, NEPAL">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Tagline</label>
                <input type="text" name="hero_tagline" value="<?php echo isset($settings['hero_tagline']) ? htmlspecialchars($settings['hero_tagline']) : ''; ?>" class="input" placeholder="e.g., Innovate • Build • Inspire">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Description</label>
                <textarea name="hero_description" rows="4" class="input"><?php echo isset($settings['hero_description']) ? htmlspecialchars($settings['hero_description']) : ''; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined">save</span>
                Save Content
            </button>
        </form>
    </div>

    <!-- Buttons & Image -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Buttons & Image</h2>
        
        <form method="POST" enctype="multipart/form-data">
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Primary Button Text</label>
                <input type="text" name="cta_button_text" value="<?php echo isset($settings['cta_button_text']) ? htmlspecialchars($settings['cta_button_text']) : ''; ?>" class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Primary Button Link</label>
                <input type="text" name="cta_button_link" value="<?php echo isset($settings['cta_button_link']) ? htmlspecialchars($settings['cta_button_link']) : ''; ?>" class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Secondary Button Text</label>
                <input type="text" name="secondary_cta_text" value="<?php echo isset($settings['secondary_cta_text']) ? htmlspecialchars($settings['secondary_cta_text']) : ''; ?>" class="input">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Secondary Button Link</label>
                <input type="text" name="secondary_cta_link" value="<?php echo isset($settings['secondary_cta_link']) ? htmlspecialchars($settings['secondary_cta_link']) : ''; ?>" class="input">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined">save</span>
                Save Buttons
            </button>
        </form>

        <hr style="margin: 24px 0; border: none; border-top: 1px solid #e3e3dd;">

        <form method="POST" enctype="multipart/form-data">
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Hero Image</label>
                <?php if(!empty($settings['hero_image'])): ?>
                    <img src="../<?php echo $settings['hero_image']; ?>" style="width: 100%; height: 180px; object-fit: cover; border-radius: 12px; margin-bottom: 12px;">
                <?php endif; ?>
                <input type="file" name="hero_image" accept="image/*" class="input">
            </div>
            <button type="submit" class="btn btn-secondary" style="width: 100%;">
                <span class="material-symbols-outlined">upload</span>
                Upload New Image
            </button>
        </form>
    </div>
</div>

<style>
@media (max-width: 1024px) {
    div[style*="grid-template-columns: 1fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>