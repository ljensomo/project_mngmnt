<?php

require_once '../../Class/Database.php';
require_once '../../Class/Project.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id'], $_POST['name'], $_POST['description']]);

$project = new Project();
$project->setId($_POST['id']);
$project->setName($_POST['name']);
$project->setDescription($_POST['description']);
$project->setPhaseId($_POST['phase']);
$project->setCreatedBy(1);

if($project->update()) {
    echo json_encode(['success' => true, 'message' => 'Project ('.$_POST['name'].') has been updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update project.']);
}