<?php

class PhaseRequirement extends Database {

    const TABLE_NAME = 'phase_requirements';
    const COLUMNS = [
        'id',
        'phase_id',
        'task_type_id',
        'is_mandatory',
        'sort_order',
        'title_template',
    ];

    private $id;
    private $phase_id;
    private $task_type_id;
    private $is_mandatory;
    private $sort_order;
    private $title_template;
    private $select_columns = array();

    public function __construct() {
        parent::__construct(self::TABLE_NAME, self::COLUMNS);

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTaskTypeId($task_type_id) {
        $this->task_type_id = $task_type_id;
    }

    public function setIsMandatory($is_mandatory) {
        $this->is_mandatory = $is_mandatory;
    }

    public function setSortOrder($sort_order) {
        $this->sort_order = $sort_order;
    }

    public function setTitleTemplate($title_template) {
        $this->title_template = $title_template;
    }

    public function setPhaseId($phase_id) {
        $this->phase_id = $phase_id;
    }

    public function add() {
        return $this->sqlInsert([
            'phase_id' => $this->phase_id,
            'task_type_id' => $this->task_type_id,
            'is_mandatory' => $this->is_mandatory,
            'sort_order' => $this->sort_order,
            'title_template' => $this->title_template
        ]);
    }

    public function update() {
        return $this->sqlUpdate(
            [
                'phase_id' => $this->phase_id,
                'task_type_id' => $this->task_type_id,
                'is_mandatory' => $this->is_mandatory,
                'sort_order' => $this->sort_order,
                'title_template' => $this->title_template,
                'id' => $this->id
            ],
        );
    }

    public function deleteById($id) {
        return $this->sqlDelete($id);
    }

    /**
     * Generates tasks for a project based on phase requirements.
     * * @param int $projectId The project ID to generate tasks for.
     * @param int $phaseId The phase ID to process.
     * @return bool
     */
    public function generateTasksForPhase($projectId) {
        $requirements = $this->getRequirementsByPhase($this->phase_id);

        if (empty($requirements)) {
            return false;
        }

        foreach ($requirements as $req) {
            // Clean the title_template by removing the placeholder
            $cleanTitle = str_replace('{project_name}', '', $req['title_template']);
            $cleanTitle = trim($cleanTitle); // Optional: clean up extra whitespace

            $task = new ProjectTask();
            $task->setProjectId($projectId);
            $task->setPhaseId($this->phase_id);
            $task->setCreatedBy(0); // System user or admin ID
            $task->setType($req['task_type_id']);
            $task->setTaskName($cleanTitle);
            $task->setDescription($req['description']); // Optionally, you can have a description template as well
            $task->setStatus(1); // Default status (e.g., 'Open')
            $task->add();
        }

        return true;
    }

    public function getRequirementsByPhase($phaseId) {
        // Assuming your sqlSelect can handle a basic WHERE clause
        return $this->sqlSelect([
                'phase_requirements.task_type_id',
                'phase_requirements.is_mandatory',
                'phase_requirements.title_template',
                'phase_requirements.description'
            ])
            ->where([
                'column_name' => 'phase_requirements.phase_id',
                'value' => $phaseId,
                'operator' => '='
            ])
            ->getAll();
    }
}