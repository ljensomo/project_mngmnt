<?php

require_once '../../Class/Database.php';
require_once '../../Class/User.php';
require_once '../../utilities/utilities.php';

// Validate request parameters
isValidRequest([$_POST['id']]);

$user = new User();
if($user->deleteById($_POST['id'])) {
    echo json_encode(['success' => true, 'message' => 'User has been deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting user.']);
}