<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectModule.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['module'], $_POST['description']]);

$module = new ProjectModule($_POST['project-id']);
$module->setModule($_POST['module']);
$module->setDescription($_POST['description']);
$module->setStatus(1);
$module->setCreatedBy(1);
$module->setVersion($_POST['version_id']);

if($module->add()) {
    echo json_encode(['success' => true, 'message' => 'Module ('.$_POST['module'].') has been created successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create module.']);
}