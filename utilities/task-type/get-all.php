<?php

require_once '../../Class/Database.php';
require_once '../../Class/TaskType.php';

$taskType = new TaskType();
$taskTypes = $taskType->getTaskTypes();

echo json_encode(['data' => $taskTypes]);