<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectFeature.php';

$project_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
$feature = new ProjectFeature($project_id);
$features = $feature->getProjectFeatures();

echo json_encode(['data' => $features]);