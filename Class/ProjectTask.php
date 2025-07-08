<?php

class ProjectTask extends Database {

    const TABLE_NAME = 'project_tasks';

    private $id;
    private $project_id;
    private $task_name;
    private $description;
    private $status;
    private $assigned_to;
    private $created_by;

    public function __construct($project_id = null) {
        parent::__construct(self::TABLE_NAME);

        $this->setProjectId($project_id);
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
        if($assigned_to == '' || $assigned_to == null || !isset($assigned_to)) {
            $this->assigned_to = null;
        } else {
            $this->assigned_to = $assigned_to;
        }
    }

    public function setCreatedBy($created_by) {
        $this->created_by = $created_by;
    }

    public function add() {
        return $this->sqlInsert([
            'project_id' => $this->project_id,
            'task' => $this->task_name,
            'description' => $this->description,
            'status' => $this->status,
            'assigned_to' => $this->assigned_to
        ]);
    }

    public function deleteById($id) {
        return $this->sqlDelete($id);
    }

    public function getProjectTasks(){
        return $this->sqlSelect()->where([
            'column_name' => 'project_id',
            'operator' => '=',
            'value' => $this->project_id
        ])->getAll();
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }
}