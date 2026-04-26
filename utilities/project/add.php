<?php

session_start();

require_once '../../Class/Database.php';
require_once '../../Class/Project.php';
require_once '../../Class/ProjectTask.php';
require_once '../../Class/PhaseRequirement.php';
require_once '../../Class/ProjectMilestone.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['name'], $_POST['description']]);

$project = new Project();
$project->setName($_POST['name']);
$project->setDescription($_POST['description']);
$project->setPhaseId(1); // Default to Planning phase
$project->setStatus(1);
$project->setCreatedBy($_SESSION['user']['id']);

if ($project->add()) {
    // Success

    $projectId = $project->getLastInsertedId();

    $requirement = new PhaseRequirement();
    $requirement->setPhaseId(1);
    $requirement->generateTasksForPhase($projectId);

    $milestone = new ProjectMilestone();
    $milestone->setProjectId($projectId);
    $milestone->generateMilestones();

    echo json_encode([
        'success' => true, 
        'message' => 'Project "' . htmlspecialchars($_POST['name']) . '" has been initialized and set to the Planning phase.'
    ]);
} else {
    // Error
    echo json_encode([
        'success' => false, 
        'message' => 'Unable to initialize project. Please verify that all required fields are provided and try again.'
    ]);
}