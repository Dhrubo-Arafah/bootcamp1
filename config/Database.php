<?php

class Database
{

//DB Params
    private $host = 'localhost';
    private $db_name = 'myblog';
    private $user = 'user';
    private $password = 'password';
    private $db;

//DB Connection
    public function connect()
    {
        $this->db = null;

        //dsn = Data Source Name
        $dsn = "mysql:host=$this->host;dbname=$this->db_name";
        try {
            $this->db = new PDO($dsn, $this->user, $this->password);

            //To Tell what kind of problem is happening.
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
        return $this->db;
    }

}