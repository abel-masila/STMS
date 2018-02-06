<?php
    class User{
        //set db connection and table name
        private $conn;
        private $table_name="users";

        // object properties
        public $user_id;
        public $u_name;
        public $u_email;
        public $u_password;
        public $u_role;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn=$db;
        }
        //read users
        public function read(){
            //select all users query
            $query="SELECT * FROM " . $this->table_name. "";
            //Prepare Query statement
            $stmt=$this->conn->prepare($query);
            //execute query
            $stmt->execute();
            return $stmt;
        }
    }
?>