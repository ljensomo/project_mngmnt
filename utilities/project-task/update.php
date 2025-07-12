<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTask.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['task_id'], $_POST['task'], $_POST['description']]);

$task = new ProjectTask($_POST['project_id']);
$task->setId($_POST['task_id']);
$task->setType($_POST['type']);
$task->setTaskName($_POST['task']);
$task->setDescription($_POST['description']);
$task->setAssignedTo($_POST['assign_to']);
$task->setStatus($_POST['status']);

if($task->update()) {
    echo json_encode(['success' => true, 'message' => 'Task ('.$_POST['task'].') has been updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update task.']);
}