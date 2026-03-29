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

function get_relative_time($datetime) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $intervals = [
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];

    foreach ($intervals as $key => $label) {
        if ($diff->$key) {
            $value = $diff->$key;
            return $value . ' ' . $label . ($value > 1 ? 's' : '') . ' ago';
        }
    }

    return 'just now';
}

function getStatusName($status_id) {
    $status = new TaskStatus();
    $statusData = $status->getById($status_id);
    return $statusData ? $statusData['status'] : 'Unknown';
}