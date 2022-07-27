<?php 
    //session_start();
    include_once '../model/mdlInvoice.php';
    include_once '../model/dbcrud.php';
    
    /* INSERT NEW RECORD */    
    if (isset ($_POST['invidu']) && $_POST['invidu'] == 'NUEVO'){
        try{            
            $inv = setInvoiceData('I');
            
            $inv->insert();

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
    elseif (isset ($_POST['invidu']) && $_POST['invidu'] == 'EDITAR') {
        
        try{
            $inv = setInvoiceData('U');

            $inv->update();
            
            echo "<script>alert('El registro se ha editado correctamente.');</script>";
            
            unset ($_SESSION['mode']);
            echo '<script type="text/javascript">window.location="../view/invoicedata.php?update&idinvoice='.$inv->getId().'";</script>';
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
        
    } /* DELETE CURRENT RECORD */
    elseif (isset ($_POST['invidu']) && $_POST['invidu'] == 'ELIMINAR') {                      
        
        try{
            $inv = setInvoiceData('D');

            $inv->delete();

            unset ($_SESSION['mode']);
            echo "<script>window.close();</script>";            
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
    }
    
    /* CHECKS IF THERE IS A FILTER */
    if (isset ($_POST['invfilter'])){        
        $_SESSION['invfilter'] = $_POST['invfilter'];
        echo '<script type="text/javascript">window.location="../view/invoices.php";</script>';
           
    }

    function setInvoiceData($mode){
        
        $date = date('Y-m-d H:i:s');
        $inv = new mdlInvoice();
        
        $inv->setId($_POST['invid']);
        $inv->setIdproject($_POST['invidproject']);
        $inv->setNumber($_POST['invnumber']);
        $inv->setDate($_POST['invdate']);
        $inv->setDateacc($_POST['invdateacc']);
        $inv->setDatedue($_POST['invdatedue']);
        $inv->setDateplanned($_POST['invdateplanned']);        
        $inv->setStatus($_POST['invstatus']);
        $inv->setBase($_POST['invbase']);        
        $inv->setVattype($_POST['invvattype']);
        $inv->setVat($_POST['invvat']);
        $inv->setVattotal($_POST['invvattotal']);
        $inv->setIRPF($_POST['invirpf']);
        $inv->setIRPFTotal($_POST['invirpftotal']);
        $inv->setTotal($_POST['invtotal']);
        $inv->setNotes($_POST['invnotes']);        
        
        if($mode == 'I'){
            $inv->setDateInsert($date);
            $inv->setInsertBy($_SESSION['login']);                
        }
        if ($mode == 'U'){
            $inv->setDateUpdate($date);
            $inv->setUpdateBy($_SESSION['login']);
        }
        
        return $inv;
    }
    
    function selectInvoices($idproject){
        //$inv = new mdlInvoice();
        $invCrud = new dbcrud();    
        $filter = false;
        
         /* Headers */
        echo '<tr>'
                . '<th style="width:220px">Acciones</th><th>Id.</th><th>Número</th><th>Estado</th><th>Fecha</th><th>Fecha Contable</th><th>Fecha Prevista</th><th>Base</th>'
                . '<th>IVA</th><th>Total</th><th>Notas</th>'
           . '</tr>';
        
        if (strlen($idproject) > 0) {
           
            $invSQL = "SELECT * FROM invoices WHERE INVIdProject = " . $idproject;
            $filter = true;
        }
        
        /* Records */
        if ($filter)
        {
            $result = $invCrud->sql($invSQL);

            if ($result->num_rows > 0) {         
              // output data of each row
              //$_SESSION['numentities'] = $result->num_rows;

              while($row = $result->fetch_assoc()) {
 
                echo '<tr><td><a href="invoicedata.php?update&idinvoice='.$row["INVId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" style="margin-left: 5px" data-toggle="tooltip" data-placement="top" title="Editar Factura"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
                        .'<a href="invoicedata.php?delete&idinvoice='.$row["INVId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" style="margin-left: 5px" data-toggle="tooltip" data-placement="top" title="Eliminar Factura"><i class="fa fa-trash" aria-hidden="true"></a></td>'
                        .'<td>'.$row["INVId"].'</td><td>'.$row["INVNumber"].'</td><td>'.$row["INVStatus"].'</td><td>'.$row["INVDate"].'</td><td>'.$row["INVDateAcc"].'</td>'
                        .'<td>'.$row["INVDatePlanned"].'</td><td>'.$row["INVBase"].'</td><td>'.$row["INVVatTotal"].'</td>'
                        .'<td>'.$row["INVTotal"].'</td><td>'.$row["INVNotes"].'</td>'
                       
                    .'</tr>';            
                }         
            }
            else {
                echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>'; 
                
                $_SESSION['numinv'] = 0;
            }
        }
    }
    
 //(:idproject, ':number', ':date', ':dateacc', ':datedue', ':dateplanned', ':status', :base, ':vattype', :vat, ,:vattotal, :total, ':notes', ':dateinsert', ':insertby');";        
    /* ************************************** */    
    
    function selectInvoiceById($id){
        //$inv = new mdlInvoice();
        $invCrud = new dbcrud();
        $invSQL = "SELECT * FROM invoices WHERE INVId = " . $id;          
        $sqlstatus = "SELECT * FROM status WHERE STTTable = 'INVOICES'";
        
        
        if (isset($_REQUEST['idproject'])){
            $idproject = $_REQUEST['idproject'];
        } else {
            $idproject = -1;
        }
        
        /* Record */
        $result = $invCrud->sql($invSQL);

        if ($result->num_rows > 0) {        
          
            while($row = $result->fetch_assoc()) {
            echo  '<tr><td>Id. Factura:</td><td><input type="text" name="invid" readonly="true" value="'.$row["INVId"].'"></td>'
                . '<td>Id. Asunto:</td><td><input type="text" name="invidproject" value="'.$row["INVIdProject"].'"></td></tr>'
                . '<tr><td>Num. Factura:</td><td><input type="text" name="invnumber" value="'.$row["INVNumber"].'"></td>'
                . '<td>Fecha Factura:</td><td><input type="date" name="invdate" value="'.$row["INVDate"].'"></td></tr>'
                . '<tr><td>Fecha Contable:</td><td><input type="date" name="invdateacc" value="'.$row["INVDateAcc"].'"></td>'
                . '<td>Fecha Vencimiento:</td><td><input type="date" name="invdatedue" value="'.$row["INVDateDue"].'"></td></tr>'                    
                
                . '<tr><td>Fecha Planificada:</td><td><input type="date" name="invdateplanned" value="'.$row["INVDatePlanned"].'"></td>'
                . '<td>Estado:</td><td><select style="width: 150px;" name="invstatus" value=""><option value=""></option>';            
                    $rstatus = $invCrud->sql($sqlstatus);  
                    while ($rowst = $rstatus->fetch_assoc()) {
                        echo '<option value="'.$rowst["STTCode"].'"';
                        if ($rowst["STTCode"]==$row["INVStatus"]) {echo ' selected="selected"';}                    
                        echo '>'.$rowst["STTName"].'</option>';
                    }            
            echo  '</select></td></tr>' 
                                    
                . '<tr><td>Base:</td><td><input type="number" name="invbase" value="'.$row["INVBase"].'"></td>'
                . '<td>Tipo IVA:</td><td><input type="text" name="invvattype" value="'.$row["INVVatType"].'"></td></tr>'
                    
                . '<tr><td>IVA %:</td><td><input type="number" name="invvat" value="'.$row["INVVat"].'"></td>'
                . '<td>Total IVA:</td><td><input type="number" name="invvattotal" value="'.$row["INVVatTotal"].'"></td></tr>'                
                  
                . '<tr><td>IRPF %:</td><td><input type="number" name="invirpf" value="'.$row["INVIRPF"].'"></td>'
                . '<td>Total IRPF:</td><td><input type="number" name="invirpftotal" value="'.$row["INVIRPFTotal"].'"></td></tr>'   
                       
                . '<tr><td>Total:</td><td><input type="number" name="invtotal" value="'.$row["INVTotal"].'"></td>'
                . '<td>Notas:</td><td><input type="text" name="invnotes" value="'.$row["INVNotes"].'"></td></tr>' 
                                
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="entdateinsert" readonly="true" value="'.$row["INVDateInsert"].'"></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="entinsertby" readonly="true" value="'.$row["INVInsertBy"].'"></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="entdateupdate" readonly="true" value="'.$row["INVDateUpdate"].'"></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="entupdateby" readonly="true" value="'.$row["INVUpdateBy"].'"></td></tr>';
                
            }
         
        } else {
            echo  '<tr><td>Id. Factura:</td><td><input type="text" name="invid" readonly="true" value=""></td>'
                . '<td>Id. Asunto:</td><td><input type="text" name="invidproject" value="'.$idproject.'"></td></tr>'
                . '<tr><td>Num. Factura:</td><td><input type="text" name="invnumber" value=""></td>'
                . '<td>Fecha Factura:</td><td><input type="date" name="invdate" value=""></td></tr>'
                . '<tr><td>Fecha Contable:</td><td><input type="date" name="invdateacc" value=""></td>'
                . '<td>Fecha Vencimiento:</td><td><input type="date" name="invdatedue" value=""></td></tr>'                    
                
                . '<tr><td>Fecha Planificada:</td><td><input type="date" name="invdateplanned" value=""></td>'
                . '<td>Estado:</td><td><select style="width: 150px;" name="invstatus" value=""><option value=""></option>';            
                    $rstatus = $invCrud->sql($sqlstatus);  
                    while ($rowst = $rstatus->fetch_assoc()) {
                        echo '<option value="'.$rowst["STTCode"].'">';                                           
                        echo $rowst["STTName"].'</option>';
                    }            
            echo  '</select></td></tr>' 
                                    
                . '<tr><td>Base:</td><td><input type="number" name="invbase" value=""></td>'
                . '<td>Tipo IVA:</td><td><input type="text" name="invvattype" value=""></td></tr>'
                    
                . '<tr><td>IVA%:</td><td><input type="number" name="invvat" value=""></td>'
                . '<td>Total IVA:</td><td><input type="number" name="invvattotal" value=""></td></tr>'                
                 
                . '<tr><td>IRPF %:</td><td><input type="number" name="invirpf" value=""></td>'
                . '<td>Total IRPF:</td><td><input type="number" name="invirpftotal" value=""></td></tr>'    
                    
                . '<tr><td>Total:</td><td><input type="number" name="invtotal" value=""></td>'
                . '<td>Notas:</td><td><input type="text" name="invnotes" value=""></td></tr>' 
                                
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="entdateinsert" readonly="true" value=""></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="entinsertby" readonly="true" value=""></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="entdateupdate" readonly="true" value=""></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="entupdateby" readonly="true" value=""></td></tr>';  
        }
         
    }
    
    function showInvoice($id){
        $ent = new mdlEntity();
        $invCrud = new dbcrud();
        $invSQL = "SELECT * FROM invoices WHERE INVId = " . $id;   
        
        /* Record */
        $result = $invCrud->sql($invSQL);

        if ($result->num_rows > 0) {         
          
            while($row = $result->fetch_assoc()) {
            echo  '<tr><td>Id. Factura:</td><td><input type="text" name="invid" readonly="true" value="'.$row["INVId"].'"></td>'
                . '<td>Id. Asunto:</td><td><input type="text" name="invidproject" value="'.$row["INVIdProject"].'"></td></tr>'
                . '<tr><td>Num. Factura:</td><td><input type="text" name="invnumber" value="'.$row["INVNumber"].'"></td>'
                . '<td>Fecha Factura:</td><td><input type="text" name="invdate" value="'.$row["INVdate"].'"></td></tr>'
                . '<tr><td>Fecha Contable:</td><td><input type="text" name="invdateacc" value="'.$row["INVDateAcc"].'"></td>'
                . '<td>Fecha Vencimiento:</td><td><input type="text" name="invdatedue" value="'.$row["INVDateDue"].'"></td></tr>'                    
                
                . '<tr><td>Fecha Planificada:</td><td><input type="text" name="invdateplanned" value="'.$row["INVDatePlanned"].'"></td>'
                . '<tr><td>Estado:</td><td><input type="text" name="invstatus" value="'.$row["INVStatus"].'"></td>'
                                    
                . '<tr><td>Base:</td><td><input type="number" name="invbase" value="'.$row["INVBase"].'"></td>'
                . '<td>Tipo IVA:</td><td><input type="text" name="invvattype" value="'.$row["INVVatType"].'"></td></tr>'
                    
                . '<tr><td>IVA %:</td><td><input type="number" name="invvat" value="'.$row["INVVat"].'"></td>'
                . '<td>Total IVA:</td><td><input type="number" name="invvattotal" value="'.$row["INVVatTotal"].'"></td></tr>'                
                  
                . '<tr><td>IRPF %:</td><td><input type="number" name="invirpf" value="'.$row["INVIRPF"].'"></td>'
                . '<td>Total IRPF:</td><td><input type="number" name="invirpftotal" value="'.$row["INVIRPFTotal"].'"></td></tr>'
                    
                . '<tr><td>Total:</td><td><input type="number" name="invtotal" value="'.$row["INVTotal"].'"></td>'
                . '<td>Notas:</td><td><input type="text" name="invnotes" value="'.$row["INVNotes"].'"></td></tr>' 
                                
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="entdateinsert" readonly="true" value="'.$row["INVDateInsert"].'"></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="entinsertby" readonly="true" value="'.$row["INVInsertBy"].'"></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="entdateupdate" readonly="true" value="'.$row["INVDateUpdate"].'"></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="entupdateby" readonly="true" value="'.$row["INVUpdateBy"].'"></td></tr>';
            }
         
        } else {
           echo  '<tr><td>Id. Factura:</td><td><input type="text" name="invid" readonly="true" value=""></td>'
                . '<td>Id. Asunto:</td><td><input type="text" name="invidproject" value=""></td></tr>'
                . '<tr><td>Num. Factura:</td><td><input type="text" name="invnumber" value=""></td>'
                . '<td>Fecha Factura:</td><td><input type="text" name="invdate" value=""></td></tr>'
                . '<tr><td>Fecha Contable:</td><td><input type="text" name="invdateacc" value=""></td>'
                . '<td>Fecha Vencimiento:</td><td><input type="text" name="invdatedue" value=""></td></tr>'                    
                
                . '<tr><td>Fecha Planificada:</td><td><input type="text" name="invdateplanned" value=""></td>'
                . '<tr><td>Estado:</td><td><input type="text" name="invstatus" value=""></td>'
                                    
                . '<tr><td>Base:</td><td><input type="number" name="invbase" value=""></td>'
                . '<td>Tipo IVA:</td><td><input type="text" name="invvattype" value=""></td></tr>'
                    
                . '<tr><td>IVA %:</td><td><input type="number" name="invvat" value=""></td>'
                . '<td>Total IVA:</td><td><input type="number" name="invvattotal" value=""></td></tr>'                
                
                . '<tr><td>IRPF %:</td><td><input type="number" name="invirpf" value=""></td>'
                . '<td>Total IRPF:</td><td><input type="number" name="invirpftotal" value=""></td></tr>'    
                   
                . '<tr><td>Total:</td><td><input type="number" name="invtotal" value=""></td>'
                . '<td>Notas:</td><td><input type="text" name="invnotes" value=""></td></tr>' 
                                
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="entdateinsert" readonly="true" value=""></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="entinsertby" readonly="true" value=""></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="entdateupdate" readonly="true" value=""></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="entupdateby" readonly="true" value=""></td></tr>';     
        }
         
    }
            
?>