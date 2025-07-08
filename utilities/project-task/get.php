<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTask.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id']]);

$task = new ProjectTask();
$taskData = $task->getById($_POST['id']);

echo json_encode(['success' => true, 'data' => $taskData]);