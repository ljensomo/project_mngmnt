<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectVersion.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['version_number'], $_POST['project-id']]);

$task = new ProjectVersion($_POST['project-id']);
$task->setVersionNumber($_POST['version_number']);
$task->setTargetDateRelease($_POST['release_date']);
$task->setRemarks($_POST['remarks']);
$task->setStatus($_POST['status']);
if($task->add()) {
    echo json_encode(['success' => true, 'message' => 'Version ('.$_POST['version_number'].') has been created successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create version.']);
}