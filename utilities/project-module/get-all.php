<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectModule.php';

$project_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
$module = new ProjectModule($project_id);
$modules = $module->getProjectModules();

echo json_encode(['data' => $modules]);