<?php

class Category
{
    private $conn;
    private $table_name = 'categories';

    public $id;
    public $name;
    public $description;
    public $created;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readAll()
    {
        $sql = 'SELECT id, name, description, created ' .
               'FROM ' . $this->table_name .
               ' ORDER BY name';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        return $stmt;
    }

    public function read($id)
    {
        $sql = 'SELECT id, name, description, created ' .
               'FROM ' . $this->table_name .
               ' WHERE id = ? ';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }


}

?>