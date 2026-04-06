<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectStatus.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_GET['id']]);

$projectStatus = new ProjectStatus();
$projectStatusData = $projectStatus->getById($_GET['id']);

echo json_encode(['success' => true, 'data' => $projectStatusData]);