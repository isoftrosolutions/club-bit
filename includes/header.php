<?php
require_once __DIR__ . '/db.php';

$currentPage = basename($_SERVER['PHP_SELF']);
$base_url = isset($base_url) ? $base_url : '/club/';
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' : ''; ?><?php echo getSetting('club_name', 'Club Abhiyanta-BIT'); ?></title>
    <link rel="icon" href="<?php echo $base_url; ?>assets/images/logo.png" type="image/png">

    <meta name="description" content="<?php echo getSetting('club_description', 'Precision engineering and technological innovation hub. Empowering the engineers of tomorrow through rigorous research and development.'); ?>">
    <meta name="keywords" content="Club Abhiyanta, BIT, engineering club, Birgunj, Nepal, technology, innovation, robotics, IoT, AI, research and development">
    <meta name="author" content="Club Abhiyanta-BIT">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="<?php echo $base_url . ($currentPage == 'index.php' ? '' : 'pages/' . $currentPage); ?>">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo isset($pageTitle) ? $pageTitle . ' | ' : ''; ?><?php echo getSetting('club_name', 'Club Abhiyanta-BIT'); ?>">
    <meta property="og:description" content="<?php echo getSetting('club_description', 'Precision engineering and technological innovation hub. Empowering the engineers of tomorrow through rigorous research and development.'); ?>">
    <meta property="og:url" content="<?php echo $base_url . ($currentPage == 'index.php' ? '' : 'pages/' . $currentPage); ?>">
    <meta property="og:image" content="<?php echo $base_url; ?>assets/images/logo.png">
    <meta property="og:site_name" content="<?php echo getSetting('club_name', 'Club Abhiyanta-BIT'); ?>">
    <meta property="og:locale" content="en_US">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($pageTitle) ? $pageTitle . ' | ' : ''; ?><?php echo getSetting('club_name', 'Club Abhiyanta-BIT'); ?>">
    <meta name="twitter:description" content="<?php echo getSetting('club_description', 'Precision engineering and technological innovation hub. Empowering the engineers of tomorrow through rigorous research and development.'); ?>">
    <meta name="twitter:image" content="<?php echo $base_url; ?>assets/images/logo.png">

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Club Abhiyanta-BIT",
        "url": "<?php echo $base_url; ?>",
        "logo": "<?php echo $base_url; ?>assets/images/logo.png",
        "description": "<?php echo getSetting('club_description', 'Precision engineering and technological innovation hub. Empowering the engineers of tomorrow through rigorous research and development.'); ?>",
        "foundingDate": "2024",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Birgunj",
            "addressCountry": "NP"
        }
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "<?php echo getSetting('club_name', 'Club Abhiyanta-BIT'); ?>",
        "url": "<?php echo $base_url; ?>"
    }
    </script>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <?php 
    // Get dynamic colors from database
    $colors = getSiteColors();
    $defaultColors = [
        'primary' => '#a10014',
        'on-primary' => '#ffffff',
        'primary-container' => '#c81d25',
        'on-primary-container' => '#ffddda',
        'secondary' => '#5f5e5e',
        'on-secondary' => '#ffffff',
        'secondary-container' => '#e2dfde',
        'on-secondary-container' => '#636262',
        'surface' => '#fafaf3',
        'surface-dim' => '#dadad4',
        'surface-container-lowest' => '#ffffff',
        'surface-container-low' => '#f4f4ee',
        'surface-container' => '#eeeee8',
        'surface-container-high' => '#e8e8e2',
        'surface-container-highest' => '#e3e3dd',
        'surface-variant' => '#e3e3dd',
        'on-surface' => '#1a1c19',
        'on-surface-variant' => '#5c403d',
        'on-background' => '#1a1c19',
        'error' => '#ba1a1a',
        'on-error' => '#ffffff',
        'outline' => '#906f6c',
        'outline-variant' => '#e5bdba'
    ];
    $colors = array_merge($defaultColors, $colors);
    ?>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "<?php echo $colors['primary']; ?>",
                        "on-primary": "<?php echo $colors['on-primary']; ?>",
                        "primary-container": "<?php echo $colors['primary-container']; ?>",
                        "on-primary-container": "<?php echo $colors['on-primary-container']; ?>",
                        "secondary": "<?php echo $colors['secondary']; ?>",
                        "on-secondary": "<?php echo $colors['on-secondary']; ?>",
                        "secondary-container": "<?php echo $colors['secondary-container']; ?>",
                        "on-secondary-container": "<?php echo $colors['on-secondary-container']; ?>",
                        "surface": "<?php echo $colors['surface']; ?>",
                        "surface-dim": "<?php echo $colors['surface-dim']; ?>",
                        "surface-container-lowest": "<?php echo $colors['surface-container-lowest']; ?>",
                        "surface-container-low": "<?php echo $colors['surface-container-low']; ?>",
                        "surface-container": "<?php echo $colors['surface-container']; ?>",
                        "surface-container-high": "<?php echo $colors['surface-container-high']; ?>",
                        "surface-container-highest": "<?php echo $colors['surface-container-highest']; ?>",
                        "surface-variant": "<?php echo $colors['surface-variant']; ?>",
                        "on-surface": "<?php echo $colors['on-surface']; ?>",
                        "on-surface-variant": "<?php echo $colors['on-surface-variant']; ?>",
                        "on-background": "<?php echo $colors['on-background']; ?>",
                        "error": "<?php echo $colors['error']; ?>",
                        "on-error": "<?php echo $colors['on-error']; ?>",
                        "outline": "<?php echo $colors['outline']; ?>",
                        "outline-variant": "<?php echo $colors['outline-variant']; ?>"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "base": "4px",
                        "margin-desktop": "64px",
                        "margin-mobile": "16px",
                        "sm": "16px",
                        "gutter": "24px",
                        "md": "24px",
                        "lg": "48px",
                        "xl": "80px",
                        "xs": "8px"
                    },
                    fontFamily: {
                        "display": ["Montserrat"],
                        "label-md": ["Montserrat"],
                        "headline-md": ["Montserrat"],
                        "code": ["Montserrat"],
                        "body-md": ["Montserrat"],
                        "body-lg": ["Montserrat"],
                        "headline-lg-mobile": ["Montserrat"],
                        "headline-lg": ["Montserrat"]
                    },
                    fontSize: {
                        "display": ["clamp(32px, 8vw, 48px)", {"lineHeight": "1.15", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "headline-md": ["clamp(20px, 4vw, 24px)", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "code": ["14px", {"lineHeight": "20px", "fontWeight": "500"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-lg": ["clamp(16px, 2.5vw, 18px)", {"lineHeight": "1.5", "fontWeight": "400"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                        "headline-lg": ["clamp(24px, 5vw, 32px)", {"lineHeight": "1.25", "letterSpacing": "-0.01em", "fontWeight": "700"}]
                    }
                }
            }
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        body {
            background-color: #fafaf3;
            font-family: 'Montserrat', sans-serif;
        }
    </style>

    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/style.css">
</head>
<body class="bg-background text-on-background font-body-md">

<header id="main-header" class="fixed top-0 w-full z-50 bg-background border-b border-surface-variant h-16 md:h-20">
    <nav class="flex justify-between items-center px-margin-mobile md:px-margin-desktop h-full max-w-[1200px] mx-auto">
        <a href="<?php echo $base_url; ?>index.php" class="flex items-center gap-2 md:gap-3">
            <img src="<?php echo $base_url; ?>assets/images/logo.png" alt="Logo" class="h-9 md:h-12 w-auto">
            <span class="hidden md:inline font-headline-md text-headline-md font-bold text-primary"><?php echo getSetting('club_name', 'Club Abhiyanta-BIT'); ?></span>
        </a>
        <div class="hidden md:flex items-center gap-gutter">
            <a class="font-label-md text-label-md <?php echo ($currentPage == 'index.php' || $currentPage == '') ? 'text-primary font-bold border-b-2 border-primary' : 'text-secondary hover:text-primary'; ?> transition-colors duration-200" href="<?php echo $base_url; ?>index.php">Home</a>
            <a class="font-label-md text-label-md <?php echo ($currentPage == 'about.php') ? 'text-primary font-bold border-b-2 border-primary' : 'text-secondary hover:text-primary'; ?> transition-colors duration-200" href="<?php echo $base_url; ?>pages/about.php">About</a>
            <a class="font-label-md text-label-md <?php echo ($currentPage == 'team.php') ? 'text-primary font-bold border-b-2 border-primary' : 'text-secondary hover:text-primary'; ?> transition-colors duration-200" href="<?php echo $base_url; ?>pages/team.php">Team</a>
            <a class="font-label-md text-label-md <?php echo ($currentPage == 'programmes.php') ? 'text-primary font-bold border-b-2 border-primary' : 'text-secondary hover:text-primary'; ?> transition-colors duration-200" href="<?php echo $base_url; ?>pages/programmes.php">Events</a>
            <a class="font-label-md text-label-md <?php echo ($currentPage == 'projects.php') ? 'text-primary font-bold border-b-2 border-primary' : 'text-secondary hover:text-primary'; ?> transition-colors duration-200" href="<?php echo $base_url; ?>pages/projects.php">Projects</a>
            <a class="font-label-md text-label-md <?php echo ($currentPage == 'gallery.php') ? 'text-primary font-bold border-b-2 border-primary' : 'text-secondary hover:text-primary'; ?> transition-colors duration-200" href="<?php echo $base_url; ?>pages/gallery.php">Gallery</a>
        </div>
        <div class="flex items-center gap-2 md:gap-sm">
            <a href="<?php echo $base_url; ?>pages/membership.php" class="hidden md:inline bg-white border border-secondary/20 text-secondary px-md py-xs rounded font-label-md text-label-md hover:bg-surface-container-low transition-all active:scale-95">
                Join
            </a>

            <button class="md:hidden flex items-center justify-center w-11 h-11 text-primary" onclick="document.querySelector('.mobile-nav').classList.toggle('hidden')" aria-label="Toggle menu">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </div>
    </nav>
</header>

<!-- Mobile Navigation -->
<div class="mobile-nav hidden fixed inset-0 z-40 bg-background md:hidden">
    <div class="flex flex-col h-full pt-16 px-margin-mobile pb-8">
        <div class="flex-1 flex flex-col gap-1 py-lg">
            <a class="flex items-center gap-3 font-headline-md text-headline-md <?php echo ($currentPage == 'index.php' || $currentPage == '') ? 'text-primary' : 'text-secondary'; ?> py-md border-b border-outline-variant/10" href="<?php echo $base_url; ?>index.php">
                <span class="material-symbols-outlined">home</span> Home
            </a>
            <a class="flex items-center gap-3 font-headline-md text-headline-md <?php echo ($currentPage == 'about.php') ? 'text-primary' : 'text-secondary'; ?> py-md border-b border-outline-variant/10" href="<?php echo $base_url; ?>pages/about.php">
                <span class="material-symbols-outlined">info</span> About
            </a>
            <a class="flex items-center gap-3 font-headline-md text-headline-md <?php echo ($currentPage == 'team.php') ? 'text-primary' : 'text-secondary'; ?> py-md border-b border-outline-variant/10" href="<?php echo $base_url; ?>pages/team.php">
                <span class="material-symbols-outlined">groups</span> Team
            </a>
            <a class="flex items-center gap-3 font-headline-md text-headline-md <?php echo ($currentPage == 'programmes.php') ? 'text-primary' : 'text-secondary'; ?> py-md border-b border-outline-variant/10" href="<?php echo $base_url; ?>pages/programmes.php">
                <span class="material-symbols-outlined">event</span> Events
            </a>
            <a class="flex items-center gap-3 font-headline-md text-headline-md <?php echo ($currentPage == 'projects.php') ? 'text-primary' : 'text-secondary'; ?> py-md border-b border-outline-variant/10" href="<?php echo $base_url; ?>pages/projects.php">
                <span class="material-symbols-outlined">science</span> Projects
            </a>
            <a class="flex items-center gap-3 font-headline-md text-headline-md <?php echo ($currentPage == 'gallery.php') ? 'text-primary' : 'text-secondary'; ?> py-md border-b border-outline-variant/10" href="<?php echo $base_url; ?>pages/gallery.php">
                <span class="material-symbols-outlined">photo_library</span> Gallery
            </a>
        </div>
        <div class="flex gap-sm pt-lg border-t border-outline-variant/20">
            <a href="<?php echo $base_url; ?>pages/membership.php" class="flex-1 bg-primary text-on-primary text-center px-md py-sm rounded-lg font-label-md text-label-md">Join</a>

        </div>
    </div>
</div>

<main>