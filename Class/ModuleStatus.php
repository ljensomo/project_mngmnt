<?php

class ModuleStatus extends Database {

    const TABLE_NAME = 'module_statuses';
    const COLUMNS = [
        'id',
        'status',
        'description',
    ];

    private $id;
    private $status;
    private $description;

    public function __construct() {
        parent::__construct(self::TABLE_NAME, self::COLUMNS);

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getTaskStatuses(){
        return $this->sqlSelect([
                self::TABLE_NAME.'.id',
                self::TABLE_NAME.'.status',
                self::TABLE_NAME.'.description',
            ])->getAll();
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }
}