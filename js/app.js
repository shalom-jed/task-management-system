document.addEventListener('DOMContentLoaded', function() {
    const taskTableBody = document.getElementById('taskTableBody');
    const searchInput = document.getElementById('searchTask');
    const priorityFilter = document.getElementById('priorityFilter');
    const addForm = document.getElementById('addTaskForm');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const darkToggle = document.getElementById('darkModeToggle');

    let allTasks = [];

    function showLoading(show) {
        if (loadingSpinner) loadingSpinner.classList.toggle('active', show);
    }

    function showToast(msg, type) {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type === 'danger' ? 'danger' : 'success'} alert-dismissible fade show toast-message`;
        toast.innerHTML = `${msg} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    function loadTasks() {
        showLoading(true);
        fetch('actions/get-task.php')
            .then(res => res.json())
            .then(data => {
                showLoading(false);
                if (data.success) {
                    allTasks = data.tasks;
                    filterAndRender();
                } else {
                    showToast('Failed to load', 'danger');
                }
            })
            .catch(() => {
                showLoading(false);
                showToast('Network error', 'danger');
            });
    }

    function filterAndRender() {
        let filtered = [...allTasks];
        const searchTerm = searchInput?.value.trim().toLowerCase() || '';
        const priorityVal = priorityFilter?.value || 'all';
        if (searchTerm) filtered = filtered.filter(t => t.title.toLowerCase().includes(searchTerm));
        if (priorityVal !== 'all') filtered = filtered.filter(t => t.priority === priorityVal);
        renderTasks(filtered);
    }

    function renderTasks(tasks) {
        if (!taskTableBody) return;
        if (tasks.length === 0) {
            taskTableBody.innerHTML = '<tr><td colspan="6" class="text-center">No tasks found</td></tr>';
            return;
        }
        let html = '';
        tasks.forEach(task => {
            let priorityClass = task.priority === 'Low' ? 'priority-low' : (task.priority === 'Medium' ? 'priority-medium' : 'priority-high');
            let statusClass = task.status === 'Pending' ? 'status-pending' : 'status-completed';
            let newStatus = task.status === 'Pending' ? 'Completed' : 'Pending';
            let btnText = task.status === 'Pending' ? '✓ Complete' : '↺ Pending';

            html += `<tr>
                <td><strong>${escapeHtml(task.title)}</strong></td>
                <td>${escapeHtml(task.description || '—')}</td>
                <td><span class="badge-priority ${priorityClass}">${task.priority}</span></td>
                <td><span class="status-badge ${statusClass}">${task.status}</span></td>
                <td>${new Date(task.created_at).toLocaleDateString()}</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary update-status" data-id="${task.id}" data-status="${newStatus}">${btnText}</button>
                    <button class="btn btn-sm btn-outline-danger delete-task" data-id="${task.id}">🗑 Delete</button>
                </td>
            </tr>`;
        });
        taskTableBody.innerHTML = html;
        document.querySelectorAll('.update-status').forEach(btn => btn.addEventListener('click', updateStatusHandler));
        document.querySelectorAll('.delete-task').forEach(btn => btn.addEventListener('click', deleteHandler));
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    function updateStatusHandler(e) {
        const btn = e.currentTarget;
        const id = btn.dataset.id;
        const newStatus = btn.dataset.status;
        const formData = new FormData();
        formData.append('id', id);
        formData.append('status', newStatus);
        showLoading(true);
        fetch('actions/update-task.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                showLoading(false);
                if (data.success) {
                    showToast('Status updated', 'success');
                    loadTasks();
                } else {
                    showToast(data.message, 'danger');
                }
            });
    }

    function deleteHandler(e) {
        if (!confirm('Delete this task?')) return;
        const id = e.currentTarget.dataset.id;
        const formData = new FormData();
        formData.append('id', id);
        showLoading(true);
        fetch('actions/delete-task.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                showLoading(false);
                if (data.success) {
                    showToast('Task deleted', 'success');
                    loadTasks();
                } else {
                    showToast(data.message, 'danger');
                }
            });
    }

    addForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const title = document.getElementById('taskTitle').value.trim();
        if (title.length < 3) {
            showToast('Title min 3 characters', 'danger');
            return;
        }
        const formData = new FormData(addForm);
        showLoading(true);
        fetch('actions/add-task.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                showLoading(false);
                if (data.success) {
                    showToast('Task added', 'success');
                    addForm.reset();
                    loadTasks();
                } else {
                    showToast(data.message, 'danger');
                }
            });
    });

    if (searchInput) searchInput.addEventListener('input', filterAndRender);
    if (priorityFilter) priorityFilter.addEventListener('change', filterAndRender);

    // Dark mode
    if (darkToggle) {
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            darkToggle.textContent = '☀️ Light Mode';
        }
        darkToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
            darkToggle.textContent = isDark ? '☀️ Light Mode' : '🌙 Dark Mode';
        });
    }

    loadTasks();
});