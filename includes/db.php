<?php
// Database configuration – InfinityFree hosted MySQL
// $servername = "sql206.infinityfree.com";
// $username   = "if0_41854521";
// $password   = "9xT61JuBU2e8IB";
// $dbname     = "if0_41854521_club_test";


$servername = "localhost";
$username   = "ektamultp_club";
$password   = "IpD}Rzia7ch,@[M^";
$dbname     = "ektamultp_club";

// Create connection to the hosted database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}

// Define Base URL (Adjust this to your server path)
$base_url = "https://app.ektamultipurposecoop.com.np/";

// Helper function to get settings
if (!function_exists('getSetting')) {
    function getSetting($key, $default = "") {
        global $conn;
        $key = $conn->real_escape_string($key);
        $sql = "SELECT setting_value FROM settings WHERE setting_key = '$key'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['setting_value'];
        }
        return $default;
    }
}

// Get all site colors as array
if (!function_exists('getSiteColors')) {
    function getSiteColors() {
        global $conn;
        $colors = [];
        $result = $conn->query("SELECT color_key, color_value FROM site_colors");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $colors[$row['color_key']] = $row['color_value'];
            }
        }
        return $colors;
    }
}

// Get stats for homepage
if (!function_exists('getStats')) {
    function getStats() {
        global $conn;
        $stats = [];
        $result = $conn->query("SELECT * FROM stats WHERE is_visible = 1 ORDER BY sort_order ASC");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $stats[] = $row;
            }
        }
        return $stats;
    }
}

// Get home sections
if (!function_exists('getHomeSections')) {
    function getHomeSections() {
        global $conn;
        $sections = [];
        $result = $conn->query("SELECT * FROM home_sections WHERE is_visible = 1 ORDER BY sort_order ASC");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $sections[] = $row;
            }
        }
        return $sections;
    }
}

// Get social links
if (!function_exists('getSocialLinks')) {
    function getSocialLinks() {
        global $conn;
        $links = [];
        $result = $conn->query("SELECT * FROM social_links WHERE is_visible = 1 ORDER BY sort_order ASC");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $links[] = $row;
            }
        }
        return $links;
    }
}

// Get CTA sections
if (!function_exists('getCTASections')) {
    function getCTASections() {
        global $conn;
        $ctas = [];
        $result = $conn->query("SELECT * FROM cta_sections WHERE is_visible = 1");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $ctas[] = $row;
            }
        }
        return $ctas;
    }
}

// Get all settings as array
if (!function_exists('getAllSettings')) {
    function getAllSettings() {
        global $conn;
        $settings = [];
        $result = $conn->query("SELECT setting_key, setting_value FROM settings");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        }
        return $settings;
    }
}

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>