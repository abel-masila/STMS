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
        public $created;

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
        //register users
        function register(){
            //Query to insert into db
            $query="INSERT INTO " . $this->table_name. " SET u_name=:u_name,
             u_email=:u_email,u_password=:u_password,u_role=:u_role,created=:created";
             //prepare Query
             $stmt=$this->conn->prepare($query);

             //Sanitize data
             $this->u_name=htmlspecialchars(strip_tags($this->u_name));
             $this->u_email=htmlspecialchars(strip_tags($this->u_email));
             $this->u_password=htmlspecialchars(strip_tags($this->u_password));
             $this->u_role=htmlspecialchars(strip_tags($this->u_role));
             $this->created=htmlspecialchars(strip_tags($this->created));

             //Bind values
             $stmt->bindParam(":u_name",$this->u_name);
             $stmt->bindParam(":u_email",$this->u_email);
             $stmt->bindParam(":u_password",$this->md5($u_password));
             $stmt->bindParam(":u_role",$this->u_role);
             $stmt->bindParam(":created",$this->created);

             //execute query
             if($stmt->execute()){
                 return true;
             }
             return false;
        }
    }
?>