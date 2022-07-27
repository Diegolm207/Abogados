<!--
Project: To be defined
Date: September 2020
By: Alberto Martínez pineda
-->
<?php

include_once ('dbcrud.php');

class mdlEmployee {
    
    /* ATTRIBUTES */
    private $id;
    private $natid;
    private $usrid; 
    private $type;
    private $name;
    private $lastname;
    private $email;  
    private $phone;
    private $mobile;    
    private $ratehour;
    private $rateday;
    private $notes;
    private $dateinsert;
    private $insertby;
    private $dateupdate;
    private $updateby;
    
        
    /* FUNCTIONS */
    
   
    /* INSERT NEW RECORD IN DATABASE */
    public function insert(){
        
        $crud = new dbcrud();
        $sql = "INSERT INTO employees (EMPNatId, EMPUsrId, EMPType, EMPName, EMPLastName, EMPEmail, EMPPhone, "
             . "EMPMobile, EMPRateHour, EMPRateDay, EMPNotes, EMPDateInsert, EMPInsertBy) "
             . "VALUES (':natid', :usrid, ':type', ':name', ':lastname', ':email', ':phone', "
             . "':mobile', :ratehour, :rateday, ':notes', ':dateinsert', ':insertby');";        
        
        $sql = $this->replaceData($sql); 
                
               
        $result = $crud->sql($sql); 
        
    }
    
    /* UPDATE CURRENT RECORD */
    public function update(){
        
        $crud = new dbcrud();
        $sql = "UPDATE employees SET EMPUsrId = :usrid, EMPNatId = ':natid', EMPType = ':type', EMPName = ':name', EMPLastName = ':lastname', "
                . "EMPEmail = ':email', EMPPhone = ':phone', EMPMobile = ':mobile', EMPRateHour= :ratehour, EMPRateDay = :rateday, EMPNotes = ':notes', "
                . "EMPDateUpdate = ':dateupdate', EMPUpdateBy = ':updateby' "
                . "WHERE EMPId = :id;";        
        
        $sql = $this->replaceData($sql);
           
        $result = $crud->sql($sql);
    }
    
    /* DELETE FROM DATABASE */  
    public function delete(){        
        
        $crud = new dbcrud();
        $sql = "DELETE FROM employees WHERE EMPId = :id;";        
        
        $sql = str_replace(':id', $this->getId(), $sql);          
               
        $result = $crud->sql($sql);      
       
    }
    
    /* REPLACE DATA IN SQL STRING */
    public function replaceData ($sql){
                
        $sql = str_replace(':natid', $this->getNatid(), $sql);
        $sql = str_replace(':type', $this->getType(), $sql);        
        $sql = str_replace(':name', $this->getName(), $sql);
        $sql = str_replace(':lastname', $this->getLastName(), $sql);
        $sql = str_replace(':email', $this->getEmail(), $sql);        
        $sql = str_replace(':phone', $this->getPhone(), $sql);
        $sql = str_replace(':mobile', $this->getMobile(), $sql);   
        $sql = str_replace(':notes', $this->getNotes(), $sql);        
        $sql = str_replace(':dateinsert', $this->getDateInsert(), $sql);        
        $sql = str_replace(':insertby', $this->getInsertBy(), $sql);
        $sql = str_replace(':dateupdate', $this->getDateupdate(), $sql);        
        $sql = str_replace(':updateby', $this->getUpdateby(), $sql);
        
        
        /* NUMERIC VALUES*/ 
        if ($this->getId() != null )
        {
            $sql = str_replace(':id', $this->getId(), $sql);
        }
        else {$sql = str_replace(':id', 'null', $sql);} 
        if ($this->getUsrid() != null)
        {
            $sql = str_replace(':usrid', $this->getUsrid(), $sql);
        }
        else {$sql = str_replace(':usrid', 'null', $sql);}
        
        if ($this->getRatehour() != null)
        {
            $sql = str_replace(':ratehour', $this->getRatehour(), $sql);
        }
        else {$sql = str_replace(':ratehour', 'null', $sql);}
        
        if ($this->getRateday() != null)
        {
            $sql = str_replace(':rateday', $this->getRateday(), $sql);
        }
        else { $sql = str_replace(':rateday', 'null', $sql);}
        
        return $sql;
    }
    
    /* FUNCTIONS GETTERS, SETTERS */
   
    public function getId() {
        return $this->id;
    }

    public function getNatid() {
        return $this->natid;
    }

    public function getUsrid() {
        return $this->usrid;
    }
    
    public function getType() {
        return $this->type;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function getRatehour() {
        return $this->ratehour;
    }

    public function getRateday() {
        return $this->rateday;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function getDateinsert() {
        return $this->dateinsert;
    }

    public function getInsertby() {
        return $this->insertby;
    }

    public function getDateupdate() {
        return $this->dateupdate;
    }

    public function getUpdateby() {
        return $this->updateby;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNatid($natid): void {
        $this->natid = $natid;
    }

    public function setUsrid($usrid): void {
        $this->usrid = $usrid;
    }
    
    public function setType($type): void {
        $this->type = $type;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setLastname($lastname): void {
        $this->lastname = $lastname;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setPhone($phone): void {
        $this->phone = $phone;
    }

    public function setMobile($mobile): void {
        $this->mobile = $mobile;
    }

    public function setRatehour($ratehour): void {
        $this->ratehour = $ratehour;
    }

    public function setRateday($rateday): void {
        $this->rateday = $rateday;
    }

    public function setNotes($notes): void {
        $this->notes = $notes;
    }

    public function setDateinsert($dateinsert): void {
        $this->dateinsert = $dateinsert;
    }

    public function setInsertby($insertby): void {
        $this->insertby = $insertby;
    }

    public function setDateupdate($dateupdate): void {
        $this->dateupdate = $dateupdate;
    }

    public function setUpdateby($updateby): void {
        $this->updateby = $updateby;
    }

   

   



}
?>