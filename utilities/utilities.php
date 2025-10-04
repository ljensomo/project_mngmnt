<?php

date_default_timezone_set('Asia/Manila'); 

function isValidRequest($parameters) {
    foreach ($parameters as $param) {
        if (!isset($param) || empty(trim($param))) {
            exit(json_encode(['success' => false, 'message' => 'Invalid access!']));
        }
    }
}

function jsonResponse($status, $message) {
    exit(json_encode(['success' => $status, 'message' => $message]));
}

function hasValidSession() {
    if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
        return false;
    }
    return true;
}

function formatBytes($bytes, $precision = 2) {
    // Array of units
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];

    $bytes = max($bytes, 0); 
    // Calculate the power/unit index (e.g., 1024 bytes is 1 unit up)
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Format the number to the desired precision
    $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}