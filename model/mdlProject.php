<!--
Project: To be defined
Date: September 2020
By: Alberto Martínez pineda
-->
<?php

include_once ('dbcrud.php');

class mdlProject{
    /* ATTRIBUTES */
    private $id;
    private $identity;
    private $idemployee;
    private $type;
    private $status; 
    private $name;
    private $description;
    private $datestart;
    private $dateend;
    private $datestartpln;
    private $dateendpln;
    private $budget;
    private $budgetreal;    
    private $cost;  
    private $costreal;
    private $notes;    
    private $dateinsert;
    private $insertby;
    private $dateupdate;
    private $updateby;
    
       
    /* FUNCTIONS */
    
   /* INSERT NEW RECORD IN DATABASE */
    public function insert(){
        
        $crud = new dbcrud();
        $sql = "INSERT INTO projects (PRJIdEntity, PRJIdEmployee, PRJType, PRJStatus, PRJName, PRJDescription, PRJDateStart, PRJDateEnd, "
             . "PRJDateStartPln, PRJDateEndPln, PRJBudget, PRJBudgetReal, PRJCost, PRJCostReal, PRJNotes, PRJDateInsert, PRJInsertBy) "
             . "VALUES (:identity, :idemployee, ':type', ':status', ':name', ':description', ':datestart', ':dateend', "
             . "':plndatestart', ':plndateend', :budget, :realbudget, :cost, :realcost, ':notes', ':dateinsert', ':insertby');";        
        
        $sql = $this->replaceData($sql);                 
        
        $result = $crud->sql($sql); 
        
    }
    
    /* UPDATE CURRENT RECORD */
    public function update(){
        
        $crud = new dbcrud();
        $sql = "UPDATE projects SET PRJIdEntity = :identity, PRJIdEmployee = :idemployee, PRJType = ':type', PRJStatus = ':status', PRJName = ':name', PRJDescription = ':description', "
                . "PRJDateStart = ':datestart', PRJDateEnd = ':dateend', PRJDateStartPln = ':plndatestart', PRJDateEndPln= ':plndateend', PRJBudget = :budget, "
                . "PRJBudgetReal = :realbudget, PRJCost = :cost, PRJCostReal = :realcost, PRJNotes = ':notes', "
                . "PRJDateUpdate = ':dateupdate', PRJUpdateBy = ':updateby' "
                . "WHERE PRJId = :id;";        
        
        $sql = $this->replaceData($sql);
                
        $result = $crud->sql($sql);
    }
    
    /* DELETE FROM DATABASE */  
    public function delete(){        
        
        $crud = new dbcrud();
        $sql = "DELETE FROM projects WHERE PRJId = :id;";        
        
        $sql = str_replace(':id', $this->getId(), $sql);          
               
        $result = $crud->sql($sql);      
       
    }
    
    /* REPLACE DATA IN SQL STRING */
    public function replaceData ($sql){
                
        $sql = str_replace(':identity', $this->getIdentity(), $sql);
        $sql = str_replace(':idemployee', $this->getIdemployee(), $sql);
        $sql = str_replace(':type', $this->getType(), $sql); 
        $sql = str_replace(':status', $this->getStatus(), $sql);
        $sql = str_replace(':name', $this->getName(), $sql);
        $sql = str_replace(':description', $this->getDescription(), $sql);
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
        
        if ($this->getBudget() != null)
        {
            $sql = str_replace(':budget', $this->getBudget(), $sql);
        }
        else {$sql = str_replace(':budget', 'null', $sql);}
        
        if ($this->getBudgetreal() != null)
        {
            $sql = str_replace(':realbudget', $this->getBudgetreal(), $sql);
        }
        else {$sql = str_replace(':realbudget', 'null', $sql);}
        
        if ($this->getCost() != null)
        {
            $sql = str_replace(':cost', $this->getCost(), $sql);
        }
        else {$sql = str_replace(':cost', 'null', $sql);}
        
        if ($this->getCostreal() != null)
        {
            $sql = str_replace(':realcost', $this->getCostreal(), $sql);
        }
        else {$sql = str_replace(':realcost', 'null', $sql);}
               
        
        /* DATE VALUES */
        if ($this->getDatestart() != null )
        {
            $sql = str_replace(':datestart', $this->getDatestart(), $sql);
        }
        else {$sql = str_replace(':datestart', 'null', $sql);} 
        
        if ($this->getDateend() != null )
        {
            $sql = str_replace(':dateend', $this->getDateend(), $sql);
        }
        else {$sql = str_replace(':dateend', 'null', $sql);} 
        
        if ($this->getDatestartpln() != null )
        {
            $sql = str_replace(':plndatestart', $this->getDatestartpln(), $sql);
        }
        else {$sql = str_replace(':plndatestart', 'null', $sql);} 
        
        if ($this->getDateendpln() != null )
        {
            $sql = str_replace(':plndateend', $this->getDateendpln(), $sql);
        }
        else {$sql = str_replace(':plndateend', 'null', $sql);}
       
        
        
        return $sql;
    }
    
    
    /* FUNCTIONS GETTERS, SETTERS */
    public function getId() {
        return $this->id;
    }

    public function getIdentity() {
        return $this->identity;
    }

    public function getIdemployee() {
        return $this->idemployee;
    }

    public function getType() {
        return $this->type;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDatestart() {
        return $this->datestart;
    }

    public function getDateend() {
        return $this->dateend;
    }

    public function getDatestartpln() {
        return $this->datestartpln;
    }

    public function getDateendpln() {
        return $this->dateendpln;
    }

    public function getBudget() {
        return $this->budget;
    }

    public function getBudgetreal() {
        return $this->budgetreal;
    }

    public function getCost() {
        return $this->cost;
    }

    public function getCostreal() {
        return $this->costreal;
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

    public function setIdentity($identity): void {
        $this->identity = $identity;
    }

    public function setIdemployee($idemployee): void {
        $this->idemployee = $idemployee;
    }

    public function setType($type): void {
        $this->type = $type;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setDatestart($datestart): void {
        $this->datestart = $datestart;
    }

    public function setDateend($dateend): void {
        $this->dateend = $dateend;
    }

    public function setDatestartpln($datestartpln): void {
        $this->datestartpln = $datestartpln;
    }

    public function setDateendpln($dateendpln): void {
        $this->dateendpln = $dateendpln;
    }

    public function setBudget($budget): void {
        $this->budget = $budget;
    }

    public function setBudgetreal($budgetreal): void {
        $this->budgetreal = $budgetreal;
    }

    public function setCost($cost): void {
        $this->cost = $cost;
    }

    public function setCostreal($costreal): void {
        $this->costreal = $costreal;
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