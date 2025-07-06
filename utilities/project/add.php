<?php

require_once '../../Class/Database.php';
require_once '../../Class/Project.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['name'], $_POST['description']]);

$project = new Project();
$project->setName($_POST['name']);
$project->setDescription($_POST['description']);
$project->setStatus(1);
$project->setCreatedBy(1);

if($project->add()) {
    echo json_encode(['success' => true, 'message' => 'Project ('.$_POST['name'].') has been created successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create project.']);
}