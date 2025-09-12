<?php
declare(strict_types=1);

/**
 * Bootstrap for PHPUnit isolated tests
 * Bypasses database and translation functions
 */

// Ensure CLI mode
if (php_sapi_name() !== 'cli') {
    exit('This bootstrap can only be run from the command line.');
}

// Set minimal globals
$GLOBALS['webserver_root'] = dirname(__DIR__);
$GLOBALS['OE_SITES_BASE'] = $GLOBALS['webserver_root'] . '/sites';
$GLOBALS['vendor_dir'] = $GLOBALS['webserver_root'] . '/vendor';
$GLOBALS['disable_database_connection'] = true;

// Load Composer autoloader
$autoload = $GLOBALS['vendor_dir'] . '/autoload.php';
if (!file_exists($autoload)) {
    throw new RuntimeException('Composer autoloader not found. Run "composer install".');
}
require_once $autoload;

// Mock database functions
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

// Optionally set minimal charset
$GLOBALS['HTML_CHARSET'] = 'UTF-8';
ini_set('default_charset', 'utf-8');
mb_internal_encoding('UTF-8');

// Include OpenEMR globals (safe because DB calls are mocked)
require_once $GLOBALS['webserver_root'] . '/interface/globals.php';
