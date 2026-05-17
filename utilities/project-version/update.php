<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectVersion.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['project_id'], $_POST['version_number'], $_POST['status']]);

$projectId = $_POST['project_id'];
$target_date_release = $_POST['target_date_release'] ?? null;
$release_date = $_POST['release_date'] ?? null;

if($_POST['status'] == 3) {
    $checkVersion = new ProjectVersion($projectId);
    $checkVersion->deactivateOtherVersions();
}

$version = new ProjectVersion($projectId);
$version->setId($_POST['version_id']);
$version->setRemarks($_POST['remarks']);
$version->setStatus($_POST['status']);
$version->setTargetDateRelease($target_date_release);
$version->setReleaseDate($release_date);

if($version->update()) {
    echo json_encode(['success' => true, 'message' => 'Version ('.$_POST['version_number'].') has been updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update version.']);
}