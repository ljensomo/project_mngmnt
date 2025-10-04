<?php

require_once '../../Class/Database.php';
require_once '../../Class/User.php';
require_once '../../utilities/utilities.php';

// Validate request parameters
isValidRequest([$_GET['id']]);

$user = new User();
$userData = $user->getById($_GET['id']);

echo json_encode(['success' => true, 'data' => $userData]);