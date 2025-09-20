<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTech.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['project_id'], $_POST['technology'], $_POST['type']]);

$tech = new ProjectTech($_POST['project_id']);
$tech->setId($_POST['tech_id']);
$tech->setTechnology($_POST['technology']);
$tech->setDescription($_POST['description']);
$tech->setType($_POST['type']);

if($tech->update()) {
    echo json_encode(['success' => true, 'message' => 'Technology ('.$_POST['technology'].') has been updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update technology.']);
}