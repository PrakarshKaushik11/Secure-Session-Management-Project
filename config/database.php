<?php
declare(strict_types=1);

const DB_HOST = '127.0.0.1';  // Not used for SQLite, kept for compatibility
const DB_NAME = 'secure_session_lab';
const DB_USER = 'root';
const DB_PASS = '';  // Not used for SQLite

/**
 * Returns a PDO connection to the SQLite database.
 * SQLite is used for simplicity - no MySQL required.
 * The database file is located in the project's data folder.
 */
function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dbPath = __DIR__ . '/../data/users.db';
    
    $pdo = new PDO('sqlite:' . $dbPath, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}