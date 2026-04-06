<?php

class TaskHistory extends Database {

    const TABLE_NAME = 'task_histories';
    const COLUMNS = [
        'id',
        'task_id',
        'title',
        'description',
        'history_type',
        'created_by',
    ];

    private $id;
    private $task_id;
    private $title;
    private $description;
    private $type;
    private $created_by;

    public function __construct($task_id = null) {
        parent::__construct(self::TABLE_NAME, self::COLUMNS);
        if ($task_id !== null) {
            $this->setTaskId($task_id);
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTaskId($task_id) {
        $this->task_id = $task_id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setCreatedBy($created_by) {
        $this->created_by = $created_by;
    }

    public function getTaskHistory($last_id = 0) {
        return $this->sqlSelect([
                self::TABLE_NAME.'.id',
                self::TABLE_NAME.'.task_id',
                self::TABLE_NAME.'.title',
                self::TABLE_NAME.'.description',
                self::TABLE_NAME.'.history_type',
                self::TABLE_NAME.'.created_by',
                self::TABLE_NAME.'.date_created',
                'users.first_name',
                'users.last_name'
            ])
            ->join('users', 'users.id = created_by', 'INNER JOIN')
            ->where([
                'column_name' => 'task_id',
                'operator' => '=',
                'value' => $this->task_id
            ])
            ->andWhere([
                'column_name' => self::TABLE_NAME.'.id',
                'operator' => '>',
                'value' => $last_id
            ])
            ->orderBy('date_created', 'ASC')
            ->getAll();
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }

    public function add() {

        $this->buildTitle();

        return $this->sqlInsert([
            'task_id' => $this->task_id,
            'title' => $this->title,
            'description' => $this->description,
            'history_type' => $this->type,
            'created_by' => $this->created_by,
        ]);
    }

    public function buildTitle() {
        switch ($this->type) {
            case 1:
                $this->title = 'added a note.';
                break;
            case 2:
                $this->title = 'updated details.';
                break;
            case 3:
                $this->title = 'Task Assigned';
                break;
            default:
                $this->title = 'History Entry';
                break;
        }
    }
}