<?php

require_once '../../Class/Database.php';
require_once '../../Class/FeatureStatus.php';

$featureStatus = new FeatureStatus();
$featureStatuses = $featureStatus->getTaskStatuses();

echo json_encode(['data' => $featureStatuses]);