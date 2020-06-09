<?php
namespace app\Model;

class Database
{

    private $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect('db', 'vitor', '123', "db01");
        if ($this->conn->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error;
        }
    }
    public function close()
    {
        $this->conn->close();
    }
    public function getMysqlInstance()
    {
        return $this->conn;
    }
    public static function getInstance()
    {
        static $db=null;
        if (!$db) {
            $db = new Database();
        }

        return $db;
    }
}
