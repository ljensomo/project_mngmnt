<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectModule.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['module_id'], $_POST['module'], $_POST['description']]);

$module = new ProjectModule($_POST['project_id']);
$module->setId($_POST['module_id']);
$module->setModule($_POST['module']);
$module->setDescription($_POST['description']);
$module->setStatus($_POST['status']);

if($module->update()) {
    echo json_encode(['success' => true, 'message' => 'Module ('.$_POST['module'].') has been updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update module.']);
}