<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectFeature.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_GET['id']]);

$feature = new ProjectFeature();
$featureData = $feature->getById($_GET['id']);

echo json_encode(['success' => true, 'data' => $featureData]);