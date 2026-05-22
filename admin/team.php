<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../pages/login.php');
    exit;
}

$pageTitle = 'Team';
$pageSubtitle = 'Manage leadership team members';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $position = $conn->real_escape_string($_POST['position']);
    $hierarchy = intval($_POST['hierarchy_order']);
    
    $image_sql = "";
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $target_dir = "../assets/images/team/";
        if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
        $filename = time() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $filename;
        $db_path = "assets/images/team/" . $filename;
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_sql = ", image = '$db_path'";
            if ($_POST['action'] == 'edit') {
                $id = intval($_POST['id']);
                $old = $conn->query("SELECT image FROM leadership_team WHERE id = $id")->fetch_assoc();
                if ($old && !empty($old['image']) && file_exists("../" . $old['image'])) {
                    unlink("../" . $old['image']);
                }
            }
        }
    }

    if ($_POST['action'] == 'add') {
        $sql = "INSERT INTO leadership_team (name, email, phone, position, hierarchy_order, image) 
                VALUES ('$name', '$email', '$phone', '$position', $hierarchy, '$db_path')";
        if ($conn->query($sql)) { $success = "Team member added!"; }
        else { $error = "Error: " . $conn->error; }
    } elseif ($_POST['action'] == 'edit') {
        $id = intval($_POST['id']);
        $sql = "UPDATE leadership_team SET name='$name', email='$email', phone='$phone', position='$position', hierarchy_order=$hierarchy $image_sql WHERE id=$id";
        if ($conn->query($sql)) { $success = "Team member updated!"; }
        else { $error = "Error: " . $conn->error; }
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $old = $conn->query("SELECT image FROM leadership_team WHERE id = $id")->fetch_assoc();
    if ($old && !empty($old['image']) && file_exists("../" . $old['image'])) {
        unlink("../" . $old['image']);
    }
    $conn->query("DELETE FROM leadership_team WHERE id = $id");
    $success = "Team member removed.";
}

$edit_member = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM leadership_team WHERE id = $id");
    if ($res) { $edit_member = $res->fetch_assoc(); }
}

$team = $conn->query("SELECT * FROM leadership_team ORDER BY hierarchy_order ASC");

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

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px;">
    <!-- Team Member Form -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;"><?php echo $edit_member ? 'Edit Team Member' : 'Add Team Member'; ?></h2>
        <form action="team.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?php echo $edit_member ? 'edit' : 'add'; ?>">
            <?php if($edit_member): ?>
                <input type="hidden" name="id" value="<?php echo $edit_member['id']; ?>">
            <?php endif; ?>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Photo</label>
                <?php if($edit_member && !empty($edit_member['image'])): ?>
                    <img src="../<?php echo $edit_member['image']; ?>" style="width: 60px; height: 60px; border-radius: 12px; object-fit: cover; margin-bottom: 8px;">
                <?php endif; ?>
                <input type="file" name="image" accept="image/*" class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Full Name</label>
                <input type="text" name="name" value="<?php echo $edit_member ? htmlspecialchars($edit_member['name']) : ''; ?>" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Position</label>
                <input type="text" name="position" value="<?php echo $edit_member ? htmlspecialchars($edit_member['position']) : ''; ?>" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Order/Hierarchy</label>
                <input type="number" name="hierarchy_order" value="<?php echo $edit_member ? $edit_member['hierarchy_order'] : '1'; ?>" class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Email</label>
                <input type="email" name="email" value="<?php echo $edit_member ? htmlspecialchars($edit_member['email']) : ''; ?>" class="input">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Phone</label>
                <input type="text" name="phone" value="<?php echo $edit_member ? htmlspecialchars($edit_member['phone']) : ''; ?>" class="input">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined"><?php echo $edit_member ? 'save' : 'add'; ?></span>
                <?php echo $edit_member ? 'Update' : 'Add Member'; ?>
            </button>
            
            <?php if($edit_member): ?>
                <a href="team.php" class="btn btn-secondary" style="width: 100%; margin-top: 12px; justify-content: center;">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Team Table -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">Leadership Team (<?php echo $team->num_rows; ?>)</h2>
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($team && $team->num_rows > 0): ?>
                        <?php while($t = $team->fetch_assoc()): ?>
                        <tr>
                            <td style="font-weight: 600; color: #a10014;"><?php echo $t['hierarchy_order']; ?></td>
                            <td>
                                <?php if(!empty($t['image'])): ?>
                                    <img src="../<?php echo $t['image']; ?>" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;">
                                <?php else: ?>
                                    <div style="width: 40px; height: 40px; border-radius: 8px; background: #e3e3dd; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #5c403d;">
                                        <?php echo strtoupper(substr($t['name'], 0, 1)); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight: 600;"><?php echo htmlspecialchars($t['name']); ?></td>
                            <td><span style="font-size: 13px; color: #a10014; font-weight: 600;"><?php echo htmlspecialchars($t['position']); ?></span></td>
                            <td>
                                <div style="font-size: 12px; color: #5c403d;">
                                    <?php if($t['email']): ?><?php echo htmlspecialchars($t['email']); ?><?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <a href="team.php?edit=<?php echo $t['id']; ?>" style="color: #5c403d; text-decoration: none;">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <a href="team.php?delete=<?php echo $t['id']; ?>" style="color: #ba1a1a; text-decoration: none;" onclick="return confirm('Delete this team member?')">
                                        <span class="material-symbols-outlined">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center; padding: 48px; color: #5c403d;">No team members yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
@media (max-width: 1024px) {
    div[style*="grid-template-columns: 1fr 2fr"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>