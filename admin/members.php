<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Members';
$pageSubtitle = 'Manage club members';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $status = $conn->real_escape_string($_POST['status']);
    
    $image_sql = "";
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $target_dir = "../assets/images/members/";
        if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
        $file_ext = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
        $filename = time() . '_' . $username . '.' . $file_ext;
        $target_file = $target_dir . $filename;
        $db_path = "assets/images/members/" . $filename;
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $image_sql = ", profile_image = '$db_path'";
            if ($_POST['action'] == 'edit') {
                $id = intval($_POST['id']);
                $old = $conn->query("SELECT profile_image FROM members WHERE id = $id")->fetch_assoc();
                if ($old && !empty($old['profile_image']) && file_exists("../" . $old['profile_image'])) {
                    unlink("../" . $old['profile_image']);
                }
            }
        }
    }

    if ($_POST['action'] == 'add') {
        $password = password_hash('member123', PASSWORD_DEFAULT);
        $sql = "INSERT INTO members (name, email, username, phone, password, status, profile_image) 
                VALUES ('$name', '$email', '$username', '$phone', '$password', '$status' $image_sql)";
        if ($conn->query($sql)) { $success = "Member added successfully!"; }
        else { $error = "Error: " . $conn->error; }
    } elseif ($_POST['action'] == 'edit') {
        $id = intval($_POST['id']);
        $sql = "UPDATE members SET name='$name', email='$email', username='$username', phone='$phone', status='$status' $image_sql WHERE id=$id";
        if ($conn->query($sql)) { $success = "Member updated successfully!"; }
        else { $error = "Error: " . $conn->error; }
    }
}

if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $conn->query("UPDATE members SET status = 'active' WHERE id = $id");
    $success = "Member approved!";
}
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM members WHERE id = $id");
    $success = "Member removed.";
}

$edit_member = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM members WHERE id = $id");
    if ($res) { $edit_member = $res->fetch_assoc(); }
}

$members = $conn->query("SELECT * FROM members ORDER BY created_at DESC");

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
    <!-- Member Form -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;"><?php echo $edit_member ? 'Edit Member' : 'Add New Member'; ?></h2>
        <form action="members.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?php echo $edit_member ? 'edit' : 'add'; ?>">
            <?php if($edit_member): ?>
                <input type="hidden" name="id" value="<?php echo $edit_member['id']; ?>">
            <?php endif; ?>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Profile Image</label>
                <?php if($edit_member && !empty($edit_member['profile_image'])): ?>
                    <img src="../<?php echo $edit_member['profile_image']; ?>" style="width: 60px; height: 60px; border-radius: 12px; object-fit: cover; margin-bottom: 8px;">
                <?php endif; ?>
                <input type="file" name="profile_image" accept="image/*" class="input">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Full Name</label>
                <input type="text" name="name" value="<?php echo $edit_member ? htmlspecialchars($edit_member['name']) : ''; ?>" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Username</label>
                <input type="text" name="username" value="<?php echo $edit_member ? htmlspecialchars($edit_member['username']) : ''; ?>" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Email</label>
                <input type="email" name="email" value="<?php echo $edit_member ? htmlspecialchars($edit_member['email']) : ''; ?>" class="input" required>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Phone</label>
                <input type="text" name="phone" value="<?php echo $edit_member ? htmlspecialchars($edit_member['phone']) : ''; ?>" class="input">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; font-size: 14px;">Status</label>
                <select name="status" class="input">
                    <option value="pending" <?php echo $edit_member && $edit_member['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="active" <?php echo $edit_member && $edit_member['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?php echo $edit_member && $edit_member['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <span class="material-symbols-outlined"><?php echo $edit_member ? 'save' : 'add'; ?></span>
                <?php echo $edit_member ? 'Update Member' : 'Add Member'; ?>
            </button>
            
            <?php if($edit_member): ?>
                <a href="members.php" class="btn btn-secondary" style="width: 100%; margin-top: 12px; justify-content: center;">
                    Cancel
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Members Table -->
    <div class="card">
        <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 24px;">All Members (<?php echo $members->num_rows; ?>)</h2>
        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($members && $members->num_rows > 0): ?>
                        <?php while($m = $members->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?php if(!empty($m['profile_image'])): ?>
                                    <img src="../<?php echo $m['profile_image']; ?>" style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover;">
                                <?php else: ?>
                                    <div style="width: 40px; height: 40px; border-radius: 8px; background: #e3e3dd; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #5c403d;">
                                        <?php echo strtoupper(substr($m['name'], 0, 1)); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div style="font-weight: 600;"><?php echo htmlspecialchars($m['name']); ?></div>
                                <div style="font-size: 12px; color: #5c403d;">@<?php echo htmlspecialchars($m['username']); ?></div>
                            </td>
                            <td style="font-size: 14px;"><?php echo htmlspecialchars($m['email']); ?></td>
                            <td>
                                <span class="badge <?php echo $m['status'] === 'active' ? 'badge-active' : ($m['status'] === 'pending' ? 'badge-pending' : ''); ?>">
                                    <?php echo $m['status']; ?>
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <?php if($m['status'] == 'pending'): ?>
                                        <a href="members.php?approve=<?php echo $m['id']; ?>" style="color: #10b981; text-decoration: none;" title="Approve">
                                            <span class="material-symbols-outlined">check_circle</span>
                                        </a>
                                    <?php endif; ?>
                                    <a href="members.php?edit=<?php echo $m['id']; ?>" style="color: #5c403d; text-decoration: none;" title="Edit">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <a href="members.php?delete=<?php echo $m['id']; ?>" style="color: #ba1a1a; text-decoration: none;" title="Delete" onclick="return confirm('Are you sure?')">
                                        <span class="material-symbols-outlined">delete</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="text-align: center; padding: 48px; color: #5c403d;">No members registered yet.</td></tr>
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