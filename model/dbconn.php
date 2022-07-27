<?php

include_once ('dbconfig.php');

    class dbconn {
        //Properties
        private $conn;
        private $server;
        private $user;
        private $psw;
        private $db;
        
        // Methods
        //Connection to Database
        public function connect(){
            
            $this->server = DB_SERVER;
            $this->user = DB_USERNAME;
            $this->psw = DB_PASSWORD;
            $this->db = DB_DATABASE;
            
            // Create connection
            $this->conn = new mysqli($this->server, $this->user, $this->psw, $this->db);
            // Check connection
            if ($this->conn->connect_error) {
              die("Connection failed: " . $this->conn->connect_error);
            }
            
           // echo "Connected successfully";  
            //$this->conn->close();
        }
        
        public function closeconn(){
            
            $this->conn->close();
        }
        
        // Gets, Sets
        public function setConn($conn) {
          $this->conn = $conn;
        }
        public function getConn() {
          return $this->conn;
        }
        
        public function setServer($server) {
          $this->server = $server;
        }
        public function getServer() {
          return $this->server;
        }
        
        public function setUser($user) {
          $this->user = $user;
        }
        public function getUser() {
          return $this->user;
        }
        
        public function setPsw($psw) {
          $this->psw = $psw;
        }
        public function getPsw() {
          return $this->psw;
        }
        
        public function setDb($db) {
          $this->db = $db;
        }
        public function getDb() {
          return $this->db;
        }
        
        
    }



?>

