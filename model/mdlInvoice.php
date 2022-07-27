<!--
Project: To be defined
Date: September 2020
By: Alberto Martínez pineda
-->
<?php

include_once ('dbcrud.php');

class mdlInvoice{
    /* ATTRIBUTES */
    private $id;
    private $idproject;
    private $number;    
    private $date;
    private $dateacc;
    private $datedue;
    private $dateplanned;
    private $status;    
    private $base;
    private $vattype;
    private $vat;  
    private $vattotal;
    private $irpf;
    private $irpftotal;
    private $total;  
    private $notes;
    private $dateinsert;
    private $insertby;
    private $dateupdate;
    private $updateby;
        
    
       
    /* FUNCTIONS */
    
   /* INSERT NEW RECORD IN DATABASE */
    public function insert(){
        
        $crud = new dbcrud();
        $sql = "INSERT INTO invoices (INVIdProject,INVNumber,INVDate,INVDateAcc,INVDateDue,INVDatePlanned,INVStatus,INVBase,INVVatType,INVVat,INVVatTotal,INVIRPF, INVIRPFTotal, INVTotal,INVNotes,INVDateInsert,INVInsertBy)"             
             . "VALUES (:idproject, ':number', ':date', ':dateacc', ':datedue', ':dateplanned', ':status', :base, ':vattype', :vat, :vattotal, :irpf, :irpftotal, :total, ':notes', ':dateinsert', ':insertby');";        
                
        $sql = $this->replaceData($sql); 
        
        $result = $crud->sql($sql); 
        
    }
    
    /* UPDATE CURRENT RECORD */
    public function update(){
        
        $crud = new dbcrud();
        $sql = "UPDATE invoices SET INVIdProject = :idproject, INVNumber = ':number', INVDate = ':date', INVDateAcc = ':dateacc', INVDateDue = ':datedue',  INVDatePlanned = ':dateplanned', "
             . "INVStatus = ':status', INVBase = :base, INVVatType = ':vattype', INVVat = :vat, INVVatTotal = :vattotal, INVIRPF = :irpf, INVIRPFTotal = :irpftotal, INVTotal = :total, INVNotes = ':notes', INVDateUpdate = ':dateupdate', INVUpdateBy = ':updateby' WHERE INVId = :id;";
        
        $sql = $this->replaceData($sql);
               
        $result = $crud->sql($sql);
    }
    
    /* DELETE FROM DATABASE */  
    public function delete(){        
        
        $crud = new dbcrud();
        $sql = "DELETE FROM invoices WHERE INVId = :id;";        
        
        $sql = str_replace(':id', $this->getId(), $sql);          
               
        $result = $crud->sql($sql);          
       
    }
    
    /* REPLACE DATA IN SQL STRING */
    public function replaceData ($sql){
              
        $sql = str_replace(':number', $this->getNumber(), $sql);
        $sql = str_replace(':status', $this->getStatus(), $sql);
        $sql = str_replace(':vattype', $this->getVattype(), $sql);        
        $sql = str_replace(':notes', $this->getNotes(), $sql);
        $sql = str_replace(':insertby', $this->getInsertby(), $sql);               
        $sql = str_replace(':updateby', $this->getUpdateby(), $sql);
       
        
        /* NUMERIC VALUES*/ 
        if ($this->getIdproject() != null )
        {
            $sql = str_replace(':idproject', $this->getIdproject(), $sql);
        }
        else {$sql = str_replace(':idproject', 'null', $sql);}         
        
        if ($this->getBase() != null)
        {
            $sql = str_replace(':base', $this->getBase(), $sql);
        }
        else {$sql = str_replace(':base', 'null', $sql);}
        
        if ($this->getVattotal() != null)
        {
            $sql = str_replace(':vattotal', $this->getVattotal(), $sql);
        }
        else {$sql = str_replace(':vattotal', 'null', $sql);}
                
        if ($this->getVat() != null)
        {
            $sql = str_replace(':vat', $this->getVat(), $sql);
        }
        else {$sql = str_replace(':vat', 'null', $sql);} 
        
        if ($this->getIRPFTotal() != null)
        {
            $sql = str_replace(':irpftotal', $this->getIRPFTotal(), $sql);
        }
        else {$sql = str_replace(':irpftotal', 'null', $sql);}
        
        if ($this->getIRPF() != null)
        {
            $sql = str_replace(':irpf', $this->getIRPF(), $sql);
        }
        else {$sql = str_replace(':irpf', 'null', $sql);} 
        
        
        
                
        if ($this->getTotal() != null)
        {
            $sql = str_replace(':total', $this->getTotal(), $sql);
        }
        else {$sql = str_replace(':total', 'null', $sql);}
        
        if ($this->getId() != null )
        {
            $sql = str_replace(':id', $this->getId(), $sql);
        }
        else {$sql = str_replace(':id', 'null', $sql);} 
            
        
        /* DATE VALUES */
        
        if ($this->getDateacc() != null )
        {
            $sql = str_replace(':dateacc', $this->getDateacc(), $sql);
        }
        else {$sql = str_replace(':dateacc', 'null', $sql);} 
        
        if ($this->getDatedue() != null )
        {
            $sql = str_replace(':datedue', $this->getDatedue(), $sql);
        }
        else {$sql = str_replace(':datedue', 'null', $sql);} 
        
        if ($this->getDateplanned() != null )
        {
            $sql = str_replace(':dateplanned', $this->getDateplanned(), $sql);
        }
        else {$sql = str_replace(':dateplanned', 'null', $sql);} 
        
        if ($this->getDateinsert() != null )
        {
            $sql = str_replace(':dateinsert', $this->getDateinsert(), $sql);
        }
        else {$sql = str_replace(':dateinsert', 'null', $sql);} 
        
        if ($this->getDateupdate() != null )
        {
            $sql = str_replace(':dateupdate', $this->getDateupdate(), $sql);
        }
        else {$sql = str_replace(':dateupdate', 'null', $sql);} 
               
        if ($this->getDate() != null )
        {
            $sql = str_replace(':date', $this->getDate(), $sql);
        }
        else {$sql = str_replace(':date', 'null', $sql);} 
        
        return $sql;
    }
    
    
    /* FUNCTIONS GETTERS, SETTERS */
    public function getId() {
        return $this->id;
    }

    public function getIdproject() {
        return $this->idproject;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getDate() {
        return $this->date;
    }

    public function getDateacc() {
        return $this->dateacc;
    }

    public function getDatedue() {
        return $this->datedue;
    }

    public function getDateplanned() {
        return $this->dateplanned;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getBase() {
        return $this->base;
    }

    public function getVattype() {
        return $this->vattype;
    }

    public function getVat() {
        return $this->vat;
    }

    public function getVattotal() {
        return $this->vattotal;
    }
    
     public function getIRPF() {
        return $this->irpf;
    }

    public function getIRPFTotal() {
        return $this->irpftotal;
    }

    public function getTotal() {
        return $this->total;
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

    public function setNumber($number): void {
        $this->number = $number;
    }

    public function setDate($date): void {
        $this->date = $date;
    }

    public function setDateacc($dateacc): void {
        $this->dateacc = $dateacc;
    }

    public function setDatedue($datedue): void {
        $this->datedue = $datedue;
    }

    public function setDateplanned($dateplanned): void {
        $this->dateplanned = $dateplanned;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function setBase($base): void {
        $this->base = $base;
    }

    public function setVattype($vattype): void {
        $this->vattype = $vattype;
    }

    public function setVat($vat): void {
        $this->vat = $vat;
    }

    public function setVattotal($vattotal): void {
        $this->vattotal = $vattotal;
    }
    
    public function setIRPF($irpf): void {
        $this->irpf = $irpf;
    }

    public function setIRPFTotal($irpftotal): void {
        $this->irpftotal = $irpftotal;
    }

    public function setTotal($total): void {
        $this->total = $total;
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