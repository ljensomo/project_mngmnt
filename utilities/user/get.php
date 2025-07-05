<?php

require_once '../../Class/Database.php';
require_once '../../Class/User.php';
require_once '../../utilities/utilities.php';

// Validate request parameters
isValidRequest([$_POST['id']]);

$user = new User();
$userData = $user->getById($_POST['id']);

echo json_encode(['success' => true, 'data' => $userData]);