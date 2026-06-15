<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Task Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

<div id="loadingSpinner" class="spinner-overlay">
    <div class="spinner-border text-light" style="width: 3rem; height: 3rem;"></div>
</div>

<div class="container py-3 py-md-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-2 mb-sm-0">
            <i class="fas fa-tasks text-primary"></i> Task Manager
        </h1>
        <button id="darkModeToggle" class="btn btn-outline-secondary">
            🌙 Dark Mode
        </button>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <i class="fas fa-plus-circle"></i> Add New Task
        </div>
        <div class="card-body">
            <form id="addTaskForm">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="taskTitle" class="form-label">Task Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="taskTitle" class="form-control" placeholder="Enter title (min 3 characters)" required>
                    </div>
                    <div class="col-md-3">
                        <label for="taskPriority" class="form-label">Priority</label>
                        <select name="priority" id="taskPriority" class="form-select">
                            <option value="Low">Low</option>
                            <option value="Medium" selected>Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="taskDescription" class="form-label">Description (optional)</label>
                        <input type="text" name="description" id="taskDescription" class="form-control" placeholder="e.g., deadline tomorrow">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save"></i> Save Task
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-2 mb-3 align-items-end">
        <div class="col-md-5">
            <label class="form-label fw-semibold">🔍 Search by title</label>
            <input type="text" id="searchTask" class="form-control" placeholder="Type to filter...">
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">📊 Filter by priority</label>
            <select id="priorityFilter" class="form-select">
                <option value="all">All Priorities</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>
        <div class="col-md-3 text-md-end">
            <button class="btn btn-secondary w-100 mt-2 mt-md-0" onclick="location.reload()">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>

    <div class="card shadow-sm table-container">
        <div class="card-header bg-white">
            <i class="fas fa-list-check"></i> Your Tasks (latest first)
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="taskTableBody">
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="spinner-border text-primary" role="status"></div>
                                <span class="ms-2">Loading tasks...</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="text-center text-muted mt-4">
        <small>Mini Task Management System – PHP + MySQL | Intern Test</small>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>
