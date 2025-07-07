<?php

class ProjectTask extends Database {

    const TABLE_NAME = 'project_tasks';

    private $id;
    private $project_id;
    private $task_name;
    private $description;
    private $status;
    private $assigned_to;

    public function __construct() {
        parent::__construct(self::TABLE_NAME);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setProjectId($project_id) {
        $this->project_id = $project_id;
    }

    public function setTaskName($task_name) {
        $this->task_name = $task_name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setAssignedTo($assigned_to) {
        $this->assigned_to = $assigned_to;
    }

    public function getAll(){
        return $this->sqlSelect()->where([
            'column_name' => 'project_id',
            'operator' => '=',
            'value' => $this->project_id
        ])->get();
    }
}