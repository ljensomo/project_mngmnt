<?php

class ProjectTech extends Database {

    const TABLE_NAME = 'project_techs';
    const COLUMNS = [
        'id',
        'technology',
        'date_created'
    ];

    private $id;
    private $project_id;
    private $technology;
    private $description;
    private $type;

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

    public function setTechnology($technology) {
        $this->technology = $technology;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function add() {
        return $this->sqlInsert([
            'project_id' => $this->project_id,
            'technology' => $this->technology,
            'description' => $this->description,
            'type' => $this->type
        ]);
    }

    public function update() {
        return $this->sqlUpdate([
            'technology' => $this->technology,
            'description' => $this->description,
            'type' => $this->type,
            'id' => $this->id
        ]);
    }

    public function deleteById($id) {
        return $this->sqlDelete($id);
    }

    public function getProjectTechs(){
        return $this->sqlSelect([
                'project_techs.id',
                'project_techs.technology',
                'project_techs.description',
                'project_techs.type',
                'project_techs.date_created'
            ])->where([
                'column_name' => 'project_id',
                'operator' => '=',
                'value' => $this->project_id
            ])->getAll();
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }
}