<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectFeature.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id']]);

$feature = new ProjectFeature();

if($feature->deleteById($_POST['id'])) {
    echo json_encode(['success' => true, 'message' => 'Feature has been deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting task.']);
}