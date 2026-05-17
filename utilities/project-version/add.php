<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectVersion.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['project-id'], $_POST['status']]);

$version = new ProjectVersion($_POST['project-id']);
$versionType = $_POST['version_bump_type'] ?? 3; // Default to patch if not provided
$version->setVersionType($versionType);

if($version->hasVersion()){
    $latestVersion = $version->getLatestVersion();

    if(in_array($latestVersion['status'], [1, 2])) {
        switch ($latestVersion['status']) {
            case 1:
                $message = 'Cannot create version. The latest version is still in development.';
                break;
            case 2:
                $message = 'Cannot create version. The latest version is ready for release.';
                break;
        }
        echo json_encode(['success' => false, 'message' => $message]);
        exit;
    }

    $currentVersionNumber = $latestVersion['version_number'];
    $vParts = explode('.', $currentVersionNumber);

    $major = (int)($vParts[0] ?? 0);
    $minor = (int)($vParts[1] ?? 0);
    $patch = (int)($vParts[2] ?? 0);

    switch (strtolower($versionType)) {
        case 1: // Major version increment
            $major++;
            $minor = 0;
            $patch = 0;
            break;
            
        case 2: // Minor version increment
            $minor++;
            $patch = 0;
            break;
            
        case 3: // Patch version increment
            $patch++;
            break;
    }

    $newVersion = "{$major}.{$minor}.{$patch}";

    $version->setVersionNumber($newVersion);
}else {
    $version->setVersionNumber('1.0.0'); // Default version number for new projects
}

$version->setTargetDateRelease($_POST['release_date']);
$version->setRemarks($_POST['remarks']);
$version->setStatus($_POST['status']);

if($version->add()) {
    echo json_encode(['success' => true, 'message' => 'Version created successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create version.']);
}