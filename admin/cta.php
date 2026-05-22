<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Call to Action';
$pageSubtitle = 'Manage CTA sections';

// Handle Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_cta'])) {
    foreach ($_POST['cta_title'] as $id => $title) {
        $id = intval($id);
        $title = $conn->real_escape_string($title);
        $desc = $conn->real_escape_string($_POST['cta_description'][$id]);
        $btn_text = $conn->real_escape_string($_POST['cta_button_text'][$id]);
        $btn_link = $conn->real_escape_string($_POST['cta_button_link'][$id]);
        $visible = isset($_POST['cta_visible'][$id]) ? 1 : 0;
        
        $conn->query("UPDATE cta_sections SET cta_title='$title', cta_description='$desc', cta_button_text='$btn_text', cta_button_link='$btn_link', is_visible=$visible WHERE id=$id");
    }
    $success = "CTA sections updated!";
}

// Handle Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_cta'])) {
    $key = $conn->real_escape_string($_POST['cta_key']);
    $title = $conn->real_escape_string($_POST['cta_title']);
    $desc = $conn->real_escape_string($_POST['cta_description']);
    $btn_text = $conn->real_escape_string($_POST['cta_button_text']);
    $btn_link = $conn->real_escape_string($_POST['cta_button_link']);
    
    $conn->query("INSERT INTO cta_sections (cta_key, cta_title, cta_description, cta_button_text, cta_button_link) VALUES ('$key', '$title', '$desc', '$btn_text', '$btn_link')");
    $success = "CTA added!";
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM cta_sections WHERE id = $id");
    $success = "CTA deleted.";
}

$ctas = $conn->query("SELECT * FROM cta_sections");

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
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Add CTA Section</h2>
        <form method="POST">
            <input type="hidden" name="add_cta" value="1">
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">CTA Key</label>
                <input type="text" name="cta_key" placeholder="e.g., membership" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Title</label>
                <input type="text" name="cta_title" placeholder="e.g., Ready to Join?" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Description</label>
                <textarea name="cta_description" rows="3" placeholder="Call to action description" class="input"></textarea>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Button Text</label>
                <input type="text" name="cta_button_text" placeholder="e.g., Apply Now" class="input">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Button Link</label>
                <input type="text" name="cta_button_link" placeholder="e.g., pages/membership.php" class="input">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined">add</span>
                Add CTA
            </button>
        </form>
    </div>

    <!-- List -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">All CTA Sections</h2>
        <form method="POST">
            <input type="hidden" name="update_cta" value="1">
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <?php while($c = $ctas->fetch_assoc()): ?>
                <div style="background: #fafaf3; padding: 20px; border-radius: 12px; border: 1px solid #e3e3dd;">
                    <div style="margin-bottom: 12px;">
                        <label style="display: block; margin-bottom: 4px; font-weight: 600; font-size: 12px;">Title</label>
                        <input type="text" name="cta_title[<?php echo $c['id']; ?>]" value="<?php echo htmlspecialchars($c['cta_title']); ?>" style="width: 100%; padding: 10px; border: 1px solid #e3e3dd; border-radius: 8px;">
                    </div>
                    <div style="margin-bottom: 12px;">
                        <label style="display: block; margin-bottom: 4px; font-weight: 600; font-size: 12px;">Description</label>
                        <textarea name="cta_description[<?php echo $c['id']; ?>]" rows="2" style="width: 100%; padding: 10px; border: 1px solid #e3e3dd; border-radius: 8px; font-family: inherit;"><?php echo htmlspecialchars($c['cta_description']); ?></textarea>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                        <div>
                            <label style="display: block; margin-bottom: 4px; font-weight: 600; font-size: 12px;">Button Text</label>
                            <input type="text" name="cta_button_text[<?php echo $c['id']; ?>]" value="<?php echo htmlspecialchars($c['cta_button_text']); ?>" style="width: 100%; padding: 10px; border: 1px solid #e3e3dd; border-radius: 8px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 4px; font-weight: 600; font-size: 12px;">Button Link</label>
                            <input type="text" name="cta_button_link[<?php echo $c['id']; ?>]" value="<?php echo htmlspecialchars($c['cta_button_link']); ?>" style="width: 100%; padding: 10px; border: 1px solid #e3e3dd; border-radius: 8px;">
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 14px;">
                            <input type="checkbox" name="cta_visible[<?php echo $c['id']; ?>]" <?php echo $c['is_visible'] ? 'checked' : ''; ?>>
                            Visible
                        </label>
                        <a href="cta.php?delete=<?php echo $c['id']; ?>" onclick="return confirm('Delete?')" style="color: #ba1a1a;">
                            <span class="material-symbols-outlined">delete</span>
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 24px;">
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
    div[style*="grid-template-columns: 1fr 1fr"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>