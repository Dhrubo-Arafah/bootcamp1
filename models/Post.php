<?php
class Post{
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
    public function __construct($db){
        $this->db = $db;
    }

    //Get Posts
    public function read(){
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
        ' . $this->table. ' p
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

    public function search($id){
        // Create query
        $query = 'select * from '.  $this->table . ' where ' . $this->table . '.category_id = :id';
//var_dump($query);
        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Execute statement
        $stmt->execute([':id'=>$id]);

        // Returning Fetched Data
        return $stmt;
    }
}
