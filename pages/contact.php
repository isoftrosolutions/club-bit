<?php 
$pageTitle = "Contact Us";
include '../includes/header.php'; 

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);
    
    $sql = "INSERT INTO contacts (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        $success_message = "Your message has been sent successfully! We'll get back to you soon.";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<style>
    .grid-blueprint {
        background-image: radial-gradient(#e3e3dd 1px, transparent 1px);
        background-size: 24px 24px;
    }
</style>

<main class="pt-xl pb-xl max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop grid-blueprint">

<section class="mt-xl mb-lg">
    <div class="flex flex-col gap-base">
        <span class="text-primary font-label-md tracking-widest uppercase">ESTABLISHED 2024</span>
        <h1 class="font-display text-display text-on-surface">Initiate Protocol</h1>
        <p class="font-body-lg text-body-lg text-secondary max-w-2xl">Connect with our R&D center for technical collaborations, laboratory access, or engineering inquiries. Our precision-first communication channels are open.</p>
    </div>
</section>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">

    <div class="lg:col-span-7 bg-surface-container-lowest border border-surface-variant p-md lg:p-lg">
        <div class="mb-lg border-l-4 border-primary pl-md">
            <h2 class="font-headline-md text-headline-md">Transmit Signal</h2>
            <p class="font-body-md text-body-md text-secondary">Encrypted message transmission to command center.</p>
        </div>

        <?php if ($success_message): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-lg">
                <span class="material-symbols-outlined align-middle mr-2">check_circle</span>
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-lg">
                <span class="material-symbols-outlined align-middle mr-2">error</span>
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="space-y-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-sm">
                <div class="flex flex-col gap-xs">
                    <label class="font-label-md text-label-md text-on-surface">CODENAME</label>
                    <input class="bg-background border border-surface-variant px-sm py-xs focus:ring-0 focus:border-on-surface outline-none transition-all" placeholder="Your Name" type="text" name="name" required>
                </div>
                <div class="flex flex-col gap-xs">
                    <label class="font-label-md text-label-md text-on-surface">CHANNEL (EMAIL)</label>
                    <input class="bg-background border border-surface-variant px-sm py-xs focus:ring-0 focus:border-on-surface outline-none transition-all" placeholder="email@domain.com" type="email" name="email" required>
                </div>
            </div>
            <div class="flex flex-col gap-xs">
                <label class="font-label-md text-label-md text-on-surface">SUBJECT</label>
                <select class="bg-background border border-surface-variant px-sm py-xs focus:ring-0 focus:border-on-surface outline-none transition-all" name="subject" required>
                    <option value="">Select Subject</option>
                    <option>Technical Consultation</option>
                    <option>Laboratory Access</option>
                    <option>Project Partnership</option>
                    <option>Membership Query</option>
                    <option>General Inquiry</option>
                </select>
            </div>
            <div class="flex flex-col gap-xs">
                <label class="font-label-md text-label-md text-on-surface">DATA PAYLOAD</label>
                <textarea class="bg-background border border-surface-variant px-sm py-xs focus:ring-0 focus:border-on-surface outline-none transition-all resize-none" placeholder="Describe the engineering objective..." rows="6" name="message" required></textarea>
            </div>
            <button class="w-full bg-primary text-on-primary font-label-md text-label-md py-sm active:scale-95 transition-transform flex items-center justify-center gap-xs" type="submit">
                <span class="material-symbols-outlined text-[18px]">send</span>
                TRANSMIT SIGNAL
            </button>
        </form>
    </div>

    <div class="lg:col-span-5 flex flex-col gap-gutter">

        <div class="bg-surface-container p-md border border-surface-variant">
            <h3 class="font-label-md text-label-md text-primary mb-md tracking-wider">CORE COORDINATES</h3>
            <div class="space-y-md">
                <div class="flex gap-sm">
                    <span class="material-symbols-outlined text-primary">location_on</span>
                    <div>
                        <h4 class="font-label-md text-label-md font-bold">BIT Campus</h4>
                        <p class="font-body-md text-body-md text-secondary">Main Technical Building, Block C<br/>Birgunj, Nepal</p>
                    </div>
                </div>
                <div class="flex gap-sm">
                    <span class="material-symbols-outlined text-primary">mail</span>
                    <div>
                        <h4 class="font-label-md text-label-md font-bold">Email Channel</h4>
                        <p class="font-body-md text-body-md text-secondary"><?php echo getSetting('contact_email', 'info.clubabhiyanta@gmail.com'); ?></p>
                    </div>
                </div>
                <div class="flex gap-sm">
                    <span class="material-symbols-outlined text-primary">call</span>
                    <div>
                        <h4 class="font-label-md text-label-md font-bold">Direct Line</h4>
                        <p class="font-body-md text-body-md text-secondary"><?php echo getSetting('contact_phone', '+977 9800000000'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-surface-container-highest p-md">
            <h3 class="font-label-md text-label-md text-secondary mb-md tracking-wider">GLOBAL NETWORKS</h3>
            <div class="grid grid-cols-2 gap-xs">
                <a class="flex items-center gap-xs p-sm sm:p-xs bg-surface-container-lowest border border-surface-variant hover:border-primary transition-colors" href="#">
                    <span class="material-symbols-outlined text-[20px]">terminal</span>
                    <span class="font-label-md text-[12px]">GITHUB</span>
                </a>
                <a class="flex items-center gap-xs p-sm sm:p-xs bg-surface-container-lowest border border-surface-variant hover:border-primary transition-colors" href="#">
                    <span class="material-symbols-outlined text-[20px]">hub</span>
                    <span class="font-label-md text-[12px]">LINKEDIN</span>
                </a>
                <a class="flex items-center gap-xs p-sm sm:p-xs bg-surface-container-lowest border border-surface-variant hover:border-primary transition-colors" href="#">
                    <span class="material-symbols-outlined text-[20px]">photo_camera</span>
                    <span class="font-label-md text-[12px]">INSTAGRAM</span>
                </a>
                <a class="flex items-center gap-xs p-sm sm:p-xs bg-surface-container-lowest border border-surface-variant hover:border-primary transition-colors" href="#">
                    <span class="material-symbols-outlined text-[20px]">podcasts</span>
                    <span class="font-label-md text-[12px]">DISCORD</span>
                </a>
            </div>
        </div>

        <div class="h-64 relative bg-surface-dim overflow-hidden border border-surface-variant">
            <div class="absolute inset-0 bg-primary/5 z-10 pointer-events-none"></div>
            <div class="absolute bottom-md left-md z-20 bg-primary text-on-primary px-sm py-xs font-label-md">
                LOC: BIRGUNJ_TECH_CENTER
            </div>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.0123456789!2d84.8678!3d27.1234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39932c4e6e6e6e6e%3A0x1234567890abcdef!2sBirgunj!5e0!3m2!1sen!2snp!4v1234567890"
                width="100%" 
                height="100%" 
                style="border:0;filter: grayscale(80%)" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>

<section class="mt-lg grid grid-cols-1 md:grid-cols-3 gap-gutter">
    <div class="p-md bg-surface-container-low border border-surface-variant">
        <span class="material-symbols-outlined text-primary mb-sm">help</span>
        <h5 class="font-label-md text-label-md font-bold mb-xs">FAQ SYSTEM</h5>
        <p class="font-body-md text-body-md text-secondary">Browse our technical documentation for immediate protocol guidance.</p>
    </div>
    <div class="p-md bg-surface-container-low border border-surface-variant">
        <span class="material-symbols-outlined text-primary mb-sm">verified_user</span>
        <h5 class="font-label-md text-label-md font-bold mb-xs">LAB ACCESS</h5>
        <p class="font-body-md text-body-md text-secondary">Schedule physical inspections of the heavy engineering laboratory.</p>
    </div>
    <div class="p-md bg-surface-container-low border border-surface-variant">
        <span class="material-symbols-outlined text-primary mb-sm">handshake</span>
        <h5 class="font-label-md text-label-md font-bold mb-xs">PARTNERSHIPS</h5>
        <p class="font-body-md text-body-md text-secondary">Strategic alliance requests for long-term R&D initiatives.</p>
    </div>
</section>

</main>

<?php include '../includes/footer.php'; ?>