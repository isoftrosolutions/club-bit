<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Gallery';
$pageSubtitle = 'Manage gallery images';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $desc = $conn->real_escape_string($_POST['description']);
    
    $target_dir = "../assets/images/gallery/";
    if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
    
    $filename = time() . '_' . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $filename;
    $db_path = "assets/images/gallery/" . $filename;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO gallery (title, description, image_path) VALUES ('$title', '$desc', '$db_path')";
        if ($conn->query($sql)) { $success = "Image uploaded successfully!"; }
        else { $error = "Error: " . $conn->error; }
    } else {
        $error = "Error uploading file.";
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $img = $conn->query("SELECT image_path FROM gallery WHERE id = $id")->fetch_assoc();
    if ($img && file_exists("../" . $img['image_path'])) {
        unlink("../" . $img['image_path']);
    }
    $conn->query("DELETE FROM gallery WHERE id = $id");
    $success = "Image deleted.";
}

$gallery_items = $conn->query("SELECT * FROM gallery ORDER BY upload_date DESC");

include 'includes/layout.php';
?>

<?php if ($success): ?>
<div style="background: #ffddda; color: #a10014; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #e5bdba; display: flex; align-items: center; gap: 12px;">
    <span class="material-symbols-outlined">check_circle</span>
    <?php echo $success; ?>
</div>
<?php endif; ?>

<?php if ($error): ?>
<div style="background: #ffdad6; color: #93000a; padding: 16px; border-radius: 12px; margin-bottom: 24px; border: 1px solid #ba1a1a; display: flex; align-items: center; gap: 12px;">
    <span class="material-symbols-outlined">error</span>
    <?php echo $error; ?>
</div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 350px 1fr; gap: 24px;">
    <!-- Upload Form -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Upload Image</h2>
        <form action="gallery.php" method="POST" enctype="multipart/form-data">
            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Image File</label>
                <input type="file" name="image" accept="image/*" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Title</label>
                <input type="text" name="title" placeholder="Image title" class="input" required>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Description</label>
                <textarea name="description" rows="3" class="input" placeholder="Optional description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined">cloud_upload</span>
                Upload Image
            </button>
        </form>
    </div>

    <!-- Gallery Grid -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Gallery Images (<?php echo $gallery_items->num_rows; ?>)</h2>
        <?php if($gallery_items && $gallery_items->num_rows > 0): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px;">
                <?php while($g = $gallery_items->fetch_assoc()): ?>
                <div style="background: #fafaf3; border-radius: 12px; overflow: hidden; border: 1px solid #e3e3dd;">
                    <img src="../<?php echo $g['image_path']; ?>" style="width: 100%; height: 140px; object-fit: cover;">
                    <div style="padding: 12px;">
                        <h3 style="font-size: 14px; font-weight: 600; margin-bottom: 4px;"><?php echo htmlspecialchars($g['title']); ?></h3>
                        <p style="font-size: 12px; color: #5c403d; margin-bottom: 8px;"><?php echo htmlspecialchars($g['description']); ?></p>
                        <a href="gallery.php?delete=<?php echo $g['id']; ?>" onclick="return confirm('Delete this image?')" style="color: #ba1a1a; font-size: 12px; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 4px;">
                            <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                            Delete
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; padding: 48px; color: #5c403d;">No images in gallery yet.</p>
        <?php endif; ?>
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