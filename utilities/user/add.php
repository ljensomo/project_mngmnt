<?php 

require_once '../../Class/Database.php';
require_once '../../Class/User.php';

if(isset($_POST['fname']) && isset($_POST['lname'])) {
    $user = new User();

    $user->setFirstname($_POST['fname']);
    $user->setLastname($_POST['lname']);
    $user->setUsername();
    $user->setPassword(); // Default password, can be changed later

    if($user->add()) {
        echo json_encode(['success' => true, 'message' => 'User ('.$_POST['fname'].' '.$_POST['lname'].') has been registered successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to register user.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid access!']);
}