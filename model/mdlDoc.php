<!--
Project: To be defined
Date: September 2020
By: Alberto Martínez pineda
-->
<?php

include_once ('dbcrud.php');

class mdlDoc {
    /* ATTRIBUTES */
    private $id;
    private $name;
    private $obj;  
    private $objid;
    private $path;
    private $dateinsert;
    private $insertby;
    
    /* FUNCTIONS */
    
       
    /* INSERT NEW RECORD IN DATABASE */
    public function insert(){
        
        $crud = new dbcrud();
        $sql = "INSERT INTO documents (DOCName, DOCObj, DOCObjId, DOCPath, DOCInsertDate, DOCInsertBy) "
              ."VALUES (':name', ':obj', :objid, ':path', ':insertdate', ':insertby');";        
        
        $sql = $this->raplaceData($sql);
        
        $result = $crud->sql($sql);        
        
    }
    
    /* UPDATE CURRENT RECORD */
    public function update(){
        
        $crud = new dbcrud();
        $sql = "UPDATE documents SET DOCId = ':id', DOCName = ':name', DOCObj = ':obj', DOCObjId = :objid, DOCPath = ':path', "
                ."DOCInsertDate = ':insertdate', DOCInsertBy = ':insertby' "
                ."WHERE DOCId = :id;";        
        
        $sql = $this->raplaceData($sql);
               
        $result = $crud->sql($sql);
      
    }
    
    /* DELETE FROM DATABASE */  
    public function delete(){        
        $crud = new dbcrud();
        $sql = "DELETE FROM documents WHERE DOCId = :id;";        
        
        $sql = str_replace(':id', $this->getId(), $sql);          
               
        $result = $crud->sql($sql);
        
    }
    
    /* REPLACE DATA IN SQL STRING */
    public function raplaceData ($sql){
        
        $sql = str_replace(':id', $this->getId(), $sql);
        $sql = str_replace(':name', $this->getName(), $sql);
        $sql = str_replace(':objid', $this->getObjid(), $sql);
        $sql = str_replace(':obj', $this->getObj(), $sql);        
        $sql = str_replace(':path', $this->getPath(), $sql);
        $sql = str_replace(':insertdate', $this->getDateInsert(), $sql);        
        $sql = str_replace(':insertby', $this->getInsertBy(), $sql);
        
        return $sql;
        
    }
    
    /* FUNCTIONS GETTERS, SETTERS */
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getObj() {
        return $this->obj;
    }

    public function getObjid() {
        return $this->objid;
    }

    public function getPath() {
        return $this->path;
    }

    public function getDateinsert() {
        return $this->dateinsert;
    }

    public function getInsertby() {
        return $this->insertby;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setObj($obj): void {
        $this->obj = $obj;
    }

    public function setObjid($objid): void {
        $this->objid = $objid;
    }

    public function setPath($path): void {
        $this->path = $path;
    }

    public function setDateinsert($dateinsert): void {
        $this->dateinsert = $dateinsert;
    }

    public function setInsertby($insertby): void {
        $this->insertby = $insertby;
    }


}
?>