<?php

class TaskStatus extends Database {

    const TABLE_NAME = 'task_statuses';
    const COLUMNS = [
        'id',
        'status',
        'description',
        'status_group_id',
    ];

    private $id;
    private $status;
    private $description;
    private $status_group_id;

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

    public function setStatusGroupId($status_group_id) {
        $this->status_group_id = $status_group_id;
    }

    public function getTaskStatuses(){
        return $this->sqlSelect([
                self::TABLE_NAME.'.id',
                self::TABLE_NAME.'.status',
                self::TABLE_NAME.'.description',
                self::TABLE_NAME.'.status_group_id',
            ])->getAll();
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }
}