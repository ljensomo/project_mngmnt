<?php

class TaskType extends Database {

    const TABLE_NAME = 'task_types';
    const COLUMNS = [
        'id',
        'task_type',
        'description',
    ];

    private $id;
    private $task_type;
    private $description;

    public function __construct() {
        parent::__construct(self::TABLE_NAME, self::COLUMNS);

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTaskType($task_type) {
        $this->task_type = $task_type;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getTaskTypes(){
        return $this->sqlSelect([
                self::TABLE_NAME.'.id',
                self::TABLE_NAME.'.task_type',
                self::TABLE_NAME.'.description',
            ])->getAll();
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }
}