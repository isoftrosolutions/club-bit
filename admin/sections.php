<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Home Sections';
$pageSubtitle = 'Manage homepage sections (History, Mission, Vision)';

// Handle Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_sections'])) {
    foreach ($_POST['section_title'] as $id => $title) {
        $id = intval($id);
        $title = $conn->real_escape_string($title);
        $subtitle = $conn->real_escape_string($_POST['section_subtitle'][$id]);
        $content = $conn->real_escape_string($_POST['section_content'][$id]);
        $icon = $conn->real_escape_string($_POST['section_icon'][$id]);
        $order = intval($_POST['section_order'][$id]);
        $visible = isset($_POST['section_visible'][$id]) ? 1 : 0;
        
        $conn->query("UPDATE home_sections SET section_title='$title', section_subtitle='$subtitle', section_content='$content', icon='$icon', sort_order=$order, is_visible=$visible WHERE id=$id");
    }
    $success = "Sections updated!";
}

// Handle Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_section'])) {
    $key = $conn->real_escape_string($_POST['section_key']);
    $title = $conn->real_escape_string($_POST['section_title']);
    $subtitle = $conn->real_escape_string($_POST['section_subtitle']);
    $content = $conn->real_escape_string($_POST['section_content']);
    $icon = $conn->real_escape_string($_POST['icon']);
    $order = intval($_POST['sort_order']);
    
    $conn->query("INSERT INTO home_sections (section_key, section_title, section_subtitle, section_content, icon, sort_order) VALUES ('$key', '$title', '$subtitle', '$content', '$icon', $order)");
    $success = "Section added!";
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM home_sections WHERE id = $id");
    $success = "Section deleted.";
}

$sections = $conn->query("SELECT * FROM home_sections ORDER BY sort_order ASC");

include 'includes/layout.php';
?>

<?php if (isset($success)): ?>
<div style="background: #ffddda; color: #a10014; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e5bdba; display: flex; align-items: center; gap: 12px;">
    <span class="material-symbols-outlined">check_circle</span>
    <?php echo $success; ?>
</div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 350px 1fr; gap: 24px;">
    <!-- Add New Section -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Add New Section</h2>
        <form method="POST">
            <input type="hidden" name="add_section" value="1">
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Section Key (unique)</label>
                <input type="text" name="section_key" placeholder="e.g., history" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Title</label>
                <input type="text" name="section_title" placeholder="e.g., History" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Subtitle (optional)</label>
                <input type="text" name="section_subtitle" placeholder="e.g., Our Journey" class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Content</label>
                <textarea name="section_content" rows="3" placeholder="Section description" class="input"></textarea>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Icon (Material Symbol)</label>
                <input type="text" name="icon" placeholder="e.g., history" class="input">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Sort Order</label>
                <input type="number" name="sort_order" value="0" class="input">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined">add</span>
                Add Section
            </button>
        </form>
    </div>

    <!-- Sections List -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">All Sections</h2>
        <form method="POST">
            <input type="hidden" name="update_sections" value="1">
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <?php while($s = $sections->fetch_assoc()): ?>
                <div style="background: #fafaf3; padding: 20px; border-radius: 12px; border: 1px solid #e3e3dd;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                        <div>
                            <label style="display: block; margin-bottom: 4px; font-weight: 600; font-size: 12px;">Title</label>
                            <input type="text" name="section_title[<?php echo $s['id']; ?>]" value="<?php echo htmlspecialchars($s['section_title']); ?>" style="width: 100%; padding: 10px; border: 1px solid #e3e3dd; border-radius: 8px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 4px; font-weight: 600; font-size: 12px;">Icon</label>
                            <input type="text" name="section_icon[<?php echo $s['id']; ?>]" value="<?php echo htmlspecialchars($s['icon']); ?>" style="width: 100%; padding: 10px; border: 1px solid #e3e3dd; border-radius: 8px;">
                        </div>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <label style="display: block; margin-bottom: 4px; font-weight: 600; font-size: 12px;">Content</label>
                        <textarea name="section_content[<?php echo $s['id']; ?>]" rows="2" style="width: 100%; padding: 10px; border: 1px solid #e3e3dd; border-radius: 8px; font-family: inherit;"><?php echo htmlspecialchars($s['section_content']); ?></textarea>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; align-items: center; gap: 16px;">
                            <div>
                                <label style="display: block; margin-bottom: 4px; font-weight: 600; font-size: 12px;">Order</label>
                                <input type="number" name="section_order[<?php echo $s['id']; ?>]" value="<?php echo $s['sort_order']; ?>" style="width: 60px; padding: 8px; border: 1px solid #e3e3dd; border-radius: 8px;">
                            </div>
                            <label style="display: flex; align-items: center; gap: 6px; font-size: 14px;">
                                <input type="checkbox" name="section_visible[<?php echo $s['id']; ?>]" <?php echo $s['is_visible'] ? 'checked' : ''; ?>>
                                Visible
                            </label>
                        </div>
                        <a href="sections.php?delete=<?php echo $s['id']; ?>" onclick="return confirm('Delete this section?')" style="color: #ba1a1a;">
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