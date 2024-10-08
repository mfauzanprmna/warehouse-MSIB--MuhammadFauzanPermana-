<?php

class Gudang
{
    private $conn;
    private $table_name = "gudang";

    public $id = 0;
    public $name = "";
    public $location = "";
    public $capacity = 0;
    public $status = "";
    public $opening_hour = "";
    public $closing_hour = "";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT id, name, location, capacity, status, opening_hour, closing_hour FROM " . $this->table_name ."";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne($id)
    {
        $query = "SELECT id, name, location, capacity, status, opening_hour, closing_hour FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "(name, location, capacity, status, opening_hour, closing_hour) VALUES(:name, :location, :capacity, :status, :opening_hour, :closing_hour)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id)
    {
        $query = "UPDATE " . $this->table_name . " SET name=:name, location=:location, capacity=:capacity, status=:status, opening_hour=:opening_hour, closing_hour=:closing_hour WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateStatus($id){
        
            $query = "UPDATE " . $this->table_name . " SET status=:status WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $queryCount = "SELECT COUNT(*) FROM " . $this->table_name;
        $stmtCount = $this->conn->prepare($queryCount);
        $stmtCount->execute();
        $count = $stmtCount->fetchColumn();
        

        if ($count == 1) {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            $resetAutoIncrement = "ALTER TABLE " . $this->table_name . " AUTO_INCREMENT = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);

            $reset = $this->conn->prepare($resetAutoIncrement);

            if ($stmt->execute() && $reset->execute()) {
                return true;
            }
        } else {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
        }

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
