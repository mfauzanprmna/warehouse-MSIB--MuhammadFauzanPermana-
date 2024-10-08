<?php

class Item
{
    private $conn;
    private $table_name = "items";

    public $id = 0;
    public $name = "";
    public $stock = 0;
    public $type = "";
    public $id_gudang = 0;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read($id_gudang)
    {
        $query = "SELECT id, name, stock, type, create_timestamp FROM " . $this->table_name . " WHERE id_gudang = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_gudang);
        $stmt->execute();
        return $stmt;
    }

    public function readOne($id)
    {
        $query = "SELECT id, name, stock, type, create_timestamp, id_gudang FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "(name, stock, type, id_gudang) VALUES(:name, :stock, :type, :id_gudang)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":id_gudang", $this->id_gudang);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id)
    {
        $query = "UPDATE " . $this->table_name . " SET name=:name, stock=:stock, type=:type WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
