<?php 
$pageTitle = "Programmes & Events";
include '../includes/header.php'; 
?>

<main class="pt-32 pb-xl">

<section class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop mb-xl">
    <div class="flex flex-col md:flex-row gap-lg items-end justify-between">
        <div class="max-w-2xl">
            <span class="text-primary font-label-md tracking-widest uppercase mb-base block">Engineering the Future</span>
            <h1 class="font-display text-display text-on-surface mb-md">Laboratory of Innovation</h1>
            <p class="font-body-lg text-body-lg text-secondary">A curated series of high-precision technical workshops, AI deep-dives, and competitive hackathons designed to push the boundaries of modern engineering.</p>
        </div>
        <div class="flex gap-xs">
            <button class="p-xs border border-outline text-on-surface hover:bg-surface-container transition-colors">
                <span class="material-symbols-outlined">filter_list</span>
            </button>
            <button class="p-xs border border-outline text-on-surface hover:bg-surface-container transition-colors">
                <span class="material-symbols-outlined">calendar_month</span>
            </button>
        </div>
    </div>
</section>

<section class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop mb-xl">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">

        <div class="md:col-span-8 bg-surface-container-lowest border border-[#EBEBE5] p-lg flex flex-col justify-between group">
            <div>
                <div class="flex justify-between items-start mb-md">
                    <span class="bg-primary text-on-primary px-sm py-xs font-label-md rounded-none uppercase">Upcoming Flagship</span>
                    <span class="text-secondary font-code text-code uppercase">May 15-17, 2025</span>
                </div>
                <h2 class="font-headline-lg text-headline-lg mb-md group-hover:text-primary transition-colors">National Level AI & Robotics Symposium</h2>
                <p class="font-body-md text-body-md text-secondary max-w-lg">Three days of intensive workshops, research presentations, and the annual Robot-Combat Championship. Join industry experts from top tech giants.</p>
            </div>
            <div class="mt-lg flex items-center justify-between">
                <div class="flex -space-x-2">
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-surface-variant overflow-hidden">
                        <img class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=Aravind&background=a10014&color=fff" alt="Speaker">
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-surface-variant overflow-hidden">
                        <img class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=Priya&background=a10014&color=fff" alt="Speaker">
                    </div>
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 border-white bg-surface-container-highest text-secondary font-label-md">+40</div>
                </div>
                <button class="bg-primary text-on-primary px-md py-sm font-label-md flex items-center gap-xs">
                    Register Now
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
            </div>
        </div>

        <div class="md:col-span-4 grid grid-rows-2 gap-gutter">
            <div class="bg-surface-container-lowest border border-[#EBEBE5] p-md flex flex-col justify-between">
                <div>
                    <div class="text-primary font-code text-code mb-xs">Workshop</div>
                    <h3 class="font-headline-md text-headline-md leading-tight">Cyber Security Awareness 2.0</h3>
                </div>
                <div class="font-label-md text-secondary mt-md">April 22 • Lab 404</div>
            </div>
            <div class="bg-surface-container-lowest border border-[#EBEBE5] p-md flex flex-col justify-between">
                <div>
                    <div class="text-primary font-code text-code mb-xs">Seminar</div>
                    <h3 class="font-headline-md text-headline-md leading-tight">Blockchain in Supply Chain</h3>
                </div>
                <div class="font-label-md text-secondary mt-md">April 29 • Seminar Hall</div>
            </div>
        </div>
    </div>
</section>

<section class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop mb-xl">
    <h3 class="font-headline-lg text-headline-lg mb-xl flex items-center gap-sm">
        <span class="w-2 h-10 bg-primary block"></span>
        Event Timeline
    </h3>
    <div class="relative border-l-2 border-surface-variant ml-4 md:ml-0">

        <div class="mb-lg pl-lg relative">
            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-primary ring-4 ring-background"></div>
            <div class="flex flex-col md:flex-row md:items-center gap-md">
                <div class="min-w-[120px]">
                    <span class="font-code text-primary font-bold">MAY 05</span>
                </div>
                <div class="bg-white border border-[#EBEBE5] p-md flex-grow">
                    <div class="flex justify-between items-center mb-xs">
                        <h4 class="font-headline-md text-headline-md">Inter-Departmental Coding Duel</h4>
                        <span class="bg-surface-container px-xs py-1 rounded text-secondary font-label-md text-[12px]">COMPETITION</span>
                    </div>
                    <p class="font-body-md text-secondary">A high-stakes algorithmic battle between departments. 4 hours, 8 challenges, 1 champion.</p>
                </div>
            </div>
        </div>

        <div class="mb-lg pl-lg relative">
            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-primary ring-4 ring-background"></div>
            <div class="flex flex-col md:flex-row md:items-center gap-md">
                <div class="min-w-[120px]">
                    <span class="font-code text-primary font-bold">MAY 12</span>
                </div>
                <div class="bg-white border border-[#EBEBE5] p-md flex-grow">
                    <div class="flex justify-between items-center mb-xs">
                        <h4 class="font-headline-md text-headline-md">Sustainable Energy Systems Seminar</h4>
                        <span class="bg-surface-container px-xs py-1 rounded text-secondary font-label-md text-[12px]">SEMINAR</span>
                    </div>
                    <p class="font-body-md text-secondary">Guest lecture on the future of thorium-based nuclear reactors and smart grids.</p>
                </div>
            </div>
        </div>

        <div class="mb-lg pl-lg relative">
            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-primary ring-4 ring-background"></div>
            <div class="flex flex-col md:flex-row md:items-center gap-md">
                <div class="min-w-[120px]">
                    <span class="font-code text-primary font-bold">JUN 02</span>
                </div>
                <div class="bg-white border border-[#EBEBE5] p-md flex-grow">
                    <div class="flex justify-between items-center mb-xs">
                        <h4 class="font-headline-md text-headline-md">VLSI Design Bootcamp</h4>
                        <span class="bg-surface-container px-xs py-1 rounded text-secondary font-label-md text-[12px]">WORKSHOP</span>
                    </div>
                    <p class="font-body-md text-secondary">Hands-on session with industry-standard tools for physical design and verification.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
    <h3 class="font-headline-lg text-headline-lg mb-xl">All Program Modules</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">

        <div class="bg-white border border-[#EBEBE5] flex flex-col h-full overflow-hidden">
            <div class="h-48 w-full overflow-hidden">
                <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500" src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&q=80" alt="Hardware">
            </div>
            <div class="p-md flex flex-col flex-grow">
                <div class="flex justify-between items-center mb-sm">
                    <span class="text-primary font-label-md">Hardware</span>
                    <span class="material-symbols-outlined text-secondary text-[20px]">memory</span>
                </div>
                <h4 class="font-headline-md text-headline-md mb-xs">Embedded Systems Mastery</h4>
                <p class="font-body-md text-secondary mb-lg flex-grow">Mastering STM32 and RTOS for high-performance industrial automation applications.</p>
                <div class="flex items-center justify-between mt-auto pt-md border-t border-surface-variant">
                    <span class="font-code text-label-md text-on-surface">FREE</span>
                    <button class="text-primary font-label-md flex items-center gap-xs hover:gap-md transition-all">
                        VIEW DETAILS
                        <span class="material-symbols-outlined text-[16px]">trending_flat</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white border border-[#EBEBE5] flex flex-col h-full overflow-hidden">
            <div class="h-48 w-full overflow-hidden">
                <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500" src="https://images.unsplash.com/photo-1555255707-c07966088b7b?w=600&q=80" alt="AI & ML">
            </div>
            <div class="p-md flex flex-col flex-grow">
                <div class="flex justify-between items-center mb-sm">
                    <span class="text-primary font-label-md">AI & ML</span>
                    <span class="material-symbols-outlined text-secondary text-[20px]">psychology</span>
                </div>
                <h4 class="font-headline-md text-headline-md mb-xs">Neural Network Optimization</h4>
                <p class="font-body-md text-secondary mb-lg flex-grow">Techniques for deploying lightweight LLMs on edge devices without performance loss.</p>
                <div class="flex items-center justify-between mt-auto pt-md border-t border-surface-variant">
                    <span class="font-code text-label-md text-on-surface">$15.00</span>
                    <button class="text-primary font-label-md flex items-center gap-xs hover:gap-md transition-all">
                        VIEW DETAILS
                        <span class="material-symbols-outlined text-[16px]">trending_flat</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white border border-[#EBEBE5] flex flex-col h-full overflow-hidden">
            <div class="h-48 w-full overflow-hidden">
                <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500" src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&q=80" alt="Web Tech">
            </div>
            <div class="p-md flex flex-col flex-grow">
                <div class="flex justify-between items-center mb-sm">
                    <span class="text-primary font-label-md">Web Tech</span>
                    <span class="material-symbols-outlined text-secondary text-[20px]">lan</span>
                </div>
                <h4 class="font-headline-md text-headline-md mb-xs">Full-Stack Scalability</h4>
                <p class="font-body-md text-secondary mb-lg flex-grow">Designing microservices architecture for systems serving millions of concurrent users.</p>
                <div class="flex items-center justify-between mt-auto pt-md border-t border-surface-variant">
                    <span class="font-code text-label-md text-on-surface">FREE</span>
                    <button class="text-primary font-label-md flex items-center gap-xs hover:gap-md transition-all">
                        VIEW DETAILS
                        <span class="material-symbols-outlined text-[16px]">trending_flat</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>

</main>

<?php include '../includes/footer.php'; ?>