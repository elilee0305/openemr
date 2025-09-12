<?php
// Prevent any real database calls
$GLOBALS['disable_database_connection'] = true;

// Mock SQL functions to bypass actual queries
if (!function_exists('sqlStatementNoLog')) {
    function sqlStatementNoLog($sql, $params = []) {
        return []; // return empty array
    }
}
if (!function_exists('sqlQueryNoLog')) {
    function sqlQueryNoLog($sql, $params = [], $allow_null = false) {
        return []; // return empty array
    }
}
if (!function_exists('sqlFetchArray')) {
    function sqlFetchArray($result) {
        return false; // no rows
    }
}
