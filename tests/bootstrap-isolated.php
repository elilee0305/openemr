<?php
declare(strict_types=1);

// Disable database for isolated tests
$GLOBALS['disable_database_connection'] = true;

// Only declare mocks if they aren't already defined
if (!function_exists('sqlStatementNoLog')) {
    function sqlStatementNoLog($sql, $params = []) {
        return []; // empty array instead of running query
    }
}
if (!function_exists('sqlQueryNoLog')) {
    function sqlQueryNoLog($sql, $params = [], $allow_null = false) {
        return []; // empty array instead of running query
    }
}
if (!function_exists('sqlFetchArray')) {
    function sqlFetchArray($result) {
        return false; // no rows
    }
}
if (!function_exists('xlt')) {
    function xlt($text) {
        return $text; // skip translation
    }
}
if (!function_exists('xl')) {
    function xl($text) {
        return $text; // skip translation
    }
}

// Mock a default site ID to avoid session errors
if (empty($_SESSION['site_id'])) {
    $_SESSION['site_id'] = 'default';
}

require_once dirname(__DIR__) . '/interface/globals.php';
