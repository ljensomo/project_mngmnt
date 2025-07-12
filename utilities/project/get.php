<?php

require_once '../../Class/Database.php';
require_once '../../Class/Project.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_GET['id']]);

$project = new Project();
$projectData = $project->getById($_GET['id']);

echo json_encode(['success' => true, 'data' => $projectData]);