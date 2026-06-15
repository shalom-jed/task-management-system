CREATE DATABASE IF NOT EXISTS intern_task_system;
USE intern_task_system;

CREATE TABLE tasks (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    priority ENUM('Low', 'Medium', 'High') DEFAULT 'Medium',
    status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Demo data
INSERT INTO tasks (title, description, priority, status) VALUES
('Finish report', 'Write final internship report', 'High', 'Pending'),
('Review PRs', 'Check team pull requests', 'Medium', 'Completed'),
('Update README', 'Add setup steps', 'Low', 'Pending');