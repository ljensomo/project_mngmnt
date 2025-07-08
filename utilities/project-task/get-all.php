<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTask.php';

$project_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
$task = new ProjectTask($project_id);
$tasks = $task->getProjectTasks();

echo json_encode(['data' => $tasks]);