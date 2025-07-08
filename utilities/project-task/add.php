<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTask.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['task'], $_POST['description']]);

$task = new ProjectTask($_POST['project-id']);
$task->setTaskName($_POST['task']);
$task->setDescription($_POST['description']);
$task->setStatus(1);
$task->setAssignedTo($_POST['assign-to']);
$task->setCreatedBy(1);
if($task->add()) {
    echo json_encode(['success' => true, 'message' => 'Task ('.$_POST['task'].') has been created successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create task.']);
}