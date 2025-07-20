<?php

require_once '../Class/Database.php';
require_once '../Class/Login.php';
require_once 'utilities.php';

isValidRequest([$_POST['username'], $_POST['password']]);

$username = $_POST['username'];
$password = $_POST['password'];

$login = new Login($username, $password);
$valid_user = $login->authenticate();

if($valid_user) {
    session_start();
    $_SESSION['user'] = $valid_user;
    exit(jsonResponse(true, 'Authentication successful!'));
} else {
    exit(jsonResponse(false, $login->getErrorMessage()));
}