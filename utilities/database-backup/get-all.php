<?php

require_once '../../Class/Database.php';
require_once '../../Class/DatabaseBackup.php';
require_once '../../utilities/utilities.php';

$databaseBackup = new DatabaseBackup();
$backups = $databaseBackup->getBackups();

foreach ($backups as &$backup) {
    $backup['file_size'] = formatBytes($backup['file_size']);
}

echo json_encode(['data' => $backups]);