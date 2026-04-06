<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectStatus.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['phase'], $_POST['description']]);

$projectStatus = new ProjectStatus();
$projectStatus->setPhase($_POST['phase']);
$projectStatus->setDescription($_POST['description']);

if($projectStatus->add()) {
    echo json_encode(['success' => true, 'message' => 'Project Status ('.$_POST['phase'].') has been created successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create project status.']);
}