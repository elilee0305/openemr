<?php
// bootstrap-isolated.php

declare(strict_types=1);

if (php_sapi_name() !== 'cli') exit('CLI only');

$vendorDir = dirname(__DIR__) . '/vendor';
require_once $vendorDir . '/autoload.php';

// Prevent any database connections
$GLOBALS['disable_database_connection'] = true;

// Mock database functions used in globals.php
if (!empty($GLOBALS['disable_database_connection'])) {
    function sqlQueryNoLog($query, $params = [], $silentFail = false) {
        return [];
    }
    function sqlStatementNoLog($query, $params = []) {
        return [];
    }
    function sqlFetchArray($result) {
        return false;
    }
}
