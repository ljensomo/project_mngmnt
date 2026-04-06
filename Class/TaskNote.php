<?php

class TaskNote extends Database {

    const TABLE_NAME = 'task_notes';
    const COLUMNS = [
        'id',
        'task_id',
        'note',
        'created_by',
        'date_created',
    ];

    private $id;
    private $task_id;
    private $note;
    private $created_by;
    private $date_created;

    public function __construct() {
        parent::__construct(self::TABLE_NAME, self::COLUMNS);

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTaskId($task_id) {
        $this->task_id = $task_id;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function setCreatedBy($created_by) {
        $this->created_by = $created_by;
    }

    public function setDateCreated($date_created) {
        $this->date_created = $date_created;
    }

    public function getTaskNotes(){
        return $this->sqlSelect([
                self::TABLE_NAME.'.id',
                self::TABLE_NAME.'.task_id',
                self::TABLE_NAME.'.note',
                self::TABLE_NAME.'.created_by',
                self::TABLE_NAME.'.date_created',
            ])->getAll();
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }

    public function add() {
        return $this->sqlInsert([
            'task_id' => $this->task_id,
            'note' => $this->note,
            'created_by' => $this->created_by,
        ]);
    }
}