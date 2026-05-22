<?php 
$pageTitle = "R&D Projects";
include '../includes/header.php'; 
?>

<section class="relative min-h-[360px] md:min-h-[614px] flex items-center overflow-hidden py-lg md:py-0">
    <div class="absolute inset-0 z-0">
        <img alt="Research Laboratory" class="w-full h-full object-cover opacity-20 grayscale" src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=1200&q=80">
    </div>
    <div class="relative z-10 max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop w-full">
        <div class="max-w-2xl">
            <span class="inline-block bg-primary text-on-primary px-xs py-1 text-label-md font-label-md mb-md">INNOVATION LAB</span>
            <h1 class="font-display text-display mb-sm text-on-background">Research & <span class="text-primary">Development</span></h1>
            <p class="font-body-lg text-body-lg text-secondary">Pushing the boundaries of engineering through applied research, prototyping, and real-world problem-solving.</p>
        </div>
    </div>
</section>

<section class="py-xl bg-surface-container-low">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
        <h2 class="font-display text-headline-lg text-on-background mb-lg">FEATURED PROJECTS</h2>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
            <div class="md:col-span-7 bg-surface-container-lowest rounded-xl border border-outline-variant/30 overflow-hidden group">
                <img alt="Smart Vending Ecosystem" class="w-full h-72 object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-[1.02]" src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80">
                <div class="p-lg">
                    <div class="flex items-center gap-xs mb-md">
                        <span class="bg-primary/10 text-primary px-sm py-1 font-label-md text-[12px]">IOT</span>
                        <span class="bg-primary/10 text-primary px-sm py-1 font-label-md text-[12px]">BLOCKCHAIN</span>
                    </div>
                    <h3 class="font-headline-lg text-headline-lg mb-sm">Smart Vending Ecosystem</h3>
                    <p class="font-body-lg text-body-lg text-secondary">Fully automated, IoT-integrated dispensing system using blockchain for secure transactions and real-time inventory tracking. The system supports cashless payments, remote monitoring, and predictive restocking.</p>
                </div>
            </div>
            <div class="md:col-span-5 bg-primary text-on-primary rounded-xl p-lg flex flex-col justify-between">
                <div>
                    <span class="inline-block bg-white/20 text-on-primary px-sm py-1 font-label-md text-[12px] mb-md">INFRASTRUCTURE</span>
                    <h3 class="font-headline-lg text-headline-lg mb-sm">IoT Infrastructure</h3>
                    <p class="opacity-90 font-body-lg">Developing low-latency sensor networks for smart campus monitoring and industrial automation. Real-time data collection across temperature, humidity, vibration, and power consumption.</p>
                </div>
                <span class="material-symbols-outlined text-7xl opacity-20 mt-lg">sensors</span>
            </div>
            <div class="md:col-span-5 bg-surface-container-lowest rounded-xl border border-outline-variant/30 p-lg flex flex-col">
                <span class="material-symbols-outlined text-primary text-5xl mb-md">precision_manufacturing</span>
                <span class="inline-block bg-primary/10 text-primary px-sm py-1 font-label-md text-[12px] w-fit mb-md">ROBOTICS</span>
                <h3 class="font-headline-lg text-headline-lg mb-sm">Robotics Lab</h3>
                <p class="font-body-lg text-body-lg text-secondary mb-lg flex-grow">Precision calibration and control algorithms for multi-axis robotic arms. Covers inverse kinematics, trajectory planning, and real-time feedback control using ROS 2.</p>
                <a class="text-primary font-label-md flex items-center gap-2 hover:gap-md transition-all" href="#">View Specs <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
            </div>
            <div class="md:col-span-7 bg-surface-container-lowest rounded-xl border border-outline-variant/30 overflow-hidden">
                <div class="grid md:grid-cols-2 h-full">
                    <div class="p-lg flex flex-col justify-center">
                        <span class="inline-block bg-primary/10 text-primary px-sm py-1 font-label-md text-[12px] w-fit mb-md">ARTIFICIAL INTELLIGENCE</span>
                        <h3 class="font-headline-lg text-headline-lg mb-sm">AI Implementation</h3>
                        <p class="font-body-lg text-body-lg text-secondary">Machine learning models for predictive maintenance and real-time object detection in industrial workflows. Deployed on edge devices for low-latency inference.</p>
                    </div>
                    <img alt="AI Project" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500" src="https://images.unsplash.com/photo-1555255707-c07966088b7b?w=600&q=80">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-xl">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex items-center gap-sm mb-xl">
            <span class="w-2 h-10 bg-primary block"></span>
            <h2 class="font-display text-headline-lg text-on-background">ALL PROJECTS</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter">
            <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl overflow-hidden group">
                <div class="h-52 overflow-hidden">
                    <img alt="Drone Swarm" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1508614589041-895f88990d1c?w=600&q=80">
                </div>
                <div class="p-md">
                    <span class="text-primary font-label-md text-[12px] uppercase tracking-wider">AERIAL SYSTEMS</span>
                    <h3 class="font-headline-md text-headline-md mt-sm mb-xs">Drone Swarm Coordination</h3>
                    <p class="font-body-md text-body-md text-secondary">Multi-agent path planning and collision avoidance algorithms for autonomous drone formations.</p>
                </div>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl overflow-hidden group">
                <div class="h-52 overflow-hidden">
                    <img alt="Solar Monitoring" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1509391366360-2e959784a276?w=600&q=80">
                </div>
                <div class="p-md">
                    <span class="text-primary font-label-md text-[12px] uppercase tracking-wider">RENEWABLE ENERGY</span>
                    <h3 class="font-headline-md text-headline-md mt-sm mb-xs">Solar Array Optimizer</h3>
                    <p class="font-body-md text-body-md text-secondary">AI-driven maximum power point tracking system for improved solar panel efficiency across varying conditions.</p>
                </div>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl overflow-hidden group">
                <div class="h-52 overflow-hidden">
                    <img alt="Smart Agriculture" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1586771107445-b3a6e0d7f28c?w=600&q=80">
                </div>
                <div class="p-md">
                    <span class="text-primary font-label-md text-[12px] uppercase tracking-wider">AGRITECH</span>
                    <h3 class="font-headline-md text-headline-md mt-sm mb-xs">Precision Agriculture Platform</h3>
                    <p class="font-body-md text-body-md text-secondary">Soil nutrient monitoring and automated irrigation using IoT sensor arrays and weather prediction models.</p>
                </div>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl overflow-hidden group">
                <div class="h-52 overflow-hidden">
                    <img alt="Smart Campus" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80">
                </div>
                <div class="p-md">
                    <span class="text-primary font-label-md text-[12px] uppercase tracking-wider">SMART CAMPUS</span>
                    <h3 class="font-headline-md text-headline-md mt-sm mb-xs">Smart Campus Dashboard</h3>
                    <p class="font-body-md text-body-md text-secondary">Centralized monitoring platform for campus energy usage, occupancy, air quality, and security systems.</p>
                </div>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl overflow-hidden group">
                <div class="h-52 overflow-hidden">
                    <img alt="Medical Device" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&q=80">
                </div>
                <div class="p-md">
                    <span class="text-primary font-label-md text-[12px] uppercase tracking-wider">BIOMEDICAL</span>
                    <h3 class="font-headline-md text-headline-md mt-sm mb-xs">Wearable Health Monitor</h3>
                    <p class="font-body-md text-body-md text-secondary">Non-invasive biosensor patch for continuous vitals monitoring with cloud-based anomaly detection alerts.</p>
                </div>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl overflow-hidden group">
                <div class="h-52 overflow-hidden">
                    <img alt="Blockchain" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-105" src="https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=600&q=80">
                </div>
                <div class="p-md">
                    <span class="text-primary font-label-md text-[12px] uppercase tracking-wider">BLOCKCHAIN</span>
                    <h3 class="font-headline-md text-headline-md mt-sm mb-xs">Decentralized Credential Verification</h3>
                    <p class="font-body-md text-body-md text-secondary">Blockchain-based academic credential verification system eliminating fraudulent certificates.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
