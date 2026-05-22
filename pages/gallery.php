<?php 
$pageTitle = "Gallery";
include '../includes/header.php'; 

$gallery = $conn->query("SELECT * FROM gallery ORDER BY created_at DESC");
?>

<style>
    .masonry-grid {
        column-count: 1;
        column-gap: 1.5rem;
    }
    @media (min-width: 768px) {
        .masonry-grid {
            column-count: 2;
        }
    }
    @media (min-width: 1024px) {
        .masonry-grid {
            column-count: 3;
        }
    }
    .masonry-item {
        break-inside: avoid;
        margin-bottom: 1.5rem;
    }
</style>

<main class="pt-xl pb-xl">

<section class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop mt-xl mb-lg">
    <div class="border-l-4 border-primary pl-md">
        <h1 class="font-display text-display text-on-surface mb-xs uppercase tracking-tight">Visual Archives</h1>
        <p class="font-body-lg text-body-lg text-secondary max-w-2xl">
            Documenting the intersection of precision engineering and creative innovation. Explore our journey through workshops, competitions, and laboratory breakthroughs.
        </p>
    </div>
</section>

<section class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop mb-lg">
    <div class="flex flex-wrap gap-xs">
        <button class="bg-primary text-on-primary px-md py-sm sm:py-xs rounded font-label-md text-label-md">All Entries</button>
        <button class="bg-surface-container border border-surface-variant text-secondary px-md py-sm sm:py-xs rounded font-label-md text-label-md hover:border-primary transition-colors">Workshops</button>
        <button class="bg-surface-container border border-surface-variant text-secondary px-md py-sm sm:py-xs rounded font-label-md text-label-md hover:border-primary transition-colors">Team Meetings</button>
        <button class="bg-surface-container border border-surface-variant text-secondary px-md py-sm sm:py-xs rounded font-label-md text-label-md hover:border-primary transition-colors">Award Ceremony</button>
        <button class="bg-surface-container border border-surface-variant text-secondary px-md py-sm sm:py-xs rounded font-label-md text-label-md hover:border-primary transition-colors">Tech-Fest</button>
    </div>
</section>

<section class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
    <div class="masonry-grid">
        <?php 
        if($gallery && $gallery->num_rows > 0):
            while($img = $gallery->fetch_assoc()):
        ?>
            <div class="masonry-item group relative overflow-hidden bg-white border border-surface-variant">
                <img class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105" src="../<?php echo $img['image_path']; ?>" alt="<?php echo $img['title']; ?>" onerror="this.src='https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800&q=80'">
                <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-md">
                    <div class="bg-white p-sm w-full border-t-2 border-primary">
                        <span class="font-label-md text-[10px] text-primary uppercase tracking-widest"><?php echo date('m.y', strtotime($img['created_at'])); ?></span>
                        <h3 class="font-headline-md text-body-md font-bold text-on-surface"><?php echo $img['title']; ?></h3>
                    </div>
                </div>
            </div>
        <?php 
            endwhile;
        else:
        ?>
        <div class="masonry-item group relative overflow-hidden bg-white border border-surface-variant">
            <img class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800&q=80" alt="Workshop">
            <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-md">
                <div class="bg-white p-sm w-full border-t-2 border-primary">
                    <span class="font-label-md text-[10px] text-primary uppercase tracking-widest">Session: 01.24</span>
                    <h3 class="font-headline-md text-body-md font-bold text-on-surface">Robotics Workshop</h3>
                </div>
            </div>
        </div>
        <div class="masonry-item group relative overflow-hidden bg-white border border-surface-variant">
            <img class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1560439514-4e9645039924?w=800&q=80" alt="Award">
            <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-md">
                <div class="bg-white p-sm w-full border-t-2 border-primary">
                    <span class="font-label-md text-[10px] text-primary uppercase tracking-widest">Achievement</span>
                    <h3 class="font-headline-md text-body-md font-bold text-on-surface">Innovation Excellence Award</h3>
                </div>
            </div>
        </div>
        <div class="masonry-item group relative overflow-hidden bg-white border border-surface-variant">
            <img class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80" alt="Team Meeting">
            <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-md">
                <div class="bg-white p-sm w-full border-t-2 border-primary">
                    <span class="font-label-md text-[10px] text-primary uppercase tracking-widest">Collaboration</span>
                    <h3 class="font-headline-md text-body-md font-bold text-on-surface">Core Committee Strategy Meet</h3>
                </div>
            </div>
        </div>
        <div class="masonry-item group relative overflow-hidden bg-white border border-surface-variant">
            <img class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=800&q=80" alt="Tech Project">
            <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-md">
                <div class="bg-white p-sm w-full border-t-2 border-primary">
                    <span class="font-label-md text-[10px] text-primary uppercase tracking-widest">Project: Alpha</span>
                    <h3 class="font-headline-md text-body-md font-bold text-on-surface">Embedded Systems Development</h3>
                </div>
            </div>
        </div>
        <div class="masonry-item group relative overflow-hidden bg-white border border-surface-variant">
            <img class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80" alt="TechFest">
            <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-md">
                <div class="bg-white p-sm w-full border-t-2 border-primary">
                    <span class="font-label-md text-[10px] text-primary uppercase tracking-widest">Event: TechFest</span>
                    <h3 class="font-headline-md text-body-md font-bold text-on-surface">Annual Engineering Summit 2024</h3>
                </div>
            </div>
        </div>
        <div class="masonry-item group relative overflow-hidden bg-white border border-surface-variant">
            <img class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1581092921461-eab62e97a783?w=800&q=80" alt="Lab Work">
            <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-md">
                <div class="bg-white p-sm w-full border-t-2 border-primary">
                    <span class="font-label-md text-[10px] text-primary uppercase tracking-widest">Lab Access</span>
                    <h3 class="font-headline-md text-body-md font-bold text-on-surface">Micro-Engineering Lab Session</h3>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop py-lg flex justify-center">
    <button class="flex items-center gap-xs border border-on-surface text-on-surface px-xl py-sm hover:bg-on-surface hover:text-surface transition-all">
        <span class="font-label-md text-label-md uppercase tracking-widest">Load More Archives</span>
        <span class="material-symbols-outlined text-[18px]">expand_more</span>
    </button>
</section>

</main>

<?php include '../includes/footer.php'; ?>