<?php
require_once "./Database.php";

use app\Config\Database;

$connection = Database::getInstance();
$sql = "
            CREATE TABLE IF NOT EXISTS items (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                price DECIMAL(10, 2) NOT NULL,
                description TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ";
try {
    $connection->exec($sql);
    echo "Table 'items' created successfully.";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}