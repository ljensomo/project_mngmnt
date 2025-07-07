<?php

require_once '../../Class/Database.php';
require_once '../../Class/Project.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id']]);

$project = new Project();

if($project->deleteById($_POST['id'])) {
    echo json_encode(['success' => true, 'message' => 'Project has been deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting project.']);
}