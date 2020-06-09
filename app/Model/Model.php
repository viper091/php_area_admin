<?php

namespace app\Model;

use app\Model\Database;

class Model
{

    public $id = 0;
    private $data;
    public $table_name;
    public $columns;
    private $where = [];
    protected $mysqli;
    public function __construct()
    {
        $this->mysqli = Database::getInstance()
                    ->getMysqlInstance();
    }
    public function findById($id)
    {
        $c = implode(',', $this->columns);
        // print("SELECT $c FROM $this->table_name WHERE id = $id");
        $res = $this->mysqli->query("SELECT $c FROM $this->table_name WHERE id = $id");
        $res->data_seek(0);

        if ($res->num_rows >0) {
            $row = $res->fetch_assoc();
            $this->id = $id;
            foreach ($row as $key => $value) {
                # code...
                // print("<br> $key $value <br>");
                $this->$key = $value;
            }
        }
        return $this;
    }
    public function first()
    {
        $c = implode(',', $this->columns);
        $whereString = "";
        foreach ($this->where as $key => $value) {
            $whereString .= "$value[0] $value[1] '$value[2]'";

            if ($key +1 < count($this->where)) {
                $whereString .= " and ";
            }
        }
        if ($whereString) {
            $res = $this->mysqli->query("SELECT id, $c FROM $this->table_name WHERE $whereString");
            if (!$res) {
                print("error ". $this->mysqli->error);
            }
            // print("<br>$res");
        } else {
            $this->id = $id;
            $res = $this->mysqli->query("SELECT $c FROM $this->table_name WHERE id = '$id'");
        }
        if ($res->num_rows >0) {
            $res->data_seek(0);
            
            $row = $res->fetch_assoc();
            foreach ($row as $key => $value) {
                # code...
                // print("<br> $key $value <br>");
                $this->$key = $value;
            }
            return $this;
        }
        return false;
    }
    
    public static function get($where = [])
    {
        $whereString= "";
        foreach ($where as $key => $value) {
            $whereString .= "$value[0] $value[1] '$value[2]'";

            if ($key +1 < count($where)) {
                $whereString .= " and ";
            }
        }
        


        $base_name = get_called_class();
        $base = new $base_name();
        // print("SELECT $c FROM $this->table_name WHERE id = $id");
        $table_name= $base->table_name;
        $columns= $base->columns;
        $mysqli = Database::getInstance()
        ->getMysqlInstance();
        $cString = implode(',', $columns);
        if (count($where)) {
            $res = $mysqli->query("SELECT id,$cString FROM $table_name WHERE $whereString order by id desc");
            if (!$res) {
                print("error ". $mysqli->error);
            }
        } else {
            $res = $mysqli->query("SELECT id,$cString FROM $table_name  order by id desc");
        }
        $data = [];
        $res->data_seek(0);
        while ($row = $res->fetch_assoc()) {
            $c = new $base_name();
            foreach ($row as $key => $value) {
                $c->$key = $value;
            }
           
            array_push($data, $c);
        }

        return $data;
    }
    public function save()
    {
 
        $v = [];
        $c = [];
        $s = [];
        $s2 = [];
        foreach ($this->columns as $key => $value) {
            # code...
            $columnName = $value;
            $columnValue = $this->$columnName;

            if ($columnValue) {
                array_push($c, $columnName);
                array_push($v, $columnValue);
                array_push($s, "?");

                array_push($s2, "$columnName=?");
            }
        }
        $cString = implode(',', $c);
        $vString = implode(',', $v);
        $sString = implode(',', $s);
        if (!$this->id) {
            // print("INSERT INTO $this->table_name($cString) VALUES($sString)");
            
            if (!($stmt = $this->mysqli->prepare("INSERT INTO $this->table_name($cString) VALUES ($sString)"))) {
                echo "Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
                return;
            }
            $type = "";
            foreach ($c as $key => $value) {
                # code...
                // print($this->$value );
                $type .= gettype($this->$value){0};
            }
            if (!$stmt->bind_param($type, ...$v)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            // print("<br>");
        
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $this->id = $stmt->insert_id;
        } else {
            $sString = implode(',', $s2);

            if (!($stmt = $this->mysqli->prepare("UPDATE $this->table_name SET $sString WHERE id = $this->id"))) {
                echo "Prepare failed: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
                return;
            }
            $type = "";
            foreach ($c as $key => $value) {
                # code...
                $type .= gettype($this->$value){0};
            }
            if (!$stmt->bind_param($type, ...$v)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
        
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            // $this->id = $stmt->insert_id;
            $stmt->close();
        }
    }
    public static function delete($where = [])
    {
        if (!count($where)) {
            return false;
        }

        $base_name = get_called_class();
        $base = new $base_name();
        // print("SELECT $c FROM $this->table_name WHERE id = $id");
        $table_name= $base->table_name;
        $columns= $base->columns;
        $mysqli = Database::getInstance()->getMysqlInstance();


        $whereString= "";
        foreach ($where as $key => $value) {
            $whereString .= "$value[0] $value[1] '$value[2]'";

            if ($key +1 < count($where)) {
                $whereString .= " and ";
            }
        }
        $mysqli->query("DELETE from $table_name WHERE $whereString");
    }

    public function where($param, $type, $val)
    {
        array_push($this->where, [
            $param,
            $type,
            $val
        ]);
        return $this;
    }

    public function __toString()
    {
        $data = [];
        foreach ($this->columns as $key => $value) {
            # code...
            $columnName = $value;
            $columnValue = $this->$columnName;
            $data[$columnName] =$columnValue;
        }
        return implode(",", $data);
    }
    
    public function toJson()
    {
        $data = [];
        foreach ($this->columns as $key => $value) {
            # code...
            $columnName = $value;
            $columnValue = $this->$columnName;
            $data[$columnName] =$columnValue;
        }

        return json_encode($data);
    }

    public function __sleep()
    {
        return $this->columns;
    }
}
