<?php

class ProjectModule extends Database {

    const TABLE_NAME = 'project_modules';
    const COLUMNS = [
        'id',
        'project_id',
        'module',
        'description',
        'status',
        'created_by',
        'date_created',
        'date_completed'
    ];

    private $id;
    private $project_id;
    private $module;
    private $description;
    private $status;
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

    public function setModule($module) {
        $this->module = $module;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setCreatedBy($created_by) {
        $this->created_by = $created_by;
    }

    public function add() {
        return $this->sqlInsert([
            'project_id' => $this->project_id,
            'module' => $this->module,
            'description' => $this->description,
            'status' => $this->status,
            'created_by' => $this->created_by
        ]);
    }

    public function update() {
        return $this->sqlUpdate([
            'module' => $this->module,
            'description' => $this->description,
            'status' => $this->status,
            'date_completed' => $this->status == 3 ? date('Y-m-d H:i:s') : null,
            'id' => $this->id
        ]);
    }

    public function deleteById($id) {
        return $this->sqlDelete($id);
    }

    public function getProjectModules(){
        return $this->sqlSelect([
                'CONCAT(users.first_name, " ", users.last_name) AS created_by',
            ])->join('users', 'users.id = project_modules.created_by', 'LEFT JOIN')
            ->where([
                'column_name' => 'project_id',
                'value' => $this->project_id
            ])->getAll();
    }

    public function getProjectModulesByStatus($status){
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