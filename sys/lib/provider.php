<?php

namespace sys\lib;

require_once 'sys/config/db.php';


class Provider
{
    protected $conn;

    public function __construct()
    {
        $dbHost = DB_HOST;
        $dbName = DB_NAME;
        $connStr = "mysql:host=$dbHost;dbname=$dbName";
        
        $this->conn = new \PDO($connStr, DB_USER, DB_PASSWORD);
    }
}
