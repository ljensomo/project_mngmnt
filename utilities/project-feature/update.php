<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectFeature.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['feature_id'], $_POST['feature'], $_POST['description']]);

$feature = new ProjectFeature($_POST['project_id']);
$feature->setId($_POST['feature_id']);
$feature->setFeature($_POST['feature']);
$feature->setDescription($_POST['description']);
$feature->setStatus($_POST['status']);
$feature->setVersion($_POST['version_id']);

if($feature->update()) {
    echo json_encode(['success' => true, 'message' => 'Feature ('.$_POST['feature'].') has been updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update feature.']);
}