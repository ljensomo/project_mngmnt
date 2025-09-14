<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectFeature.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['feature'], $_POST['description']]);

$feature = new ProjectFeature($_POST['project-id']);
$feature->setModuleId($_POST['module']);
$feature->setFeature($_POST['feature']);
$feature->setDescription($_POST['description']);
$feature->setStatus(1);
$feature->setCreatedBy(1);
$feature->setVersion($_POST['version_id']);

if($feature->add()) {
    echo json_encode(['success' => true, 'message' => 'Feature ('.$_POST['feature'].') has been created successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create feature.']);
}