<?php

session_start();

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTask.php';
require_once '../../Class/TaskHistory.php';
require_once '../../utilities/utilities.php';
require_once '../../Class/TaskStatus.php';

isValidRequest([$_POST['task_id'], $_POST['task'], $_POST['description']]);

$project_id = isset($_POST['project_id']) ? intval($_POST['project_id']) : null;

$task = new ProjectTask($project_id);
$task->setId($_POST['task_id']);
$task->setType($_POST['type']);
$task->setTaskName($_POST['task']);
$task->setDescription($_POST['description']);
$task->setAssignedTo($_POST['assignee']);
$task->setStatus($_POST['status']);

// old task data for history
$oldTask = new ProjectTask();
$taskData = $oldTask->getById($_POST['task_id']);

if($task->update()) {

    if($_POST['task'] != $taskData['task']) {
        $history = new TaskHistory($_POST['task_id']);
        $history->setDescription('Task name changed from "'.$taskData['task'].'" to "'.$_POST['task'].'".');
        $history->setType(2); // 2 for update
        $history->setCreatedBy($_SESSION['user']['id']);
        $history->add();
    }

    if($_POST['description'] != $taskData['description']) {
        $history = new TaskHistory($_POST['task_id']);
        $history->setDescription('Task description changed from "'.$taskData['description'].'" to "'.$_POST['description'].'".');
        $history->setType(2); // 2 for update
        $history->setCreatedBy($_SESSION['user']['id']);
        $history->add();
    }

    if($_POST['assignee'] != $taskData['assigned_to']) {
        $history = new TaskHistory($_POST['task_id']);
        $history->setDescription('Task assigned to changed from user#' .$taskData['assigned_to']. ' to user# '.$_POST['assignee'].'.');
        $history->setType(2); // 2 for update
        $history->setCreatedBy($_SESSION['user']['id']);
        $history->add();
    }

    if($_POST['status'] != $taskData['status']) {
        $history = new TaskHistory($_POST['task_id']);
        $history->setDescription('Task status changed from "'.getStatusName($taskData['status']).'" to "'.getStatusName($_POST['status']).'".');
        $history->setType(2); // 2 for update
        $history->setCreatedBy($_SESSION['user']['id']);
        $history->add();
    }

    echo json_encode(['success' => true, 'message' => 'Task ('.$_POST['task'].') has been updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update task.']);
}