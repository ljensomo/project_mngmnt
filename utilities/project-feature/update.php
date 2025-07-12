<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectFeature.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['feature_id'], $_POST['feature'], $_POST['description']]);

$task = new ProjectFeature($_POST['project_id']);
$task->setId($_POST['feature_id']);
$task->setFeature($_POST['feature']);
$task->setDescription($_POST['description']);
$task->setStatus($_POST['status']);

if($task->update()) {
    echo json_encode(['success' => true, 'message' => 'Feature ('.$_POST['feature'].') has been updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update task.']);
}