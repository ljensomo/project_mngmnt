<?php 

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTask.php';
require_once '../../Class/ProjectModule.php';
require_once '../../Class/ProjectFeature.php';

$project_id = $_GET['pid'] ?? null;

$task = new ProjectTask($project_id);
$module = new ProjectModule($project_id);
$feature = new ProjectFeature($project_id);

echo json_encode([
    'tasks' => $task->getOpenProjectTasksCount(),
    'modules' => $module->getPorjectModuleCount(),
    'features' => $feature->getProjectFeatureCount()
]);