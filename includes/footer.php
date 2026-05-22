</main>

    <footer class="w-full bg-surface-container-highest border-t border-surface-variant">
        <div class="flex flex-col md:flex-row justify-between items-center px-margin-mobile md:px-margin-desktop py-xl max-w-[1200px] mx-auto">
            <div class="mb-md md:mb-0">
                <div class="font-headline-md text-headline-md font-bold text-primary mb-xs">
                    <?php echo getSetting('club_name', 'Club Abhiyanta-BIT'); ?>
                </div>
                <p class="font-body-md text-body-md text-secondary">
                    © <?php echo date('Y'); ?> Club Abhiyanta-BIT. Precision in Engineering.
                </p>
            </div>
            <div class="flex flex-wrap justify-center gap-md">
                <a class="font-body-md text-body-md text-secondary hover:text-primary transition-colors" href="#">Privacy Policy</a>
                <a class="font-body-md text-body-md text-secondary hover:text-primary transition-colors" href="#">Terms of Service</a>
                <a class="font-body-md text-body-md text-secondary hover:text-primary transition-colors" href="<?php echo $base_url; ?>pages/contact.php">Laboratory Access</a>
            </div>
        </div>
    </footer>

    <script src="<?php echo $base_url; ?>assets/js/script.js"></script>
</body>
</html>