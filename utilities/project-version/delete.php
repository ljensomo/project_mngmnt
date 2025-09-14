<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectVersion.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['id']]);

$version = new ProjectVersion();

if($version->deleteById($_POST['id'])) {
    echo json_encode(['success' => true, 'message' => 'Version has been deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting version.']);
}