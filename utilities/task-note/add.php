<?php

session_start();

require_once '../../Class/Database.php';
require_once '../../Class/TaskNote.php';
require_once '../../Class/TaskHistory.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['task_id'], $_POST['note']]);

$taskNote = new TaskNote();
$taskNote->setTaskId($_POST['task_id']);
$taskNote->setNote($_POST['note']);
$taskNote->setCreatedBy($_SESSION['user']['id']);

if($taskNote->add()) {
    $history = new TaskHistory($_POST['task_id']);
    $history->setDescription($_POST['note']);
    $history->setType(1); // Type 1 for note addition
    $history->setCreatedBy($_SESSION['user']['id']);
    $history->add();
    
    echo json_encode(['success' => true, 'message' => 'Task note has been added successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add task note.']);
}