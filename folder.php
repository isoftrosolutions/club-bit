<?php
// Simple version - just creates empty files
$dirs = [
    'admin',
    'assets/css',
    'assets/js',
    'assets/images/gallery',
    'includes',
    'pages'
];

$files = [
    'index.php',
    '.htaccess',
    'admin/dashboard.php',
    'admin/members.php',
    'admin/login.php',
    'assets/css/style.css',
    'assets/js/script.js',
    'includes/db.php',
    'includes/header.php',
    'includes/footer.php',
    'pages/about.php',
    'pages/works.php',
    'pages/gallery.php',
    'pages/membership.php',
    'pages/contact.php'
];

// Create directories
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
        echo "Created: $dir/\n";
    }
}

// Create files
foreach ($files as $file) {
    if (!file_exists($file)) {
        file_put_contents($file, '');
        echo "Created: $file\n";
    }
}

echo "Done!\n";
?>