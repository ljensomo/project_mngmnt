<?php

require_once '../../Class/Database.php';
require_once '../../Class/User.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id'], $_POST['fname'], $_POST['lname']]);

$user = new User();
$user->setFirstname($_POST['fname']); 
$user->setLastname($_POST['lname']);
$user->setUserId($_POST['id']);

if($user->update()){
    echo json_encode(['success' => true, 'message' => 'User has been updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating user.']);
}