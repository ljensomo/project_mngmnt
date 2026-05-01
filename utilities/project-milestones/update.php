<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectMilestone.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['project_id']]);

foreach($_POST['milestone'] as $phaseId => $dueDate){
    $milestone = new ProjectMilestone($_POST['project_id']);
    $milestone->setDueDate($dueDate);
    $milestone->setPhaseId($phaseId);
    $milestone->updateDueDate();
}

echo json_encode(['success' => true, 'message' => 'Project Milestone has been updated.']);