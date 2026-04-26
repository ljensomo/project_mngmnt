<div class="modal fade" id="edit-project-modal" tabindex="-1" aria-labelledby="editProjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-primary" id="editProjectLabel">
                    <i class="fas fa-edit me-2"></i>Edit Project Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="edit-project-form">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-1">Project Name</label>
                        <input type="text" class="form-control rounded-3" id="edit-project-name" name="project_name" required>
                    </div>

                    <div class="mb-3">
                        <label class="small fw-bold text-muted mb-1">Description</label>
                        <textarea class="form-control rounded-3" id="edit-project-description" name="description" rows="3"></textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label class="small fw-bold text-muted mb-1">Current Phase</label>
                            <select class="form-select rounded-3" id="edit-project-status" name="status">
                                <option value="Planning">Planning</option>
                                <option value="Development">Development</option>
                                <option value="Testing">Testing</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="small fw-bold text-muted mb-1">Deadline</label>
                            <input type="date" class="form-control rounded-3" id="edit-project-deadline" name="deadline">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Phase Modal -->
<div class="modal fade" id="milestones-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Update Phase Milestones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-update-milestones">
                    <div class="d-flex flex-column gap-3">
                        <?php
                        $phases = [
                            1 => 'Planning', 
                            2 => 'Design', 
                            3 => 'Development', 
                            4 => 'Testing', 
                            5 => 'Deployment', 
                            6 => 'Maintenance', 
                            7 => 'Closed'
                        ];
                        foreach ($phases as $id => $name):
                        ?>
                        <div class="row align-items-center">
                            <div class="col-5">
                                <label class="small fw-bold text-muted"><?= $name ?></label>
                            </div>
                            <div class="col-7">
                                <input type="date" class="form-control form-control-sm" name="milestone[<?= $id ?>]">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="form-update-milestones" class="btn btn-primary rounded-pill px-4">Save Changes</button>
            </div>
        </div>
    </div>
</div>