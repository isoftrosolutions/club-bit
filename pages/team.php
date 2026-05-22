<?php 
$pageTitle = "Our Team";
include '../includes/header.php'; 
?>

<section class="relative min-h-[360px] md:min-h-[614px] flex items-center overflow-hidden py-lg md:py-0">
    <div class="absolute inset-0 z-0">
        <img alt="Engineering Team" class="w-full h-full object-cover opacity-20 grayscale" src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80">
    </div>
    <div class="relative z-10 max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop w-full">
        <div class="max-w-2xl">
            <span class="inline-block bg-primary text-on-primary px-xs py-1 text-label-md font-label-md mb-md">LEADERSHIP</span>
            <h1 class="font-display text-display mb-sm text-on-background">Meet the <span class="text-primary">Executive Board</span></h1>
            <p class="font-body-lg text-body-lg text-secondary">The minds steering Club Abhiyanta-BIT toward innovation, excellence, and engineering breakthroughs.</p>
        </div>
    </div>
</section>

<section class="py-xl bg-surface-container-low">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
        <?php
        $team_query = $conn->query("SELECT * FROM leadership_team ORDER BY hierarchy_order ASC, name ASC");
        if($team_query && $team_query->num_rows > 0):
        ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-gutter">
            <?php while($m = $team_query->fetch_assoc()): ?>
            <div class="bg-surface-container-lowest rounded-xl border border-surface-variant overflow-hidden group hover:shadow-lg transition-all duration-300">
                <div class="relative overflow-hidden bg-surface-container">
                    <?php if(!empty($m['image'])): ?>
                        <img alt="<?php echo $m['name']; ?>" class="w-full aspect-[4/5] object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-105" src="../<?php echo $m['image']; ?>">
                    <?php else: ?>
                        <img alt="<?php echo $m['name']; ?>" class="w-full aspect-[4/5] object-cover grayscale group-hover:grayscale-0 transition-all duration-500" src="https://ui-avatars.com/api/?name=<?php echo urlencode($m['name']); ?>&background=a10014&color=fff&size=400">
                    <?php endif; ?>
                </div>
                <div class="p-md">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-1"><?php echo $m['name']; ?></h3>
                    <p class="text-primary font-label-md text-label-md mb-2"><?php echo strtoupper($m['position']); ?></p>
                    <?php if(!empty($m['email'])): ?>
                        <p class="font-body-md text-body-md text-secondary flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">mail</span>
                            <?php echo $m['email']; ?>
                        </p>
                    <?php endif; ?>
                    <?php if(!empty($m['phone'])): ?>
                        <p class="font-body-md text-body-md text-secondary flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">call</span>
                            <?php echo $m['phone']; ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-xl">
            <span class="material-symbols-outlined text-6xl text-secondary mb-md">groups</span>
            <h3 class="font-headline-md text-headline-md text-on-surface mb-sm">Leadership Team Coming Soon</h3>
            <p class="font-body-lg text-body-lg text-secondary max-w-md mx-auto">Our executive board is being assembled. Check back soon to meet the team driving innovation at Club Abhiyanta-BIT.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
