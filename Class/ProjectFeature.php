<?php

class ProjectFeature extends Database {

    const TABLE_NAME = 'project_features';
    const COLUMNS = [
        'id',
        'project_id',
        'module_id',
        'feature',
        'description',
        'status',
        'created_by',
        'date_created',
        'date_completed'
    ];

    private $id;
    private $project_id;
    private $feature;
    private $module_id;
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

    public function setModuleId($module_id) {
        $this->module_id = $module_id;
    }

    public function setFeature($feature) {
        $this->feature = $feature;
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
            'module_id' => $this->module_id,
            'feature' => $this->feature,
            'description' => $this->description,
            'status' => $this->status,
            'created_by' => $this->created_by
        ]);
    }

    public function update() {
        return $this->sqlUpdate([
            'feature' => $this->feature,
            'description' => $this->description,
            'status' => $this->status,
            'date_completed' => $this->status == 3 ? date('Y-m-d H:i:s') : null,
            'id' => $this->id
        ]);
    }

    public function deleteById($id) {
        return $this->sqlDelete($id);
    }

    public function getProjectFeatures(){
        return $this->sqlSelect([
                'CONCAT(users.first_name, " ", users.last_name) AS created_by',
                'project_modules.module AS module_name'
            ])->join('users', 'users.id = project_features.created_by', 'LEFT JOIN')
            ->join('project_modules', 'project_modules.id = project_features.module_id', 'INNER JOIN')
            ->where([
                'column_name' => 'project_features.project_id',
                'value' => $this->project_id
            ])->getAll();
    }

    public function getProjectFeaturesByStatus($status){
        return $this->sqlSelect()
            ->where([
                'column_name' => 'status',
                'value' => $status
            ])
            ->where([
                'column_name' => 'project_id',
                'value' => $this->project_id
            ])
            ->getRowCount();
    }   

    public function getById($id) {
        return $this->sqlFetchById($id);
    }
}