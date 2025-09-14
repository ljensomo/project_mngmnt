<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectVersion.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_GET['id']]);

$version = new ProjectVersion();
$versionData = $version->getById($_GET['id']);

echo json_encode(['success' => true, 'data' => $versionData]);