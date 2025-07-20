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