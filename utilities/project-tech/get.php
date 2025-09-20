<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTech.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_GET['id']]);

$tech = new ProjectTech();
$techData = $tech->getById($_GET['id']);

echo json_encode(['success' => true, 'data' => $techData]);