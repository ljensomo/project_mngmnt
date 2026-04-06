<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectStatus.php';

$projectStatus = new ProjectStatus();
$projectStatuses = $projectStatus->getProjectStatuses();

echo json_encode(['data' => $projectStatuses]);