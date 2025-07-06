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

    public function getAll() {
        return $this->sqlFetchAll();
    }
}