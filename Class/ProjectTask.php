<?php

class ProjectTask extends Database {

    const TABLE_NAME = 'project_tasks';
    const COLUMNS = [
        'id',
        'project_id',
        'task_type',
        'task',
        'description',
        'status',
        'assigned_to',
        'created_by',
        'date_created',
        'date_completed'
    ];

    private $id;
    private $project_id;
    private $type;
    private $task_name;
    private $description;
    private $status;
    private $assigned_to;
    private $created_by;

    public function __construct($project_id = null) {
        parent::__construct(self::TABLE_NAME, self::COLUMNS);

        $this->setProjectId($project_id);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setProjectId($project_id) {
        $this->project_id = $project_id;
    }

    public function setType($type) {
        $this->type = $type;
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
            'task_type' => $this->type,
            'task' => $this->task_name,
            'description' => $this->description,
            'status' => $this->status,
            'assigned_to' => $this->assigned_to
        ]);
    }

    public function update() {
        return $this->sqlUpdate([
            'task_type' => $this->type,
            'task' => $this->task_name,
            'description' => $this->description,
            'status' => $this->status,
            'assigned_to' => $this->assigned_to,
            'date_completed' => $this->status == 3 ? date('Y-m-d H:i:s') : null,
            'id' => $this->id
        ]);
    }

    public function deleteById($id) {
        return $this->sqlDelete($id);
    }

    public function getProjectTasks(){
        return $this->sqlSelect([
                'project_tasks.id',
                'project_tasks.task_type',
                'project_tasks.task',
                'project_tasks.description',
                'project_tasks.status',
                'project_tasks.assigned_to',
                'project_tasks.date_created',
                'project_tasks.date_completed',
                'users.first_name',
                'users.last_name'
            ])->join('users', 'users.id = project_tasks.assigned_to', 'LEFT JOIN')
            ->where([
                'column_name' => 'project_id',
                'operator' => '=',
                'value' => $this->project_id
            ])->getAll();
    }

    public function getProjectTasksByStatus($status){
        return $this->sqlSelect()
            ->where([
                'column_name' => 'status',
                'value' => $status
            ])
            ->where([
                'column_name' => 'project_id',
                'value' => $this->project_id
            ])->getRowCount();
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }
}