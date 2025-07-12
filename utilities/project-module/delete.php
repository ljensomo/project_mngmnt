<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectModule.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id']]);

$module = new ProjectModule();

if($module->deleteById($_POST['id'])) {
    echo json_encode(['success' => true, 'message' => 'Module has been deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting task.']);
}