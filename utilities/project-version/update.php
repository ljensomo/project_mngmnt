<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectVersion.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['project_id'], $_POST['version_number'], $_POST['status']]);

$version = new ProjectVersion($_POST['project_id']);
$version->setId($_POST['version_id']);
$version->setVersionNumber($_POST['version_number']);
$version->setRemarks($_POST['remarks']);
$version->setStatus($_POST['status']);
$version->setTargetDateRelease($_POST['target_date_release']);
$version->setReleaseDate($_POST['release_date']);

if($_POST['status'] == 3) {
    $version->deactivateOtherVersions();
}

if($version->update()) {
    echo json_encode(['success' => true, 'message' => 'Version ('.$_POST['version_number'].') has been updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update version.']);
}