<?php

class Post
{
    private $db;
    private $table = 'posts';

    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    //constructor to load DB
    public function __construct($db)
    {
        $this->db = $db;
    }

    //Get Posts
    public function read()
    {
        // Create query
        $query = 'SELECT 
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
        FROM
        ' . $this->table . ' p
        LEFT JOIN
        categories c ON p.category_id = c.id
        ORDER BY
        p.created_at DESC';

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Execute statement
        $stmt->execute();

        // Returning Fetched Data
        return $stmt;
    }

    public function search($id)
    {
        // Create query
        $query = 'select * from ' . $this->table . ' where ' . $this->table . '.category_id = :id';
//var_dump($query);
        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Execute statement
        $stmt->execute([':id' => $id]);

        // Returning Fetched Data
        return $stmt;
    }

    //Create Post
    public function create()
    {
        //Create Query
        $query = 'INSERT INTO ' . $this->table . ' 
        SET
        title = :title,
        body = :body,
        author = :author,
        category_id = :category_id
        ';

        //Prepare statement
        $stmt = $this->db->prepare($query);

        //Clean Data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->execute();
        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
}
