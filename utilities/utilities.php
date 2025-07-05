<?php

function isValidRequest($parameters) {
    foreach ($parameters as $param) {
        if (!isset($param) || empty(trim($param))) {
            exit(json_encode(['success' => false, 'message' => 'Invalid access!']));
        }
    }
}