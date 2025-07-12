<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTask.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_GET['id']]);

$task = new ProjectTask();
$taskData = $task->getById($_GET['id']);

echo json_encode(['success' => true, 'data' => $taskData]);