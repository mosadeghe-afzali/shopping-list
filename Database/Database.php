<?php
namespace Database;

require __DIR__ . '/./config.php'; 

use PDO;
use PDOException;

class Database
{
    private static $instance;
    private $connection;
    private $dbhost = DB_HOST; 
    private $dbname = DB_NAME; 
    private $username = DB_USERNAME; 
    private $password = DB_PASSWORD; 

    private function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host=" . $this->dbhost,
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS `$this->dbname`";
            $this->connection->exec($sql); 
            // echo "Database created successfully<br>";
        }catch(PDOException $e) {
            die('create database error: ' . $e->getMessage()); 
        }
        try {
            $this->connection = new PDO(
                "mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname,
                $this->username,
                $this->password
            );
            $this->connection->exec("set names utf8");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            die('connection error: ' . $e->getMessage()); 
        }
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Database(); 
        }

        return self::$instance->connection; 
    }
}