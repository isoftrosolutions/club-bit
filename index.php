<?php
include 'includes/header.php';

$pageTitle = "Home";

// Get dynamic data
$settings = getAllSettings();
$stats = getStats();
$sections = getHomeSections();
$ctas = getCTASections();
?>

<style>
    .structural-line {
        background: repeating-linear-gradient(90deg, #e5bdba33 0px, #e5bdba33 1px, transparent 1px, transparent 40px);
    }
</style>

<!-- Hero Section -->
<section class="relative min-h-[480px] md:min-h-[600px] flex items-center overflow-hidden structural-line">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop grid md:grid-cols-2 gap-xl items-center py-xl">
        <div class="z-10">
            <div class="inline-block px-3 py-1 bg-primary/10 text-primary font-label-md rounded-full mb-6">
                ESTABLISHED <?php echo getSetting('established_year', '2024'); ?> • <?php echo getSetting('address', 'BIRGUNJ, NEPAL'); ?>
            </div>
            <h1 class="font-display text-display text-on-background mb-4">
                <?php echo getSetting('club_name', 'CLUB ABHIYANTA'); ?><span class="text-primary">-BIT</span>
            </h1>
            <p class="font-headline-md text-secondary mb-6 italic"><?php echo getSetting('hero_tagline', 'Innovate • Build • Inspire'); ?></p>
            <p class="text-body-lg text-secondary mb-10 max-w-lg">
                <?php echo getSetting('hero_description', 'A premium engineering research and innovation hub dedicated to precision engineering, IoT, and Robotics.'); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-md">
                <button class="bg-primary text-on-primary px-8 py-4 rounded-lg font-label-md text-lg hover:shadow-lg transition-all w-full sm:w-auto" onclick="window.location.href='<?php echo getSetting('cta_button_link', 'pages/membership.php'); ?>'">
                    <?php echo getSetting('cta_button_text', 'Join Club'); ?>
                </button>
                <button class="bg-white border border-secondary/20 text-secondary px-8 py-4 rounded-lg font-label-md text-lg hover:bg-surface-container-low transition-all w-full sm:w-auto" onclick="window.location.href='<?php echo getSetting('secondary_cta_link', 'pages/about.php'); ?>'">
                    <?php echo getSetting('secondary_cta_text', 'Explore Activities'); ?>
                </button>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-primary/5 rounded-full blur-3xl"></div>
            <img alt="Club Image" class="relative rounded-xl border border-outline-variant/30 shadow-sm z-10 w-full object-cover aspect-square" src="<?php echo getSetting('hero_image', 'assets/images/hero-image.jpeg'); ?>">
        </div>
    </div>
</section>

<!-- Stats Section -->
<?php if (!empty($stats)): ?>
<section class="bg-surface-container-lowest py-xl border-y border-outline-variant/20" id="about">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="grid grid-cols-2 md:grid-cols-<?php echo count($stats); ?> gap-gutter text-center mb-xl">
            <?php foreach ($stats as $stat): ?>
            <div>
                <div class="text-display text-primary"><?php echo $stat['stat_value']; ?></div>
                <div class="font-label-md text-secondary"><?php echo $stat['stat_label']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>
<?php else: ?>
<section class="bg-surface-container-lowest py-xl border-y border-outline-variant/20" id="about">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-gutter text-center mb-xl">
            <div>
                <div class="text-display text-primary">100+</div>
                <div class="font-label-md text-secondary">ACTIVE MEMBERS</div>
            </div>
            <div>
                <div class="text-display text-primary">30+</div>
                <div class="font-label-md text-secondary">ANNUAL EVENTS</div>
            </div>
            <div>
                <div class="text-display text-primary">12</div>
                <div class="font-label-md text-secondary">R&D PROJECTS</div>
            </div>
            <div>
                <div class="text-display text-primary">30+</div>
                <div class="font-label-md text-secondary">WORKSHOPS</div>
            </div>
        </div>
<?php endif; ?>

        <!-- Home Sections -->
        <?php if (!empty($sections)): ?>
        <div class="grid md:grid-cols-3 gap-gutter">
            <?php foreach ($sections as $section): ?>
            <div class="bg-white p-lg rounded-xl border border-outline-variant/30 hover:border-primary/40 transition-colors">
                <span class="material-symbols-outlined text-primary text-4xl mb-4"><?php echo $section['icon']; ?></span>
                <h3 class="font-headline-md mb-4"><?php echo $section['section_title']; ?></h3>
                <p class="text-secondary text-body-md"><?php echo $section['section_content']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="grid md:grid-cols-3 gap-gutter">
            <div class="bg-white p-lg rounded-xl border border-outline-variant/30 hover:border-primary/40 transition-colors">
                <span class="material-symbols-outlined text-primary text-4xl mb-4">history</span>
                <h3 class="font-headline-md mb-4">History</h3>
                <p class="text-secondary text-body-md">Founded by visionary engineers at BIT, starting as a small workshop and evolving into the region's premier technical club.</p>
            </div>
            <div class="bg-white p-lg rounded-xl border border-outline-variant/30 hover:border-primary/40 transition-colors">
                <span class="material-symbols-outlined text-primary text-4xl mb-4">rocket_launch</span>
                <h3 class="font-headline-md mb-4">Mission</h3>
                <p class="text-secondary text-body-md">To foster a culture of hands-on learning and technological breakthrough through collaborative engineering projects.</p>
            </div>
            <div class="bg-white p-lg rounded-xl border border-outline-variant/30 hover:border-primary/40 transition-colors">
                <span class="material-symbols-outlined text-primary text-4xl mb-4">visibility</span>
                <h3 class="font-headline-md mb-4">Vision</h3>
                <p class="text-secondary text-body-md">Creating a sustainable ecosystem where innovation meets real-world industrial application for future-ready engineers.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php 
// Continue with rest of original index.php
$top_team = $conn->query("SELECT * FROM leadership_team ORDER BY hierarchy_order ASC, name ASC LIMIT 4");
$gallery = $conn->query("SELECT * FROM gallery ORDER BY upload_date DESC LIMIT 6");
$programs = $conn->query("SELECT * FROM programs WHERE is_visible = 1 ORDER BY sort_order ASC LIMIT 3");
$projects = $conn->query("SELECT * FROM projects WHERE is_visible = 1 AND is_featured = 1 ORDER BY sort_order ASC LIMIT 4");
?>

<section class="py-xl">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex flex-col md:flex-row justify-between items-end mb-lg">
            <div>
                <span class="text-primary font-label-md uppercase tracking-widest">Our Leadership</span>
                <h2 class="font-display text-headline-lg text-on-background mt-sm">Executive <span class="text-primary">Team</span></h2>
            </div>
            <a href="pages/team.php" class="text-secondary font-label-md hover:text-primary transition-colors flex items-center gap-xs mt-md md:mt-0">
                View All <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>

        <?php if($top_team && $top_team->num_rows > 0): ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-lg">
            <?php while($m = $top_team->fetch_assoc()): ?>
            <div class="bg-surface-container-low rounded-xl p-lg border border-outline-variant/20 hover:border-primary/40 transition-all group">
                <div class="relative mb-md">
                    <?php if(!empty($m['image'])): ?>
                        <img src="<?php echo $m['image']; ?>" alt="<?php echo $m['name']; ?>" class="w-full aspect-square object-cover rounded-lg">
                    <?php else: ?>
                        <div class="w-full aspect-square bg-surface-container-high rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-6xl text-secondary">person</span>
                        </div>
                    <?php endif; ?>
                </div>
                <h3 class="font-headline-md text-on-background mb-xs"><?php echo $m['name']; ?></h3>
                <p class="text-primary font-label-md"><?php echo $m['position']; ?></p>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
        <p class="text-secondary text-center py-xl">No team members yet.</p>
        <?php endif; ?>
    </div>
</section>

<?php if(getSetting('programs_section_enabled', '1') == '1'): ?>
<section class="py-xl bg-surface-container-low">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex flex-col md:flex-row justify-between items-end mb-lg">
            <div>
                <span class="text-primary font-label-md uppercase tracking-widest">Learn & Grow</span>
                <h2 class="font-display text-headline-lg text-on-background mt-sm">Our <span class="text-primary">Programmes</span></h2>
            </div>
            <a href="pages/programmes.php" class="text-secondary font-label-md hover:text-primary transition-colors flex items-center gap-xs mt-md md:mt-0">
                All Programmes <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-lg">
            <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant/20 hover:border-primary/40 transition-all">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined text-primary text-3xl">school</span>
                </div>
                <h3 class="font-headline-md text-on-background mb-sm">Technical Workshops</h3>
                <p class="text-secondary text-body-md">Hands-on sessions covering IoT, Robotics, AI, and more.</p>
            </div>
            <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant/20 hover:border-primary/40 transition-all">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined text-primary text-3xl">science</span>
                </div>
                <h3 class="font-headline-md text-on-background mb-sm">Innovation Projects</h3>
                <p class="text-secondary text-body-md">Real-world R&D projects for practical experience.</p>
            </div>
            <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant/20 hover:border-primary/40 transition-all">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-md">
                    <span class="material-symbols-outlined text-primary text-3xl">groups</span>
                </div>
                <h3 class="font-headline-md text-on-background mb-sm">Community Events</h3>
                <p class="text-secondary text-body-md">Tech talks, hackathons, and collaborative activities.</p>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if(getSetting('projects_section_enabled', '1') == '1'): ?>
<section class="py-xl">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex flex-col md:flex-row justify-between items-end mb-lg">
            <div>
                <span class="text-primary font-label-md uppercase tracking-widest">What We Build</span>
                <h2 class="font-display text-headline-lg text-on-background mt-sm">Innovation <span class="text-primary">Projects</span></h2>
            </div>
            <a href="pages/projects.php" class="text-secondary font-label-md hover:text-primary transition-colors flex items-center gap-xs mt-md md:mt-0">
                All Projects <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-lg">
            <div class="group cursor-pointer">
                <div class="aspect-video bg-surface-container-low rounded-xl mb-sm overflow-hidden relative">
                    <div class="absolute inset-0 bg-primary/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-white text-5xl">visibility</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=400&h=300&fit=crop" class="w-full h-full object-cover">
                </div>
                <h3 class="font-headline-md text-on-background">Robotics Lab</h3>
                <p class="text-secondary text-body-sm">Autonomous robots for various applications.</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video bg-surface-container-low rounded-xl mb-sm overflow-hidden relative">
                    <div class="absolute inset-0 bg-primary/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-white text-5xl">visibility</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=400&h=300&fit=crop" class="w-full h-full object-cover">
                </div>
                <h3 class="font-headline-md text-on-background">IoT Platform</h3>
                <p class="text-secondary text-body-sm">Smart connectivity solutions.</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video bg-surface-container-low rounded-xl mb-sm overflow-hidden relative">
                    <div class="absolute inset-0 bg-primary/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-white text-5xl">visibility</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1555255707-c07966088b7b?w=400&h=300&fit=crop" class="w-full h-full object-cover">
                </div>
                <h3 class="font-headline-md text-on-background">AI Systems</h3>
                <p class="text-secondary text-body-sm">Machine learning implementations.</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video bg-surface-container-low rounded-xl mb-sm overflow-hidden relative">
                    <div class="absolute inset-0 bg-primary/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-white text-5xl">visibility</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400&h=300&fit=crop" class="w-full h-full object-cover">
                </div>
                <h3 class="font-headline-md text-on-background">Drone Tech</h3>
                <p class="text-secondary text-body-sm">Aerial automation research.</p>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if(!empty($gallery) && $gallery->num_rows > 0): ?>
<section class="py-xl bg-surface-container-low">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex flex-col md:flex-row justify-between items-end mb-lg">
            <div>
                <span class="text-primary font-label-md uppercase tracking-widest">Captured Moments</span>
                <h2 class="font-display text-headline-lg text-on-background mt-sm">Club <span class="text-primary">Gallery</span></h2>
            </div>
            <a href="pages/gallery.php" class="text-secondary font-label-md hover:text-primary transition-colors flex items-center gap-xs mt-md md:mt-0">
                View All <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-md">
            <?php while($g = $gallery->fetch_assoc()): ?>
            <div class="group cursor-pointer relative aspect-video rounded-xl overflow-hidden">
                <img src="<?php echo $g['image_path']; ?>" alt="<?php echo $g['title']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-md">
                    <div class="text-white">
                        <h4 class="font-headline-md"><?php echo $g['title']; ?></h4>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if(!empty($ctas)): ?>
<?php foreach($ctas as $cta): ?>
<section class="py-xl bg-primary text-on-primary">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop text-center">
        <h2 class="font-display text-headline-lg mb-md"><?php echo $cta['cta_title']; ?></h2>
        <p class="text-body-lg mb-lg max-w-2xl mx-auto opacity-90"><?php echo $cta['cta_description']; ?></p>
        <button class="bg-white text-primary px-lg py-sm font-label-md text-label-md rounded-full shadow-lg hover:scale-105 transition-transform" onclick="window.location.href='<?php echo $cta['cta_button_link']; ?>'">
            <?php echo $cta['cta_button_text']; ?>
        </button>
    </div>
</section>
<?php endforeach; ?>
<?php else: ?>
<section class="py-xl bg-primary text-on-primary" id="membership">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop text-center">
        <h2 class="font-display text-headline-lg mb-md">Ready to Join Our Community?</h2>
        <p class="text-body-lg mb-lg max-w-2xl mx-auto opacity-90">Become part of a vibrant community of innovators and future engineers. Apply today!</p>
        <button class="bg-white text-primary px-lg py-sm font-label-md text-label-md rounded-full shadow-lg hover:scale-105 transition-transform" onclick="window.location.href='pages/membership.php'">Apply for Membership</button>
    </div>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>