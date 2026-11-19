-- SQLite schema for secure-session-management
-- Run setup.php to initialize the database automatically

CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Demo account is created by setup.php using PHP's password_hash()
-- Credentials: student / LabPass@123