<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTech.php';

$project_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
$tech = new ProjectTech($project_id);
$technologies = $tech->getProjectTechs();

echo json_encode(['data' => $technologies]);