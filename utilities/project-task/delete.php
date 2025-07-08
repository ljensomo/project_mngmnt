<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTask.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id']]);

$task = new ProjectTask();

if($task->deleteById($_POST['id'])) {
    echo json_encode(['success' => true, 'message' => 'Task has been deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting task.']);
}