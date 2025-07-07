<?php

require_once '../../Class/Database.php';
require_once '../../Class/Project.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id']]);

$project = new Project();
$projectData = $project->getById($_POST['id']);

echo json_encode(['success' => true, 'data' => $projectData]);