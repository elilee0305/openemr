<?php
declare(strict_types=1);

/**
 * OpenEMR Isolated PHPUnit Bootstrap
 * Only for isolated tests (no DB, no full globals.php)
 */

// Start session with a default site ID
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['site_id'])) {
    $_SESSION['site_id'] = 'default';
}

// Disable database connections
$GLOBALS['disable_database_connection'] = true;

// Set minimal required globals
$webserver_root = dirname(__DIR__);
$web_root = '/openemr';
$GLOBALS['OE_SITES_BASE'] = "$webserver_root/sites";
$GLOBALS['OE_SITE_DIR'] = $GLOBALS['OE_SITES_BASE'] . "/" . $_SESSION['site_id'];
$GLOBALS['rootdir'] = "$web_root/interface";
$GLOBALS['srcdir'] = "$webserver_root/library";
$GLOBALS['fileroot'] = $webserver_root;

// Mock SQL functions
if (!function_exists('sqlStatementNoLog')) {
    function sqlStatementNoLog($sql, $params = []) {
        return [];
    }
}
if (!function_exists('sqlQueryNoLog')) {
    function sqlQueryNoLog($sql, $params = [], $allow_null = false) {
        return [];
    }
}
if (!function_exists('sqlFetchArray')) {
    function sqlFetchArray($result) {
        return false;
    }
}

// Mock translation functions
if (!function_exists('xlt')) {
    function xlt($text) {
        return $text;
    }
}
if (!function_exists('xl')) {
    function xl($text) {
        return $text;
    }
}

// Include composer autoload
require_once $webserver_root . '/vendor/autoload.php';

// Minimal error reporting for tests
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', '1');

// Optional: define dummy session variables used in tests
$_SESSION['authUserID'] = 1;
$_SESSION['userauthorized'] = 1;
