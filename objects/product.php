<?php

class Product
{
    private $conn;
    private $table_name = 'products';

    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $sql = 'SELECT c.name as category_name, p.id, p.name, p.description, p.price, ' .
               'p.category_id, p.created FROM ' . $this->table_name . ' p ' .
               'LEFT JOIN categories c ON p.category_id = c.id ' .
               'ORDER BY p.created DESC';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    function create()
    {
        $sql = 'INSERT INTO ' . $this->table_name .
               ' SET name = :name, ' .
                    'price = :price, ' . 
                    'description = :description, ' . 
                    'category_id = :category_id, ' . 
                    'created = :created';

        $stmt = $this->conn->prepare($sql);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->created = htmlspecialchars(strip_tags($this->created));
        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':created', $this->created);

        if ($stmt->execute()){
            return true;
        }

        return $false;
    }

    function readOne()
    {
        $sql = 'SELECT c.name as category_name, ' . 
               'p.id, p.name, p.description, p.price, ' . 
               'p.category_id, p.create ' .
               'FROM ' . $this->table_name . ' p ' .
               'LEFT JOIN categories c ON p.category_id = c.id ' .
               'WHERE p.id = ? LIMIT 0,1';

        $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name          = $row['name'];
        $this->description   = $row['description'];
        $this->price         = $row['price'];
        $this->category_id   = $row['category_id'];
        $this->category_name = $row['category_name'];
    }

    function update()
    {

        $sql = 'UPDATE ' . $this->table_name . ' SET ' .
               'name = :name, ' .
               'price = :price, ' .
               'description = :description, ' .
               'category_id = :category_id ' .
               'WHERE id = :id';

        $stmt = $this->conn->prepare($sql);

        $this->id          = htmlspecialchars(strip_tags($this->id));
        $this->name        = htmlspecialchars(strip_tags($this->name));
        $this->price       = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':category_id', $this->category_id);

        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function delete()
    {
        $sql = 'DELETE FROM ' . $this->table_name . ' WHERE id = ?';

        $stmt = $this->conn-prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()){
            return true;
        }

        return false;
    }

    function search($keywords)
    {
        $sql = 'SELECT c.name as category_name, p.id, p.name, p.description, ' .
               'p.price, p.category_id, p.created ' .
               'FROM ' . $this->table_name . ' p ' .
               'LEFT JOIN categories c ON p.category_id = c.id ' .
               'WHERE p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ? ' .
               'ORDER BY p.created DESC';

        $stmt = $this->conn->prepare($sql);

        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        $stmt->execute();

        return $stmt;
    }

}

?>