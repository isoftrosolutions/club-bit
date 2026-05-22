<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Settings';
$pageSubtitle = 'Configure site settings';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {
        $key = $conn->real_escape_string($key);
        $value = $conn->real_escape_string($value);
        
        // Check if setting exists
        $check = $conn->query("SELECT id FROM settings WHERE setting_key = '$key'");
        if ($check && $check->num_rows > 0) {
            $conn->query("UPDATE settings SET setting_value = '$value' WHERE setting_key = '$key'");
        } else {
            $conn->query("INSERT INTO settings (setting_key, setting_value) VALUES ('$key', '$value')");
        }
    }
    $success = "Settings updated successfully!";
}

$settings_res = $conn->query("SELECT * FROM settings");
$settings = [];
while($row = $settings_res->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

include 'includes/layout.php';
?>

<?php if ($success): ?>
<div style="background: #ffddda; color: #a10014; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e5bdba; display: flex; align-items: center; gap: 12px;">
    <span class="material-symbols-outlined">check_circle</span>
    <?php echo $success; ?>
</div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <!-- Basic Info -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Basic Information</h2>
        <form action="settings.php" method="POST">
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Club Name</label>
                <input type="text" name="club_name" value="<?php echo isset($settings['club_name']) ? htmlspecialchars($settings['club_name']) : ''; ?>" class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Club Description</label>
                <textarea name="club_description" rows="3" class="input"><?php echo isset($settings['club_description']) ? htmlspecialchars($settings['club_description']) : ''; ?></textarea>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Address</label>
                <input type="text" name="address" value="<?php echo isset($settings['address']) ? htmlspecialchars($settings['address']) : ''; ?>" class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Established Year</label>
                <input type="text" name="established_year" value="<?php echo isset($settings['established_year']) ? htmlspecialchars($settings['established_year']) : '2024'; ?>" class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Contact Email</label>
                <input type="email" name="contact_email" value="<?php echo isset($settings['contact_email']) ? htmlspecialchars($settings['contact_email']) : ''; ?>" class="input">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Contact Phone</label>
                <input type="text" name="contact_phone" value="<?php echo isset($settings['contact_phone']) ? htmlspecialchars($settings['contact_phone']) : ''; ?>" class="input">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined">save</span>
                Save Basic Info
            </button>
        </form>
    </div>

    <!-- SEO & Sections -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">SEO & Sections</h2>
        <form action="settings.php" method="POST">
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Website Title</label>
                <input type="text" name="website_title" value="<?php echo isset($settings['website_title']) ? htmlspecialchars($settings['website_title']) : ''; ?>" class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Meta Description</label>
                <textarea name="meta_description" rows="2" class="input"><?php echo isset($settings['meta_description']) ? htmlspecialchars($settings['meta_description']) : ''; ?></textarea>
            </div>

            <div style="margin-bottom: 16px; padding: 16px; background: #fafaf3; border-radius: 12px;">
                <label style="display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; cursor: pointer;">
                    <input type="checkbox" name="about_section_enabled" value="1" <?php echo isset($settings['about_section_enabled']) && $settings['about_section_enabled'] == '1' ? 'checked' : ''; ?>>
                    Enable About/Stats Section
                </label>
            </div>

            <div style="margin-bottom: 16px; padding: 16px; background: #fafaf3; border-radius: 12px;">
                <label style="display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; cursor: pointer;">
                    <input type="checkbox" name="programs_section_enabled" value="1" <?php echo isset($settings['programs_section_enabled']) && $settings['programs_section_enabled'] == '1' ? 'checked' : ''; ?>>
                    Enable Programmes Section
                </label>
            </div>

            <div style="margin-bottom: 16px; padding: 16px; background: #fafaf3; border-radius: 12px;">
                <label style="display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; cursor: pointer;">
                    <input type="checkbox" name="projects_section_enabled" value="1" <?php echo isset($settings['projects_section_enabled']) && $settings['projects_section_enabled'] == '1' ? 'checked' : ''; ?>>
                    Enable Projects Section
                </label>
            </div>

            <div style="margin-bottom: 24px; padding: 16px; background: #fafaf3; border-radius: 12px;">
                <label style="display: flex; align-items: center; gap: 12px; font-weight: 600; font-size: 14px; cursor: pointer;">
                    <input type="checkbox" name="membership_section_enabled" value="1" <?php echo isset($settings['membership_section_enabled']) && $settings['membership_section_enabled'] == '1' ? 'checked' : ''; ?>>
                    Enable Membership CTA Section
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined">save</span>
                Save SEO & Sections
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