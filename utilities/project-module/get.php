<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectModule.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_GET['id']]);

$module = new ProjectModule();
$moduleData = $module->getById($_GET['id']);

echo json_encode(['success' => true, 'data' => $moduleData]);