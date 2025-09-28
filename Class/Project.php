<?php

class Project extends Database {

    const TABLE_NAME = 'projects';
    const COLUMNS = [
        'id',
        'project_name',
        'description',
        'status',
        'phase_id',
        'created_by',
        'date_created',
        'date_completed'
    ];

    private $id;
    private $name;
    private $description;
    private $status;
    private $phase_id;
    private $created_by;
    private $select_columns = array();

    public function __construct() {
        parent::__construct(self::TABLE_NAME, self::COLUMNS);

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setPhaseId($phase_id) {
        $this->phase_id = $phase_id;
    }

    public function setCreatedBy($created_by) {
        $this->created_by = $created_by;
    }

    public function add() {
        return $this->sqlInsert([
            'project_name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'created_by' => $this->created_by
        ]);
    }

    public function update() {
        return $this->sqlUpdate(
            [
                'project_name' => $this->name,
                'description' => $this->description,
                'status' => $this->status,
                'phase_id' => $this->phase_id,
                'created_by' => $this->created_by,
                'date_completed' => $this->status == 3 ? date('Y-m-d H:i:s') : null,
                'id' => $this->id
            ],
        );
    }

    public function deleteById($id) {
        return $this->sqlDelete($id);
    }

    public function getProjects() {
        return $this->sqlSelect([
                'CONCAT(users.first_name, " ", users.last_name) AS created_by_name',
                'sdlc_phases.phase'
            ])->join('users', 'users.id = projects.created_by', 'INNER JOIN')
            ->join('sdlc_phases', 'sdlc_phases.id = projects.phase_id', 'INNER JOIN')
            ->getAll();
    }

    public function getById($id) {
        return $this->sqlSelect([
                'CONCAT(users.first_name, " ", users.last_name) AS created_by_name'
            ])->join('users', 'users.id = projects.created_by', 'LEFT JOIN')
            ->where([
                'column_name' => 'projects.id',
                'operator' => '=',
                'value' => $id
            ])->get();
    }
}