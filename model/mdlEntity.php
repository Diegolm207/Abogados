<!--
Project: To be defined
Date: September 2020
By: Alberto Martínez pineda
-->
<?php

include_once ('dbcrud.php');

class mdlEntity {
    /* ATTRIBUTES */
    private $id;
    private $type;
    private $status; 
    private $name;
    private $lastname;
    private $company;
    private $fiscalid;
    private $address;
    private $city;
    private $postalcode;
    private $country;    
    private $email;  
    private $phone;
    private $mobile;
    private $account;
    private $payment;
    private $paymentday;
    private $bank;
    private $billingnotes;
    private $notes;    
    private $dateinsert;
    private $insertby;
    private $dateupdate;
    private $updateby;
    
       
    /* FUNCTIONS */
    
    /* INSERT NEW RECORD IN DATABASE */
    public function insert(){
        
        $crud = new dbcrud();
        $sql = "INSERT INTO entities (ENTType, ENTStatus, ENTName, ENTLastName, ENTCompany, ENTFiscalId, ENTAddress, ENTCity, ENTPostalCode, ENTCountry, ENTEmail, ENTPhone, "
                . "ENTMobile, ENTAccount, ENTPayment, ENTPaymentDay, ENTBank, ENTBillingNotes, ENTNotes, ENTDateInsert, ENTInsertBy) "
              ."VALUES (':type', ':status', ':name', ':lastname', ':company', ':fiscalid', ':address', ':city', ':postalcode', ':country', ':email', ':phone', "
                . "':mobile', ':account', :paymentw, :paymentday, ':bank', ':billingnotes', ':notes', ':dateinsert', ':insertby');";        
        
        $sql = $this->replaceData($sql); 
               
        $result = $crud->sql($sql); 
        
    }
    
    /* UPDATE CURRENT RECORD */
    public function update(){
        
        $crud = new dbcrud();
        $sql = "UPDATE entities SET ENTType = ':type', ENTStatus = ':status', ENTName = ':name', ENTLastName = ':lastname', ENTCompany = ':company', ENTFiscalId = ':fiscalid', "
                . "ENTAddress = ':address', ENTCity = ':city', ENTPostalCode = ':postalcode', ENTCountry = ':country', ENTEmail = ':email', ENTPhone = ':phone', "
                . "ENTMobile = ':mobile', ENTAccount = ':account', ENTPayment= :paymentw, ENTPaymentDay = :paymentday, ENTBank = ':bank', ENTBillingNotes = ':billingnotes', "
                . "ENTNotes = ':notes', ENTDateUpdate = ':dateupdate', ENTUpdateBy = ':updateby' "
                . "WHERE ENTId = :id;";        
        
        $sql = $this->replaceData($sql); 
               
        $result = $crud->sql($sql);        
       
    }
    
    /* DELETE FROM DATABASE */  
    public function delete(){        
        
        $crud = new dbcrud();
        $sql = "DELETE FROM entities WHERE ENTId = :id;";        
        
        $sql = str_replace(':id', $this->getId(), $sql);          
               
        $result = $crud->sql($sql);      
       
    }
    
     /* REPLACE DATA IN SQL STRING */
    public function replaceData ($sql){
                
        $sql = str_replace(':id', $this->getId(), $sql);
        $sql = str_replace(':type', $this->getType(), $sql);
        $sql = str_replace(':status', $this->getStatus(), $sql);
        $sql = str_replace(':name', $this->getName(), $sql);
        $sql = str_replace(':lastname', $this->getLastName(), $sql);
        $sql = str_replace(':company', $this->getCompany(), $sql);
        $sql = str_replace(':fiscalid', $this->getFiscalid(), $sql);
        $sql = str_replace(':address', $this->getAddress(), $sql);
        $sql = str_replace(':city', $this->getCity(), $sql);
        $sql = str_replace(':postalcode', $this->getPostalcode(), $sql);
        $sql = str_replace(':country', $this->getCountry(), $sql);
        $sql = str_replace(':email', $this->getEmail(), $sql);        
        $sql = str_replace(':phone', $this->getPhone(), $sql);
        $sql = str_replace(':mobile', $this->getMobile(), $sql);
        $sql = str_replace(':account', $this->getAccount(), $sql);
        
        $sql = str_replace(':bank', $this->getBank(), $sql);
        $sql = str_replace(':billingnotes', $this->getBillingnotes(), $sql);
        $sql = str_replace(':notes', $this->getNotes(), $sql); 
        $sql = str_replace(':dateinsert', $this->getDateInsert(), $sql);        
        $sql = str_replace(':insertby', $this->getInsertBy(), $sql);
        $sql = str_replace(':dateupdate', $this->getDateupdate(), $sql);        
        $sql = str_replace(':updateby', $this->getUpdateby(), $sql);
        
        if ($this->getPayment() != null)
        {
            $sql = str_replace(':paymentw', $this->getPayment(), $sql);
        }
        else {$sql = str_replace(':paymentw', 'null', $sql);}
        if ($this->getPaymentday() != null)
        {
            $sql = str_replace(':paymentday', $this->getPaymentday(), $sql);
        }
        else { $sql = str_replace(':paymentday', 'null', $sql);}        
        
        return $sql;
    }
    
    /* FUNCTIONS GETTERS, SETTERS */
    public function getId() {
        return $this->id;
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

    public function getLastname() {
        return $this->lastname;
    }

    public function getCompany() {
        return $this->company;
    }

    public function getFiscalid() {
        return $this->fiscalid;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCity() {
        return $this->city;
    }

    public function getPostalcode() {
        return $this->postalcode;
    }

    public function getCountry() {
        return $this->country;
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

    public function getAccount() {
        return $this->account;
    }

    public function getPayment() {
        return $this->payment;
    }

    public function getPaymentday() {
        return $this->paymentday;
    }

    public function getBank() {
        return $this->bank;
    }

    public function getBillingnotes() {
        return $this->billingnotes;
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

    public function setType($type): void {
        $this->type = $type;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setLastname($lastname): void {
        $this->lastname = $lastname;
    }

    public function setCompany($company): void {
        $this->company = $company;
    }

    public function setFiscalid($fiscalid): void {
        $this->fiscalid = $fiscalid;
    }

    public function setAddress($address): void {
        $this->address = $address;
    }

    public function setCity($city): void {
        $this->city = $city;
    }

    public function setPostalcode($postalcode): void {
        $this->postalcode = $postalcode;
    }

    public function setCountry($country): void {
        $this->country = $country;
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

    public function setAccount($account): void {
        $this->account = $account;
    }

    public function setPayment($payment): void {
        $this->payment = $payment;
    }

    public function setPaymentday($paymentday): void {
        $this->paymentday = $paymentday;
    }

    public function setBank($bank): void {
        $this->bank = $bank;
    }

    public function setBillingnotes($billingnotes): void {
        $this->billingnotes = $billingnotes;
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