<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectStatus.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id']]);

$projectStatus = new ProjectStatus();

if($projectStatus->deleteById($_POST['id'])) {
    echo json_encode(['success' => true, 'message' => 'Project Status has been deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting project status.']);
}