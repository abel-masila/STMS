<?php
    class Database{
        //set database credentials
        private $host="localhost";
        private $db_name="api_db";
        private $username="root";
        private $password="";
        public $conn;

        //Get database connection
        public function getConnection(){
            $this->conn=null;
            try{
                $this->conn=new PDO("mysql:host=".$this->host . ";dbname=" . $this->db_name, $this->username,$this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $e){
                echo "Connection error: " . $e->getMessage();
            }
            return $this->conn;
        }
    }
?>