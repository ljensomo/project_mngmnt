<?php

require_once '../../Class/Database.php';
require_once '../../Class/Project.php';

$project = new Project();
$projects = $project->getProjects();

echo json_encode(['data' => $projects]);