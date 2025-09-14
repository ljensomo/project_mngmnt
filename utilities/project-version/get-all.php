<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectVersion.php';

$project_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
$version = new ProjectVersion($project_id);
$versions = $version->getProjectVersions();

echo json_encode(['data' => $versions]);