<?php 
require_once __DIR__ . '/../includes/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_role'] = $admin['role'];

            header('Location: ../admin/dashboard.php');
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $sql = "SELECT * FROM members WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($user['status'] !== 'active') {
                $error = "Your account is pending admin approval.";
            } else if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No account found with that username.";
        }
    }
}

$pageTitle = "Login";
include '../includes/header.php'; 
?>

<main class="pt-24 pb-lg px-4 sm:px-6 lg:px-8">
    <section class="max-w-[450px] mx-auto w-full">
        <div class="bg-surface-container-lowest border border-surface-variant rounded-xl p-6 sm:p-lg lg:p-xl">
            <div class="text-center mb-6 sm:mb-lg">
                <span class="text-primary font-label-md uppercase tracking-widest text-sm">Welcome Back</span>
                <h1 class="font-display text-2xl sm:text-headline-lg text-on-surface mt-2 sm:mt-sm">Account Login</h1>
            </div>

            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 sm:mb-md flex items-center gap-2 text-sm sm:text-base">
                    <span class="material-symbols-outlined text-lg">error</span>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="flex flex-col gap-2 sm:gap-xs mb-4 sm:mb-md">
                    <label class="font-label-md text-on-surface text-sm sm:text-base">Username</label>
                    <input class="w-full bg-background border border-surface-variant px-4 py-3 sm:py-sm focus:ring-0 focus:border-on-surface outline-none transition-all rounded-lg text-base" type="text" name="email" placeholder="Enter your username" required>
                </div>
                
                <div class="flex flex-col gap-2 sm:gap-xs mb-6 sm:mb-lg">
                    <label class="font-label-md text-on-surface text-sm sm:text-base">Password</label>
                    <input class="w-full bg-background border border-surface-variant px-4 py-3 sm:py-sm focus:ring-0 focus:border-on-surface outline-none transition-all rounded-lg text-base" type="password" name="password" placeholder="Enter your password" required>
                </div>
                
                <button type="submit" class="bg-primary text-on-primary w-full py-3 sm:py-md rounded-lg font-label-md text-base sm:text-lg hover:bg-primary-container transition-all flex items-center justify-center gap-2 sm:gap-sm">
                    <span class="material-symbols-outlined">login</span>
                    Login
                </button>
                
                <div class="text-center mt-6 sm:mt-lg text-sm sm:text-base text-secondary">
                    Don't have an account? <a href="membership.php" class="text-primary font-bold hover:underline">Sign up here</a>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>