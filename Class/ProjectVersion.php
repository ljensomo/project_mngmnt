<?php

class ProjectVersion extends Database {

    const TABLE_NAME = 'project_versions';
    const COLUMNS = [
        'id',
        'project_id',
        'version_number',
        'remarks',
        'status',
        'release_date',
        'date_created'
    ];

    private $id;
    private $project_id;
    private $version_number;
    private $remarks;
    private $status;
    private $release_date;

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

    public function setVersionNumber($version_number) {
        $this->version_number = $version_number;
    }

    public function setRemarks($remarks) {
        $this->remarks = $remarks;
    }

    public function setReleaseDate($release_date) {
        $this->release_date = $release_date;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function add() {
        return $this->sqlInsert([
            'project_id' => $this->project_id,
            'version_number' => $this->version_number,
            'remarks' => $this->remarks,
            'release_date' => $this->release_date,
            'status' => $this->status
        ]);
    }

    public function update() {
        return $this->sqlUpdate([
            'version_number' => $this->version_number,
            'remarks' => $this->remarks,
            'release_date' => $this->release_date,
            'status' => $this->status,
            'id' => $this->id
        ]);
    }

    public function deleteById($id) {
        return $this->sqlDelete($id);
    }

    public function getProjectVersions(){
        return $this->sqlSelect([
                self::TABLE_NAME.'.id',
                self::TABLE_NAME.'.version_number',
                self::TABLE_NAME.'.remarks',
                self::TABLE_NAME.'.status',
                self::TABLE_NAME.'.release_date',
                self::TABLE_NAME.'.date_created'
            ])->where([
                'column_name' => 'project_id',
                'operator' => '=',
                'value' => $this->project_id
            ])->getAll();
    }

    public function deactivateOtherVersions() {
        return $this->sqlUpdate([
            'status' => 4,
        ],[
            'where' => [
                'column_name' => 'project_id',
                'operator' => '=',
                'value' => $this->project_id
            ],
            'and' => [
                'column_name' => 'status',
                'operator' => '=',
                'value' => 3
            ]
        ]);
    }

    public function getById($id) {
        return $this->sqlFetchById($id);
    }
}