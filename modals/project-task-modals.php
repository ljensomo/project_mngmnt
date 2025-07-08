<!-- Modal -->
<div class="modal fade" id="task-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="task-form">
                <input type="hidden" name="project-id" id="project-id2">
                <div class="modal-body">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="task" placeholder="Task Name" aria-label="Project Name" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="description" placeholder="Description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <select name="assign-to" id="assign-to" class="form-control">
                            <option value="">-- Assign To</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="task-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="task-edit-form">
                <input type="hidden" name="project-id" id="project-id3">
                <input type="hidden" name="task-id" id="task-id">
                <div class="modal-body">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="task" placeholder="Task Name" id="task" aria-label="Project Name" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="description" placeholder="Description" id="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <select name="assign-to" id="assign-to2" class="form-control">
                            <option value="">-- Assign To</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="status" id="status" class="form-control" required>
                            <option value="1">Open</option>
                            <option value="2">In Progress</option>
                            <option value="3">Completed</option>
                            <option value="4">On Hold</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>