<?php
namespace App\Models;
require_once __DIR__ . "/../../Database/Database.php";
use Database\Database;

class Model
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Database::getInstance();
    }
}