<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_res = $conn->query("SELECT * FROM members WHERE id = $user_id");
$user = $user_res->fetch_assoc();

$pageTitle = "User Dashboard";
include '../includes/header.php';
?>

<main class="pt-32 pb-xl">
    <section class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="mb-xl">
            <span class="text-primary font-label-md uppercase tracking-widest">Welcome Back</span>
            <h1 class="font-display text-display text-on-surface mt-sm"><?php echo explode(' ', $user['name'])[0]; ?>'s Dashboard</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
            <!-- Profile Sidebar -->
            <div class="bg-white border border-surface-variant rounded-xl p-lg">
                <div class="text-center mb-lg">
                    <div class="w-32 h-32 mx-auto mb-md rounded-xl overflow-hidden border-4 border-surface-container">
                        <?php if(!empty($user['profile_image'])): ?>
                            <img src="../<?php echo $user['profile_image']; ?>" alt="Profile" class="w-full h-full object-cover">
                        <?php else: ?>
                            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['name']); ?>&background=a10014&color=fff&size=128" alt="Profile" class="w-full h-full object-cover">
                        <?php endif; ?>
                    </div>
                    <h2 class="font-headline-md text-on-surface"><?php echo $user['name']; ?></h2>
                    <p class="text-primary font-label-md">CLUB MEMBER</p>
                </div>

                <div class="border-t border-surface-variant pt-md">
                    <div class="space-y-sm">
                        <div class="flex items-center gap-sm text-secondary">
                            <span class="material-symbols-outlined text-[20px]">mail</span>
                            <span class="font-body-md"><?php echo $user['email']; ?></span>
                        </div>
                        <div class="flex items-center gap-sm text-secondary">
                            <span class="material-symbols-outlined text-[20px]">call</span>
                            <span class="font-body-md"><?php echo $user['phone'] ?? 'Not provided'; ?></span>
                        </div>
                        <div class="flex items-center gap-sm text-secondary">
                            <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                            <span class="font-body-md">Joined <?php echo date('M Y', strtotime($user['created_at'])); ?></span>
                        </div>
                        <?php if(!empty($user['faculty'])): ?>
                        <div class="flex items-center gap-sm text-secondary">
                            <span class="material-symbols-outlined text-[20px]">school</span>
                            <span class="font-body-md"><?php echo $user['faculty']; ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="mt-lg">
                    <a href="logout.php" class="border border-red-600 text-red-600 w-full py-sm rounded-lg font-label-md flex items-center justify-center gap-sm hover:bg-red-50 transition-all">
                        <span class="material-symbols-outlined">logout</span>
                        Logout
                    </a>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-gutter">
                <div class="bg-white border border-surface-variant rounded-xl p-lg">
                    <h3 class="font-headline-md text-on-surface mb-md">Member Status</h3>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-md">
                        <div class="bg-green-100 text-green-700 px-md py-sm rounded-lg font-label-md flex items-center gap-xs">
                            <span class="material-symbols-outlined">verified</span>
                            ACTIVE
                        </div>
                        <p class="text-secondary font-body-md">Your membership is verified and active. You have full access to club resources.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                    <div class="bg-white border border-surface-variant rounded-xl p-lg hover:border-primary/40 transition-colors">
                        <div class="flex items-center gap-sm mb-md">
                            <span class="material-symbols-outlined text-primary text-2xl">library_books</span>
                            <h3 class="font-headline-md text-on-surface">Resources</h3>
                        </div>
                        <p class="text-secondary font-body-md mb-md">Access exclusive learning materials and project guides.</p>
                        <button class="border border-on-surface text-on-surface w-full py-sm rounded-lg font-label-md hover:bg-surface-container-high transition-colors">
                            Coming Soon
                        </button>
                    </div>
                    <div class="bg-white border border-surface-variant rounded-xl p-lg hover:border-primary/40 transition-colors">
                        <div class="flex items-center gap-sm mb-md">
                            <span class="material-symbols-outlined text-primary text-2xl">event</span>
                            <h3 class="font-headline-md text-on-surface">Events</h3>
                        </div>
                        <p class="text-secondary font-body-md mb-md">Register for upcoming hackathons and workshops.</p>
                        <button class="border border-on-surface text-on-surface w-full py-sm rounded-lg font-label-md hover:bg-surface-container-high transition-colors" onclick="window.location.href='programmes.php'">
                            View Events
                        </button>
                    </div>
                </div>

                <?php if(!empty($user['interests'])): ?>
                <div class="bg-surface-container-low rounded-xl p-lg">
                    <h3 class="font-headline-md text-on-surface mb-md">Your Interests</h3>
                    <div class="flex flex-wrap gap-xs">
                        <?php 
                        $interests = explode(", ", $user['interests']);
                        foreach($interests as $interest):
                        ?>
                            <span class="bg-primary/10 text-primary px-sm py-xs rounded font-label-md text-label-md"><?php echo trim($interest); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>