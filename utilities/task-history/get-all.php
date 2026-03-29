<?php

require_once '../../Class/Database.php';
require_once '../../Class/TaskHistory.php';
require_once '../../utilities/utilities.php';

$task_id = isset($_GET['tid']) ? intval($_GET['tid']) : 0;
$taskHistory = new TaskHistory($task_id);
$history = $taskHistory->getTaskHistory($_GET['last_id']);

// format data 
$data = [];
foreach ($history as $entry) {
    $record = [];
    $record['id'] = $entry['id'];
    $record['type'] = $entry['history_type'];
    $record['user'] = $entry['first_name'] . ' ' . $entry['last_name'];
    $record['title'] = $entry['title'];
    $record['description'] = $entry['description'];
    $record['history_type'] = $entry['history_type'];
    $record['date_created'] = get_relative_time($entry['date_created']);
    $data[] = $record;
}

echo json_encode(['data' => $data]);