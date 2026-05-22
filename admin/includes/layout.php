<?php
// Admin Layout - Design System: Physical Innovation Lab
$currentPage = basename($_SERVER['PHP_SELF']);
$adminPages = [
    'dashboard.php' => ['icon' => 'dashboard', 'label' => 'Dashboard'],
    'settings.php' => ['icon' => 'settings', 'label' => 'Settings'],
    'colors.php' => ['icon' => 'palette', 'label' => 'Theme Colors'],
    'hero.php' => ['icon' => 'front_hand', 'label' => 'Hero Section'],
    'stats.php' => ['icon' => 'analytics', 'label' => 'Statistics'],
    'sections.php' => ['icon' => 'view_agenda', 'label' => 'Home Sections'],
    'social.php' => ['icon' => 'link', 'label' => 'Social Links'],
    'cta.php' => ['icon' => 'call_to_action', 'label' => 'Call to Action'],
    'members.php' => ['icon' => 'group', 'label' => 'Members'],
    'team.php' => ['icon' => 'groups', 'label' => 'Team'],
    'gallery.php' => ['icon' => 'photo_library', 'label' => 'Gallery']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' : ''; ?>Admin - Club Abhiyanta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        surface: '#fafaf3',
                        'surface-dim': '#dadad4',
                        'surface-container-lowest': '#ffffff',
                        'surface-container-low': '#f4f4ee',
                        'surface-container': '#eeeee8',
                        'surface-container-high': '#e8e8e2',
                        'surface-container-highest': '#e3e3dd',
                        'on-surface': '#1a1c19',
                        'on-surface-variant': '#5c403d',
                        outline: '#906f6c',
                        'outline-variant': '#e5bdba',
                        primary: '#a10014',
                        'on-primary': '#ffffff',
                        'primary-container': '#c81d25',
                        'on-primary-container': '#ffddda',
                        secondary: '#5f5e5e',
                        'on-secondary': '#ffffff',
                        'secondary-container': '#e2dfde',
                        'on-secondary-container': '#636262',
                        error: '#ba1a1a',
                        'on-error': '#ffffff',
                        background: '#fafaf3',
                        'on-background': '#1a1c19',
                        'surface-variant': '#e3e3dd'
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif']
                    },
                    borderRadius: {
                        sm: '0.25rem',
                        DEFAULT: '0.5rem',
                        md: '0.75rem',
                        lg: '1rem',
                        xl: '1.5rem'
                    },
                    spacing: {
                        'margin-mobile': '16px',
                        'margin-desktop': '64px'
                    }
                }
            }
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #fafaf3;
            color: #1a1c19;
            line-height: 1.6;
        }
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 280px;
            background: #ffffff;
            border-right: 1px solid #e3e3dd;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }
        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid #e3e3dd;
        }
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #1a1c19;
        }
        .sidebar-logo img {
            height: 40px;
            width: auto;
            border-radius: 8px;
        }
        .sidebar-logo span {
            font-weight: 700;
            font-size: 16px;
        }
        .sidebar-nav {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            text-decoration: none;
            color: #5c403d;
            font-weight: 500;
            font-size: 14px;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
        }
        .nav-item:hover {
            background: #f4f4ee;
            color: #1a1c19;
        }
        .nav-item.active {
            background: #a10014;
            color: #ffffff;
        }
        .nav-item .material-symbols-outlined {
            font-size: 20px;
        }
        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid #e3e3dd;
        }
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            text-decoration: none;
            color: #ba1a1a;
            font-weight: 500;
            font-size: 14px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .logout-btn:hover {
            background: #ffdad6;
        }
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 32px 64px;
            background: #fafaf3;
            min-height: 100vh;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 48px;
        }
        .page-title {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.01em;
            color: #1a1c19;
        }
        .page-subtitle {
            font-size: 16px;
            color: #5c403d;
            margin-top: 4px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .user-details {
            text-align: right;
        }
        .user-name {
            font-weight: 700;
            font-size: 14px;
        }
        .user-role {
            font-size: 12px;
            color: #a10014;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
        }
        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #a10014 0%, #c81d25 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }
        .card {
            background: #ffffff;
            border: 1px solid #e3e3dd;
            border-radius: 16px;
            padding: 24px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-primary {
            background: #a10014;
            color: #ffffff;
        }
        .btn-primary:hover {
            background: #c81d25;
        }
        .btn-secondary {
            background: #ffffff;
            color: #1a1c19;
            border: 1px solid #5c403d;
        }
        .btn-secondary:hover {
            background: #f4f4ee;
        }
        .input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e3e3dd;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            background: #ffffff;
            color: #1a1c19;
            transition: border-color 0.2s ease;
        }
        .input:focus {
            outline: none;
            border-color: #5c403d;
        }
        .input::placeholder {
            color: #906f6c;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th {
            text-align: left;
            padding: 16px;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #5c403d;
            border-bottom: 1px solid #e3e3dd;
        }
        .table td {
            padding: 16px;
            font-size: 14px;
            border-bottom: 1px solid #e3e3dd;
        }
        .table tr:hover {
            background: #f4f4ee;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .badge-active {
            background: #ffddda;
            color: #a10014;
        }
        .badge-pending {
            background: #e5bdba;
            color: #5c403d;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 48px;
        }
        .stat-card {
            background: #ffffff;
            border: 1px solid #e3e3dd;
            border-radius: 16px;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stat-info h3 {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #5c403d;
        }
        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #1a1c19;
            margin-top: 8px;
        }
        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .stat-icon.primary {
            background: #ffddda;
            color: #a10014;
        }
        .stat-icon.secondary {
            background: #e2dfde;
            color: #5c403d;
        }
        .stat-icon.tertiary {
            background: #e4e2e2;
            color: #4e4e4e;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
                padding: 24px 16px;
            }
            .mobile-menu-btn {
                display: block;
            }
        }
        @media (min-width: 769px) and (max-width: 1024px) {
            .sidebar {
                width: 80px;
            }
            .sidebar-header {
                padding: 16px;
            }
            .sidebar-logo span {
                display: none;
            }
            .nav-item span {
                display: none;
            }
            .main-content {
                margin-left: 80px;
                padding: 24px 32px;
            }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="../index.php" class="sidebar-logo">
                    <img src="../assets/images/logo.png" alt="Club Abhiyanta">
                    <span>Admin Panel</span>
                </a>
            </div>
            <nav class="sidebar-nav">
                <?php foreach ($adminPages as $page => $info): ?>
                    <a href="<?php echo $page; ?>" class="nav-item <?php echo $currentPage === $page ? 'active' : ''; ?>">
                        <span class="material-symbols-outlined"><?php echo $info['icon']; ?></span>
                        <span><?php echo $info['label']; ?></span>
                    </a>
                <?php endforeach; ?>
            </nav>
            <div class="sidebar-footer">
                <a href="logout.php" class="logout-btn">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="top-bar">
                <div>
                    <h1 class="page-title"><?php echo isset($pageTitle) ? $pageTitle : 'Dashboard'; ?></h1>
                    <?php if (isset($pageSubtitle)): ?>
                        <p class="page-subtitle"><?php echo $pageSubtitle; ?></p>
                    <?php endif; ?>
                </div>
                <div class="user-info">
                    <div class="user-details">
                        <div class="user-name"><?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin'; ?></div>
                        <div class="user-role"><?php echo isset($_SESSION['admin_role']) ? $_SESSION['admin_role'] : 'Administrator'; ?></div>
                    </div>
                    <div class="user-avatar">
                        <?php echo isset($_SESSION['admin_name']) ? strtoupper(substr($_SESSION['admin_name'], 0, 1)) : 'A'; ?>
                    </div>
                </div>
            </div>