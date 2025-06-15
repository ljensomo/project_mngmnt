<?php 

require_once '../../Class/Database.php';
require_once '../../Class/User.php';

if(isset($_POST['fname']) && isset($_POST['lname'])) {
    $user = new User();

    $user->setFirstname($_POST['fname']);
    $user->setLastname($_POST['lname']);
    $user->setUsername();
    $user->setPassword(); // Default password, can be changed later

    // Assuming you have a method to add a user in the User class
    if($user->add()) {
        echo json_encode(['status' => 'success', 'message' => 'User added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add user']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid access']);
}