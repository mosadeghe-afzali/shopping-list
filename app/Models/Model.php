<?php
namespace App\Models;
require_once __DIR__ . "/../Config/Database.php";
use App\Config\Database;

class Model
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Database::getInstance();
    }
}