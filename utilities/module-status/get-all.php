<?php

require_once '../../Class/Database.php';
require_once '../../Class/ModuleStatus.php';

$moduleStatus = new ModuleStatus();
$moduleStatuses = $moduleStatus->getTaskStatuses();

echo json_encode(['data' => $moduleStatuses]);