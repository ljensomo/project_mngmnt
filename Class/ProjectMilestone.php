<?php

class ProjectMilestone extends Database {

    const TABLE_NAME = 'project_milestones';
    const COLUMNS = [
        'id',
        'project_id',
        'phase_id',
        'due_date',
        'is_completed'
    ];

    private $id;
    private $phase_id;
    private $project_id;
    private $due_date;
    private $is_completed;
    private $select_columns = array();

    public function __construct() {
        parent::__construct(self::TABLE_NAME, self::COLUMNS);

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setProjectId($project_id) {
        $this->project_id = $project_id;
    }

    public function setDueDate($due_date) {
        $this->due_date = $due_date;
    }

    public function setIsCompleted($is_completed) {
        $this->is_completed = $is_completed;
    }

    public function setPhaseId($phase_id) {
        $this->phase_id = $phase_id;
    }

    public function add() {
        return $this->sqlInsert([
            'phase_id' => $this->phase_id,
            'project_id' => $this->project_id,
            'due_date' => $this->due_date,
            'is_completed' => $this->is_completed
        ]);
    }

    public function update() {
        return $this->sqlUpdate(
            [
                'phase_id' => $this->phase_id,
                'project_id' => $this->project_id,
                'due_date' => $this->due_date,
                'is_completed' => $this->is_completed,
                'id' => $this->id
            ],
        );
    }

    public function generateMilestones(){
        $phases = [
            1 => 'Planning', 
            2 => 'Design', 
            3 => 'Development', 
            4 => 'Testing', 
            5 => 'Deployment', 
            6 => 'Maintenance', 
            7 => 'Closed'
        ];
        foreach($phases as $id => $name){
            $milestone = new ProjectMilestone();
            $milestone->setProjectId($this->project_id);
            $milestone->setPhaseId($id);
            $milestone->setDueDate(null); // Set default or calculate based on project timeline
            $milestone->setIsCompleted(0); // Default to not completed
            $milestone->add();
        }
    }

}