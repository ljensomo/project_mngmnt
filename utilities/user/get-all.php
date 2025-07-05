<?php 

require_once '../../Class/Database.php';
require_once '../../Class/User.php';

$user = new User();
$users = $user->getAll();

echo json_encode(['data' => $users]);