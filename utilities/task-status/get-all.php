<?php

require_once '../../Class/Database.php';
require_once '../../Class/TaskStatus.php';

$taskStatus = new TaskStatus();
$taskStatuses = $taskStatus->getTaskStatuses();

echo json_encode(['data' => $taskStatuses]);