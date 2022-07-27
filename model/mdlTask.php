<!--
Project: To be defined
Date: September 2020
By: Alberto Martínez pineda
-->
<?php

include_once ('dbcrud.php');

class mdlTask{
    /* ATTRIBUTES */
    private $id;
    private $idproject;
    private $identity;
    private $idemployee;    
    private $status; 
    private $name;
    private $description;
    private $datestart;
    private $dateend;
    private $percentagedone;
    private $toinvoice;
    private $invoice;
    private $timeplanned;    
    private $time;  
    private $hourrate;
    private $total;  
    private $totalcost;
    private $notes;
    private $dateinsert;
    private $insertby;
    private $dateupdate;
    private $updateby;
    
       
    /* FUNCTIONS */
    
   /* INSERT NEW RECORD IN DATABASE */
    public function insert(){
        
        $crud = new dbcrud();
        $sql = "INSERT INTO tasks (TSKIdProject, TSKIdEntity, TSKIdEmployee, TSKStatus, TSKName, TSKDescription, TSKDateStart, TSKDateEnd, "
             . "TSKPercentageDone, TSKToInvoice, TSKInvoice, TSKTimePlanned, TSKTime, TSKHourRate, TSKTotal, TSKTotalCost, TSKNotes, TSKDateInsert, TSKInsertBy) "
             . "VALUES (:idproject, :identity, :idemployee, ':status', ':name', ':description', ':datestart', ':dateend', "
             . ":percentagedone, :toinvoice, ':invoice', :timeplanned, :time, :hourrate, :total, :totalcost, ':notes', ':dateinsert', ':insertby');";        
        
        $sql = $this->replaceData($sql);                 
        
        $result = $crud->sql($sql); 
        
    }
    
    /* UPDATE CURRENT RECORD */
    public function update(){
        
        $crud = new dbcrud();
        $sql = "UPDATE tasks SET TSKIdProject = :idproject, TSKIdEntity = :identity, TSKIdEmployee = :idemployee, TSKStatus = ':status', TSKName = ':name', TSKDescription = ':description', "
                . "TSKDateStart = ':datestart', TSKDateEnd = ':dateend', TSKPercentageDone = :percentagedone, TSKToInvoice = :toinvoice, TSKInvoice = ':invoice', "
                . "TSKTimePlanned = :timeplanned, TSKTime = :time, TSKHourRate = :hourrate, TSKTotal = :total, TSKTotalCost = :totalcost, TSKNotes = ':notes', "
                . "TSKDateUpdate = ':dateupdate', TSKUpdateBy = ':updateby' "
                . "WHERE TSKId = :id;";        
        
        $sql = $this->replaceData($sql);
                
        $result = $crud->sql($sql);
    }
    
    /* DELETE FROM DATABASE */  
    public function delete(){        
        
        $crud = new dbcrud();
        $sql = "DELETE FROM tasks WHERE TSKId = :id;";        
        
        $sql = str_replace(':id', $this->getId(), $sql);          
               
        $result = $crud->sql($sql);      
       
    }
    
    /* REPLACE DATA IN SQL STRING */
    public function replaceData ($sql){
        
        $sql = str_replace(':idproject', $this->getIdproject(), $sql);        
        $sql = str_replace(':identity', $this->getIdentity(), $sql);
        $sql = str_replace(':idemployee', $this->getIdemployee(), $sql);
         
        $sql = str_replace(':status', $this->getStatus(), $sql);
        $sql = str_replace(':name', $this->getName(), $sql);
        $sql = str_replace(':description', $this->getDescription(), $sql);
        
                
        $sql = str_replace(':invoice', $this->getInvoice(), $sql);        
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
        
        if ($this->getPercentagedone() != null)
        {
            $sql = str_replace(':percentagedone', $this->getPercentagedone(), $sql);
        }        
        else {$sql = str_replace(':percentagedone', 'null', $sql);}
                        
        if ($this->getToinvoice() != null)
        {
            $sql = str_replace(':toinvoice', $this->getToinvoice(), $sql);
        }        
        else {$sql = str_replace(':toinvoice', '0', $sql);}        
        
        if ($this->getTimeplanned() != null)
        {
            $sql = str_replace(':timeplanned', $this->getTimeplanned(), $sql);
        }
        else {$sql = str_replace(':timeplanned', 'null', $sql);}
        
        if ($this->getTime() != null)
        {
            $sql = str_replace(':time', $this->getTime(), $sql);
        }
        else {$sql = str_replace(':time', 'null', $sql);}
        
        if ($this->getHourrate() != null)
        {
            $sql = str_replace(':hourrate', $this->getHourrate(), $sql);
        }
        else {$sql = str_replace(':hourrate', 'null', $sql);}
        
        if ($this->getTotalcost() != null)
        {
            $sql = str_replace(':totalcost', $this->getTotalcost(), $sql);
        }
        else {$sql = str_replace(':totalcost', 'null', $sql);}
        
        if ($this->getTotal() != null)
        {
            $sql = str_replace(':total', $this->getTotal(), $sql);
        }
        else {$sql = str_replace(':total', 'null', $sql);}
               
        
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
        
        
        return $sql;
    }
    
    
    /* FUNCTIONS GETTERS, SETTERS */
    public function getId() {
        return $this->id;
    }

    public function getIdproject() {
        return $this->idproject;
    }

    public function getIdentity() {
        return $this->identity;
    }

    public function getIdemployee() {
        return $this->idemployee;
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

    public function getPercentagedone() {
        return $this->percentagedone;
    }

    public function getToinvoice() {
        return $this->toinvoice;
    }

    public function getInvoice() {
        return $this->invoice;
    }

    public function getTimeplanned() {
        return $this->timeplanned;
    }

    public function getTime() {
        return $this->time;
    }

    public function getHourrate() {
        return $this->hourrate;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getTotalcost() {
        return $this->totalcost;
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

    public function setIdproject($idproject): void {
        $this->idproject = $idproject;
    }

    public function setIdentity($identity): void {
        $this->identity = $identity;
    }

    public function setIdemployee($idemployee): void {
        $this->idemployee = $idemployee;
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

    public function setPercentagedone($percentagedone): void {
        $this->percentagedone = $percentagedone;
    }

    public function setToinvoice($toinvoice): void {
        $this->toinvoice = $toinvoice;
    }

    public function setInvoice($invoice): void {
        $this->invoice = $invoice;
    }

    public function setTimeplanned($timeplanned): void {
        $this->timeplanned = $timeplanned;
    }

    public function setTime($time): void {
        $this->time = $time;
    }

    public function setHourrate($hourrate): void {
        $this->hourrate = $hourrate;
    }

    public function setTotal($total): void {
        $this->total = $total;
    }

    public function setTotalcost($totalcost): void {
        $this->totalcost = $totalcost;
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