<?php 
class Role{
    //set db connection and table name
    private $conn;
    private $table_name="roles";

    // object properties
    public $role_id;
    public $role_name;

     // constructor with $db as database connection
     public function __construct($db){
        $this->conn=$db;
    }

    //used for roles dropdownlist
    public function readAll(){
        //select all data
        $query="SELECT * FROM ". $this->table_name." ORDER BY role_name";
        $stmt=$this->conn->prepare($query);
        //execute query
        $stmt->execute();
        return $stmt;
    }
}