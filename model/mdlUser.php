<!--
Project: To be defined
Date: September 2020
By: Alberto Martínez pineda
-->
<?php

include_once ('dbcrud.php');

class mdlUser {
    /* ATTRIBUTES */
    private $id;
    private $login;
    private $psw;  
    private $email;
    private $name;
    private $lastname;
    private $dateinsert;
    private $insertby;
    private $dateupdate;
    private $updateby;
    
    
    
    /* FUNCTIONS */
    
    public function login($login, $clave){
        //$conn = new dbconn ();
        //$conn->connect();
        $crud = new dbcrud();
        
        $sql = "SELECT * FROM users WHERE USRLogin ='" . $login . "' AND USRPsw ='" . $clave . "'";
        
        $result = $crud->sql($sql);
        
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            
            //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            
            $this->setId($row['USRId']);
            $this->setLogin($row['USRLogin']);
            $this->setPsw($row['USRPsw']);
            $this->setName($row['USRName']);
            $this->setLastName($row['USRLastName']);
            $this->setEmail($row['USREmail']); 
            
            return "OK";        
        } else {
            return "KO";
        }
    }
    
    /* INSERT NEW RECORD IN DATABASE */
    public function insert(){
        
        $crud = new dbcrud();
        $sql = "INSERT INTO users (USRLogin, USRPsw, USREmail, USRName, USRLastName, USRDateInsert, USRInsertBy) "
              ."VALUES (':login', ':psw', ':email', ':name', ':lastname', ':dateinsert', ':insertby');";
        
        
        $sql = $this->raplaceData($sql);
               
        $result = $crud->sql($sql);        
        
    }
    
    /* UPDATE CURRENT RECORD */
    public function update(){
        
        $crud = new dbcrud();
        $sql = "UPDATE users SET USRLogin = ':login', USRPsw = ':psw', USREmail = ':email', USRName = ':name', USRLastName = ':lastname', "
                ."USRDateUpdate = ':dateupdate', USRUpdateBy = ':updateby' "
                ."WHERE USRId = :id;";        
        
        $sql = $this->raplaceData($sql);
               
        $result = $crud->sql($sql);
      
    }
    
    /* DELETE FROM DATABASE */  
    public function delete(){        
        $crud = new dbcrud();
        $sql = "DELETE FROM users WHERE USRId = :id;";        
        
        $sql = str_replace(':id', $this->getId(), $sql);          
               
        $result = $crud->sql($sql);
        
    }
    
    /* REPLACE DATA IN SQL STRING */
    public function raplaceData ($sql){
        
        $sql = str_replace(':id', $this->getId(), $sql);
        $sql = str_replace(':login', $this->getLogin(), $sql);
        $sql = str_replace(':psw', $this->getPsw(), $sql);
        $sql = str_replace(':email', $this->getEmail(), $sql);
        $sql = str_replace(':name', $this->getName(), $sql);
        $sql = str_replace(':lastname', $this->getLastName(), $sql);
        $sql = str_replace(':dateupdate', $this->getDateUpdate(), $sql);
        $sql = str_replace(':updateby', $this->getUpdateBy(), $sql);
        $sql = str_replace(':dateinsert', $this->getDateInsert(), $sql);        
        $sql = str_replace(':insertby', $this->getInsertBy(), $sql);
        
        return $sql;
        
    }
    
    /* FUNCTIONS GETTERS, SETTERS */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }
    
    public function getPsw() {
        return $this->psw;
    }

    public function setPsw($psw) {
        $this->psw = $psw;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    public function getLastName() {
        return $this->lastname;
    }

    public function setLastName($lastname) {
        $this->lastname = $lastname;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getDateInsert() {
        return $this->dateinsert;
    }

    public function setDateInsert($dateinsert) {
        $this->dateinsert = $dateinsert;
    }
    
    public function getInsertBy() {
        return $this->insertby;
    }

    public function setInsertBy($insertby) {
        $this->insertby = $insertby;
    }    
    
    public function getDateUpdate() {
        return $this->dateupdate;
    }

    public function setDateUpdate($dateupdate) {
        $this->dateupdate = $dateupdate;
    }
    
    public function getUpdateBy() {
        return $this->updateby;
    }

    public function setUpdateBy($updateby) {
        $this->updateby = $updateby;
    }

}
?>