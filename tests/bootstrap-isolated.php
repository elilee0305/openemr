<?php
declare(strict_types=1);

// Disable database
$GLOBALS['disable_database_connection'] = true;

// Ensure a site ID exists to prevent errors
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['site_id'])) {
    $_SESSION['site_id'] = 'default';
}

// Mock SQL and translation functions
if (!function_exists('sqlStatementNoLog')) {
    function sqlStatementNoLog($sql, $params = []) { return []; }
}
if (!function_exists('sqlQueryNoLog')) {
    function sqlQueryNoLog($sql, $params = [], $allow_null = false) { return []; }
}
if (!function_exists('sqlFetchArray')) {
    function sqlFetchArray($result) { return false; }
}
if (!function_exists('xlt')) { function xlt($text) { return $text; } }
if (!function_exists('xl')) { function xl($text) { return $text; } }

// Now include globals safely
require_once dirname(__DIR__) . '/interface/globals.php';
