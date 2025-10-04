<?php

require_once '../../Class/Database.php';
require_once '../../Class/DatabaseBackup.php';

$databaseBackup = new DatabaseBackup();

if($databaseBackup->generateDatabaseDump()) {
    echo json_encode(['success' => true, 'message' => 'A new database backup generated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to generate database backup.']);
}