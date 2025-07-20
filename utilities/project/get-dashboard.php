<?php 

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTask.php';
require_once '../../Class/ProjectModule.php';
require_once '../../Class/ProjectFeature.php';

$project_id = $_GET['pid'] ?? null;

$task = new ProjectTask($project_id);
$project_task = [
    'open' => $task->getProjectTasksByStatus(1),
    'in_progress' => $task->getProjectTasksByStatus(2),
    'completed' => $task->getProjectTasksByStatus(3),
    'on_hold' => $task->getProjectTasksByStatus(4)
];

$module = new ProjectModule($project_id);
$project_modules = [
    'open' => $module->getProjectModulesByStatus(1),
    'in_progress' => $module->getProjectModulesByStatus(2),
    'completed' => $module->getProjectModulesByStatus(3),
    'on_hold' => $module->getProjectModulesByStatus(4)
];

$feature = new ProjectFeature($project_id);
$project_features = [
    'open' => $feature->getProjectFeaturesByStatus(1),
    'in_progress' => $feature->getProjectFeaturesByStatus(2),
    'completed' => $feature->getProjectFeaturesByStatus(3),
    'on_hold' => $feature->getProjectFeaturesByStatus(4)
];

echo json_encode([
    'tasks' => $project_task,
    'modules' => $project_modules,
    'features' => $project_features
]);