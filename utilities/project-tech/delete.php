<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTech.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id']]);

$tech = new ProjectTech();

if($tech->deleteById($_POST['id'])) {
    echo json_encode(['success' => true, 'message' => 'Technology has been deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting technology.']);
}