<?php

class Project extends Database {

    const TABLE_NAME = 'projects';

    private $id;
    private $name;
    private $description;
    private $status;
    private $created_by;

    public function __construct() {
        parent::__construct(self::TABLE_NAME);
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
                'created_by' => $this->created_by,
                'id' => $this->id
            ],
        );
    }

    public function deleteById($id) {
        return $this->sqlDelete($id);
    }

    public function getAll() {
        return $this->sqlFetchAll();
    }

    public function getById($id) {
        return $this->sqlSelect([
                'projects.id',
                'projects.project_name',
                'projects.description',
                'projects.status',
                'projects.created_by',
                'projects.date_created',
                'CONCAT(users.first_name, " ", users.last_name) AS created_by_name'
               
            ])->join('users', 'users.id = projects.created_by', 'LEFT JOIN')
            ->where([
                'column_name' => 'projects.id',
                'operator' => '=',
                'value' => $id
            ])->get();
    }
}