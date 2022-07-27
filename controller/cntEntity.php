<?php 
    session_start();
    include_once '../model/mdlEntity.php';
    include_once '../model/dbcrud.php';
    
    /* INSERT NEW RECORD */    
    if (isset ($_POST['entidu']) && $_POST['entidu'] == 'NUEVO'){
        try{
           
            $ent = setData('I');
            
            $ent->insert();

            echo "<script>alert('El registro se ha creado correctamente.');</script>"; 
            
            /*TODO: To get the Id. of the new record.*/
            unset ($_SESSION['mode']);        
            echo "<script>window.close();</script>";            
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
        
       
    } /* UPDATE CURRENT RECORD */   
    elseif (isset ($_POST['entidu']) && $_POST['entidu'] == 'EDITAR') {
        
        try{
            $ent = setData('U');

            $ent->update();
            
            echo "<script>alert('El registro se ha editado correctamente.');</script>";
            
            unset ($_SESSION['mode']);
            echo '<script type="text/javascript">window.location="../view/entitydata.php?update&identity='.$ent->getId().'";</script>';
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
        
    } /* DELETE CURRENT RECORD */
    elseif (isset ($_POST['entidu']) && $_POST['entidu'] == 'ELIMINAR') {                      
        
        try{
            $ent = setData('D');

            $ent->delete();

            unset ($_SESSION['mode']);
            echo "<script>window.close();</script>";            
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
    }
    
     /* CHECKS IF THERE IS A FILTER */
    if (isset ($_POST['entfilter'])){        
        $_SESSION['entfilter'] = $_POST['entfilter'];
        echo '<script type="text/javascript">window.location="../view/entities.php";</script>';
           
    }
    
    function setData($mode){
        
        $date = date('Y-m-d H:i:s');
        $ent = new mdlEntity();
        
        $ent->setId($_POST['entid']);
        $ent->setType($_POST['enttype']);
        $ent->setStatus($_POST['entstatus']);
        $ent->setName($_POST['entname']);
        $ent->setLastname($_POST['entlastname']);
        $ent->setCompany($_POST['entcompany']);
        $ent->setFiscalid($_POST['entfiscalid']);
        $ent->setAddress($_POST['entaddress']);
        $ent->setCity($_POST['entcity']);
        $ent->setPostalcode($_POST['entpostalcode']);
        $ent->setCountry($_POST['entcountry']);            
        $ent->setEmail($_POST['entemail']);
        $ent->setPhone($_POST['entphone']);
        $ent->setMobile($_POST['entmobile']);
        $ent->setAccount($_POST['entaccount']);
        $ent->setPayment($_POST['entpayment']);
        $ent->setPaymentday($_POST['entpaymentday']);
        $ent->setBank($_POST['entbank']);
        $ent->setBillingnotes($_POST['entbillingnotes']);
        $ent->setNotes($_POST['entnotes']);
        
        if($mode == 'I'){
            $ent->setDateInsert($date);
            $ent->setInsertBy($_SESSION['login']);                
        }
        if ($mode == 'U'){
            $ent->setDateUpdate($date);
            $ent->setUpdateBy($_SESSION['login']);
        }
        
        return $ent;
    }
    
    function selectEntities(){
        $user = new mdlEntity();
        $entCrud = new dbcrud();
        
               
        if (isset ($_SESSION['entfilter'])) {
            $filter = $_SESSION['entfilter'];
            $entSQL = "SELECT * FROM entities WHERE ENTName LIKE '%:filter%' OR ENTLastName LIKE '%:filter%' OR ENTCompany LIKE '%:filter%' OR ENTFiscalId LIKE '%:filter%'";
            
            $entSQL = str_replace(':filter', $filter, $entSQL);
        }
        else {
            $entSQL = "SELECT * FROM entities";
        }
        
        unset($_SESSION['entfilter']);
        
        /* Headers */
        echo '<tr>'
                . '<th style="width:240px">Acciones</th><th>Id.</th><th>Estado</th><th>Nombre</th><th>Apellidos</th><th>Empresa</th><th>NIF</th>'
           . '</tr>';
        
        /* Records */
        $result = $entCrud->sql($entSQL);

        if ($result->num_rows > 0) {         
          // output data of each row
          $_SESSION['numentities'] = $result->num_rows;
          
          while($row = $result->fetch_assoc()) {
            echo '<tr><td><a href="entitydata.php?update&identity='.$row["ENTId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="Editar Cliente" style="margin-left: 2px"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
                    . '<a href="entitydata.php?delete&identity='.$row["ENTId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="Eliminar Cliente" style="margin-left: 2px"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                    . '<a href="entities.php?identity='.$row["ENTId"].'" class="btn btn-dark btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="Ver Cliente" style="margin-left: 2px"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                    . '<a href="docs.php?obj=ENTITES&objid='.$row["ENTId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="Documentos" style="margin-left: 2px"><i class="fa fa-file" aria-hidden="true"></i></a></td>'
                    . '<td>'.$row["ENTId"].'</td><td>'.$row["ENTStatus"].'</td><td>'.$row["ENTName"].'</td><td>'
                    .$row["ENTLastName"].'</td><td>'.$row["ENTCompany"].'</td><td>'.$row["ENTFiscalId"].'</td>'
                    
                .'</tr>';            
            }         
        }
        else {
            $_SESSION['numentities'] = 0;
        }
    }
    
    function selectEntityById($idEnt){
        $ent = new mdlEntity();
        $entCrud = new dbcrud();
        $entSQL = "SELECT * FROM entities WHERE ENTId = " . $idEnt;  
        $sqltypes = "SELECT * FROM types WHERE TYPTable = 'ENTITIES'";
        $sqlstatus = "SELECT * FROM status WHERE STTTable = 'ENTITIES'";
        
        /* Record */
        $result = $entCrud->sql($entSQL);

        if ($result->num_rows > 0) {
          //  while ($cols = $result->num_cols )
          //echo '<tr><th>ID</th><th>Name</th></tr>';
          // output data of each row
          
            while($row = $result->fetch_assoc()) {
            echo  '<tr><td>Id. Cliente:</td><td><input type="text" name="entid" readonly="true" value="'.$row["ENTId"].'"></td>'
                . '<td>Tipo:</td><td><select style="width: 150px;" name="enttype" value=""><option value=""></option>';            
                $rtypes = $entCrud->sql($sqltypes);  
                while ($rowtype = $rtypes->fetch_assoc()) {
                    echo '<option value="'.$rowtype["TYPCode"].'"';
                    if ($rowtype["TYPCode"]==$row["ENTType"]) {echo ' selected="selected"';}                    
                    echo '>'.$rowtype["TYPName"].'</option>';
                }            
            echo  '</select></td></tr>'
                
                . '<tr><td>Estado:</td><td><select style="width: 150px;" name="entstatus" value=""><option value=""></option>';            
                $rstatus = $entCrud->sql($sqlstatus);  
                while ($rowst = $rstatus->fetch_assoc()) {
                    echo '<option value="'.$rowst["STTCode"].'"';
                    if ($rowst["STTCode"]==$row["ENTStatus"]) {echo ' selected="selected"';}                    
                    echo '>'.$rowst["STTName"].'</option>';
                }            
            echo  '</select></td>' 
                
                . '<td>Nombre:</td><td><input type="text" name="entname" value="'.$row["ENTName"].'"></td></tr>'
                    
                . '<tr><td>Apellidos:</td><td><input type="text" name="entlastname" value="'.$row["ENTLastName"].'"></td>'
                . '<td>Empresa:</td><td><input type="text" name="entcompany" value="'.$row["ENTCompany"].'"></td></tr>'
                    
                . '<tr><td>NIF:</td><td><input type="text" name="entfiscalid" value="'.$row["ENTFiscalId"].'"></td>'
                . '<td>Dirección:</td><td><input type="text" name="entaddress" value="'.$row["ENTAddress"].'"></td></tr>'
                    
                . '<tr><td>Ciudad:</td><td><input type="text" name="entcity" value="'.$row["ENTCity"].'"></td>'
                . '<td>Cód. Postal:</td><td><input type="text" name="entpostalcode" value="'.$row["ENTPostalCode"].'"></td></tr>'
                    
                . '<tr><td>País:</td><td><input type="text" name="entcountry" value="'.$row["ENTCountry"].'"></td>'
                . '<td>Email:</td><td><input type="text" name="entemail" value="'.$row["ENTEmail"].'"></td></tr>'                
                  
                . '<tr><td>Teléfono:</td><td><input type="text" name="entphone" value="'.$row["ENTPhone"].'"></td>'
                . '<td>Móvil:</td><td><input type="text" name="entmobile" value="'.$row["ENTMobile"].'"></td></tr>'
                    
                . '<tr><td>Cuenta Contable:</td><td><input type="text" name="entaccount" value="'.$row["ENTAccount"].'"></td>'
                . '<td>Forma de Pago:</td><td><input type="text" name="entpayment" value="'.$row["ENTPayment"].'"></td></tr>'
                    
                . '<tr><td>Día de Pago:</td><td><input type="text" name="entpaymentday" value="'.$row["ENTPaymentDay"].'"></td>'
                . '<td>Banco:</td><td><input type="text" name="entbank" value="'.$row["ENTBank"].'"></td></tr>'
                    
                . '<tr><td>Notas Facturación:</td><td><input type="text" name="entbillingnotes" value="'.$row["ENTBillingNotes"].'"></td>'
                . '<td>Notas:</td><td><input type="text" name="entnotes" value="'.$row["ENTNotes"].'"></td></tr>'
                                
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="entdateinsert" readonly="true" value="'.$row["ENTDateInsert"].'"></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="entinsertby" readonly="true" value="'.$row["ENTInsertBy"].'"></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="entdateupdate" readonly="true" value="'.$row["ENTDateUpdate"].'"></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="entupdateby" readonly="true" value="'.$row["ENTUpdateBy"].'"></td></tr>';
                
            }
         
        } else {
            echo '<tr><td>Id. Cliente:</td><td><input type="text" name="entid" readonly="true" value=""></td>'
               . '<td>Tipo:</td><td><select style="width: 150px;" name="enttype" value=""><option value=""></option>';
                $rtypes = $entCrud->sql($sqltypes);  
                while ($rowtype = $rtypes->fetch_assoc()) {
                    echo '<option value="'.$rowtype["TYPCode"].'">'.$rowtype["TYPName"].'</option>';
                }
            echo  '</select></td></tr>'       
                
                . '<tr><td>Estado:</td><td><select style="width: 150px;" name="entstatus" value=""><option value=""></option>';            
                $rstatus = $entCrud->sql($sqlstatus);  
                while ($rowst = $rstatus->fetch_assoc()) {
                    echo '<option value="'.$rowst["STTCode"].'">'.$rowst["STTName"].'</option>';
                }            
            echo  '</select></td>'   
                . '<td>Nombre:</td><td><input type="text" name="entname" value=""></td></tr>'
                    
                . '<tr><td>Apellidos:</td><td><input type="text" name="entlastname" value=""></td>'
                . '<td>Empresa:</td><td><input type="text" name="entcompany" value=""></td></tr>'
                    
                . '<tr><td>NIF:</td><td><input type="text" name="entfiscalid" value=""></td>'
                . '<td>Dirección:</td><td><input type="text" name="entaddress" value=""></td></tr>'
                    
                . '<tr><td>Ciudad:</td><td><input type="text" name="entcity" value=""></td>'
                . '<td>Cód. Postal:</td><td><input type="text" name="entpostalcode" value=""></td></tr>'
                    
                . '<tr><td>País:</td><td><input type="text" name="entcountry" value=""></td>'
                . '<td>Email:</td><td><input type="text" name="entemail" value=""></td></tr>' 
                    
                . '<tr><td>Teléfono:</td><td><input type="text" name="entphone" value=""></td>'
                . '<td>Móvil:</td><td><input type="text" name="entmobile" value=""></td></tr>'
                    
                . '<tr><td>Cuenta Contable:</td><td><input type="text" name="entaccount" value=""></td>'
                . '<td>Forma de Pago:</td><td><input type="text" name="entpayment" value=""></td></tr>'
                    
                . '<tr><td>Día de Pago:</td><td><input type="text" name="entpaymentday" value=""></td>'
                . '<td>Banco:</td><td><input type="text" name="entbank" value=""></td></tr>'
                    
                . '<tr><td>Notas Facturación:</td><td><input type="text" name="entbillingnotes" value=""></td>'
                . '<td>Notas:</td><td><input type="text" name="entnotes" value=""></td></tr>'                    
                
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="entdateinsert" readonly="true" value=""></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="entinsertby" readonly="true" value=""></td></tr>'
                
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="entdateupdate" readonly="true" value=""></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="entupdateby" readonly="true" value=""></td></tr>';     
        }
         
    }
    
    function showEntity($idEnt){
        $ent = new mdlEntity();
        $entCrud = new dbcrud();
        $entSQL = "SELECT * FROM entities WHERE ENTId = " . $idEnt;   
        
        /* Record */
        $result = $entCrud->sql($entSQL);

        if ($result->num_rows > 0) {
          //  while ($cols = $result->num_cols )
          //echo '<tr><th>ID</th><th>Name</th></tr>';
          // output data of each row
          
            while($row = $result->fetch_assoc()) {
            echo '<tr><td>Id. Cliente:</td><td><input type="text" name="entid" readonly="true" value="'.$row["ENTId"].'"></td></tr>'
                . '<tr><td>Estado:</td><td><input type="text" name="status" value="'.$row["ENTStatus"].'"></td></tr>'
                . '<tr><td>Nombre:</td><td><input type="text" name="name" value="'.$row["ENTName"].'"></td></tr>'
                . '<tr><td>Apellidos:</td><td><input type="text" name="lastname" value="'.$row["ENTLastName"].'"></td></tr>'
                . '<tr><td>Empresa:</td><td><input type="text" name="company" value="'.$row["ENTCompany"].'"></td></tr>'
                . '<tr><td>NIF:</td><td><input type="text" name="fiscalid" value="'.$row["ENTFiscalId"].'"></td></tr>'
                . '<tr><td>Dirección:</td><td><input type="text" name="address" value="'.$row["ENTAddress"].'"></td></tr>'
                . '<tr><td>Ciudad:</td><td><input type="text" name="city" value="'.$row["ENTCity"].'"></td></tr>'
                . '<tr><td>Cód. Postal:</td><td><input type="text" name="postalcode" value="'.$row["ENTPostalCode"].'"></td></tr>'
                . '<tr><td>País:</td><td><input type="text" name="country" value="'.$row["ENTCountry"].'"></td></tr>'
                . '<tr><td>Email:</td><td><input type="text" name="email" value="'.$row["ENTEmail"].'"></td></tr>';   
            }
         
        } else {
            echo '<tr><td>Id. Cliente:</td><td><input type="text" name="entid" readonly="true" value=""></td></tr>'
                . '<tr><td>Estado:</td><td><input type="text" name="status" value=""></td></tr>'
                . '<tr><td>Nombre:</td><td><input type="text" name="name" value=""></td></tr>'
                . '<tr><td>Apellidos:</td><td><input type="text" name="lastname" value=""></td></tr>'
                . '<tr><td>Empresa:</td><td><input type="text" name="company" value=""></td></tr>'
                . '<tr><td>NIF:</td><td><input type="text" name="fiscalid" value=""></td></tr>'
                . '<tr><td>Dirección:</td><td><input type="text" name="address" value=""></td></tr>'
                . '<tr><td>Ciudad:</td><td><input type="text" name="city" value=""></td></tr>'
                . '<tr><td>Cód. Postal:</td><td><input type="text" name="postalcode" value=""></td></tr>'
                . '<tr><td>País:</td><td><input type="text" name="country" value=""></td></tr>'
                . '<tr><td>Email:</td><td><input type="text" name="email" value=""></td></tr>';     
        }
         
    }
            
?>