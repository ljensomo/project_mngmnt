<?php

class ProjectStatus extends Database {

    const TABLE_NAME = 'sdlc_phases';
    const COLUMNS = [
        'id',
        'phase',
        'description',
    ];

    private $id;
    private $phase;
    private $description;

    public function __construct() {
        parent::__construct(self::TABLE_NAME, self::COLUMNS);

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPhase($phase) {
        $this->phase = $phase;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function add() {
        return $this->sqlInsert([
            'phase' => $this->phase,
            'description' => $this->description,
        ]);
    }

    public function deleteById($id) {
        return $this->sqlDelete($id);
    }

    public function update() {
        return $this->sqlUpdate([
            'phase' => $this->phase,
            'description' => $this->description,
            'id' => $this->id
        ]);
    }

    public function getProjectStatuses(){
        return $this->sqlSelect([
                self::TABLE_NAME.'.id',
                self::TABLE_NAME.'.phase',
                self::TABLE_NAME.'.description',
            ])->getAll();
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }
}