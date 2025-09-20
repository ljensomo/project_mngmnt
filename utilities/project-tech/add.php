<?php

require_once '../../Class/Database.php';
require_once '../../Class/ProjectTech.php';
require_once '../../utilities/utilities.php';

isValidRequest([$_POST['technology'], $_POST['project-id']]);

$tech = new ProjectTech($_POST['project-id']);
$tech->setTechnology($_POST['technology']);
$tech->setDescription($_POST['description']);
$tech->setType($_POST['type']);
if($tech->add()) {
    echo json_encode(['success' => true, 'message' => 'Technology ('.$_POST['technology'].') has been added successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add technology.']);
}