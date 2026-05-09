<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectMilestone.php';

$project_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
$milestone = new ProjectMilestone($project_id);
$milestones = $milestone->getProjectMilestones();

if(count($milestones) === 0) {
    $milestone->generateMilestones();
    $milestones = $milestone->getProjectMilestones();
}

echo json_encode(['data' => $milestones]);