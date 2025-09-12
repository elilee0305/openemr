<?php
declare(strict_types=1);

// Disable database for isolated tests
$GLOBALS['disable_database_connection'] = true;

// Mock all SQL functions to return empty results
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

require_once dirname(__DIR__) . '/interface/globals.php';