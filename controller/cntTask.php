<?php 
    session_start();
    include_once '../model/mdlTask.php';
    include_once '../model/mdlProject.php';
    include_once '../model/mdlEntity.php';
    include_once '../model/dbcrud.php';
    
    /* INSERT NEW RECORD */    
    if (isset ($_POST['tskidu']) && $_POST['tskidu'] == 'NUEVO'){
        try{
           
            $tsk = setData('I');
            
            $tsk->insert();

            echo "<script>alert('El registro se ha creado correctamente.');</script>"; 
            
            /*TODO: To get the Id. of the new record.*/
    
            echo "<script>window.close();</script>";            
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
        
       
    } /* UPDATE CURRENT RECORD */   
    elseif (isset ($_POST['tskidu']) && $_POST['tskidu'] == 'EDITAR') {
        
        try{
            $tsk = setData('U');

            $tsk->update();
            
            echo "<script>alert('El registro se ha editado correctamente.');</script>";
            
            //unset ($_SESSION['tskmode']);
            echo '<script type="text/javascript">window.location="../view/taskdata.php?update&idtask='.$tsk->getId().'";</script>';
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
        
    } /* DELETE CURRENT RECORD */
    elseif (isset ($_POST['tskidu']) && $_POST['tskidu'] == 'ELIMINAR') {                      
        
        try{
            $tsk = setData('D');

            $tsk->delete();

            //unset ($_SESSION['tskmode']);
            echo "<script>window.close();</script>";            
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
    }
    
     /* CHECKS IF THERE IS A FILTER */
    if (isset ($_POST['tskprjfilter'])){        
        $_SESSION['tskprjfilter'] = $_POST['tskprjfilter'];
        echo '<script type="text/javascript">window.location="../view/tasks.php";</script>';           
    }
    
    if (isset ($_POST['tskentprjfilter'])){        
        $_SESSION['tskentprjfilter'] = $_POST['tskentprjfilter'];        
        echo '<script type="text/javascript">window.location="../view/tasks.php";</script>';           
    }    
    
    function setData($mode){
        
        $date = date('Y-m-d H:i:s');
        $tsk = new mdlTask();
        
        $tsk->setId($_POST['tskid']);
        $tsk->setIdproject($_POST['tskidproject']);
        $tsk->setIdemployee($_POST['tskidemployee']); 
        $tsk->setIdentity($_POST['tskidentity']);
        $tsk->setStatus($_POST['tskstatus']);        
        $tsk->setName($_POST['tskname']);
        $tsk->setDescription($_POST['tskdescription']);        
        $tsk->setDatestart($_POST['tskdatestart']);
        $tsk->setDateend($_POST['tskdateend']); 
        $tsk->setPercentagedone($_POST['tskpercentagedone']);
        $tsk->setToinvoice($_POST['tsktoinvoice']);        
        $tsk->setInvoice($_POST['tskinvoice']);
        $tsk->setTimeplanned($_POST['tsktimeplanned']);        
        $tsk->setTime($_POST['tsktime']);
        $tsk->setHourrate($_POST['tskhourrate']);        
        $tsk->setTotal($_POST['tsktotal']);
        $tsk->setTotalcost($_POST['tsktotalcost']);
        $tsk->setNotes($_POST['tsknotes']);
        
        if($mode == 'I'){
            $tsk->setDateInsert($date);
            $tsk->setInsertBy($_SESSION['login']);                
        }
        if ($mode == 'U'){
            $tsk->setDateUpdate($date);
            $tsk->setUpdateBy($_SESSION['login']);
        }
        
        return $tsk;
    }
    
    function selectTasks($idproject){
        //$ent = new mdlEntity();
        $prjCrud = new dbcrud();
        $filter = false;
        
         /* Headers */
        echo '<tr>'
                . '<th style="width:220px">Acciones</th><th>Id.</th><th>Asignado a</th><th>Estado</th><th>Nombre</th><th>Descripción</th><th>Inicio</th><th>Fin</th><th>Progreso</th>'
                . '<th>Facturar</th><th>Factura</th><th>Tarifa Hora</th><th>Horas Previstas</th><th>Total Coste</th><th>Horas</th><th>Total</th><th>Notas</th>'
           . '</tr>';
        
        if (strlen($idproject) > 0) {
           
            $tskSQL = "SELECT * FROM tasks WHERE TSKIdProject = " . $idproject;
            $filter = true;
        }
        
        /* Records */
        if ($filter)
        {
            $result = $prjCrud->sql($tskSQL);

            if ($result->num_rows > 0) {         
              // output data of each row
              //$_SESSION['numentities'] = $result->num_rows;

              while($row = $result->fetch_assoc()) {
               
                if ($row["TSKToInvoice"] == null || $row["TSKToInvoice"] == 0){
                    $toinvoice = "unchecked";
                }else {
                    $toinvoice = "checked";
                }
                  
                echo '<tr><td><a href="taskdata.php?update&idtask='.$row["TSKId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" style="margin-left: 5px" data-toggle="tooltip" data-placement="top" title="Editar Tarea"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
                        .'<a href="taskdata.php?delete&idtask='.$row["TSKId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" style="margin-left: 5px" data-toggle="tooltip" data-placement="top" title="Eliminar Tarea"><i class="fa fa-trash" aria-hidden="true"></a></td>'
                        .'<td>'.$row["TSKId"].'</td><td>'.$row["TSKIdEmployee"].'</td><td>'.$row["TSKStatus"].'</td><td>'.$row["TSKName"].'</td><td>'.$row["TSKDescription"].'</td>'
                        .'<td>'.$row["TSKDateStart"].'</td><td>'.$row["TSKDateEnd"].'</td><td>'.$row["TSKPercentageDone"].'</td><td><input type="checkbox" name="tsktoinvoice" onclick="return false" value="1" '.$toinvoice.'></td>'
                        .'<td>'.$row["TSKInvoice"].'</td><td>'.$row["TSKHourRate"].'</td><td>'.$row["TSKTimePlanned"].'</td><td>'.$row["TSKTotalCost"].'</td><td>'.$row["TSKTime"].'</td>'
                        .'<td>'.$row["TSKTotal"].'</td><td>'.$row["TSKNotes"].'</td>'
                       
                    .'</tr>';            
                }         
            }
            else {
                echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>'; 
                
                $_SESSION['numtasks'] = 0;
            }
        }
    }
    
    function selectedTaskById($idtask){
        //$prj = new mdlProject();
        $prjCrud = new dbcrud();
        $sqltask = "SELECT * FROM tasks WHERE TSKId = " . $idtask;
        $sqltypes = "SELECT * FROM types WHERE TYPTable = 'PROJECTS'";
        $sqlstatus = "SELECT * FROM status WHERE STTTable = 'TASKS'";
        $sqlemployees = "SELECT * FROM employees";
        
        if (isset($_REQUEST['idproject'])){
            $idproject = $_REQUEST['idproject'];
        } else {
            $idproject = -1;
        }
        
        $sqlproject = "SELECT * FROM projects WHERE PRJId = " . $idproject;  
                
        /* Get info about the Project */
        $rsproject = $prjCrud->sql($sqlproject);  
        while ($rowprj = $rsproject->fetch_assoc()) {           
            $identity = $rowprj["PRJIdEntity"];
        }        
        
        /* Record */
        $result = $prjCrud->sql($sqltask);

        if ($result->num_rows > 0) {
          //  while ($cols = $result->num_cols )
          //echo '<tr><th>ID</th><th>Name</th></tr>';
          // output data of each row
          
            while($row = $result->fetch_assoc()) {
                
                if ($row["TSKToInvoice"] == null || $row["TSKToInvoice"] == 0){
                    $toinvoice = "unchecked";
                }else {
                    $toinvoice = "checked";
                }
                
            echo  '<tr><td>Id. Tarea:</td><td><input type="text" name="tskid" readonly="true" value="'.$row["TSKId"].'"></td>'
                . '<td>Asunto:</td><td><input type="text" name="tskidproject" value="'.$row["TSKIdProject"].'"></td></tr>'
                                
                . '<tr><td>Responsable:</td><td><select style="width: 150px;" name="tskidemployee" value=""><option value=""></option>';            
                $rsemps = $prjCrud->sql($sqlemployees);  
                while ($rowemp = $rsemps->fetch_assoc()) {
                    echo '<option value="'.$rowemp["EMPId"].'"';
                    if ($rowemp["EMPId"]==$row["TSKIdEmployee"]) {echo ' selected="selected"';}                    
                    echo '>'.$rowemp["EMPName"].', '.$rowemp["EMPLastName"].'</option>';
                }            
                echo  '</select></td>' 
                . '<td>Cliente:</td><td><input type="text" name="tskidentity" value="'.$row["TSKIdEntity"].'"></td></tr>'    
                                                
                . '<tr><td>Estado:</td><td><select style="width: 150px;" name="tskstatus" value=""><option value=""></option>';            
                $rstatus = $prjCrud->sql($sqlstatus);  
                while ($rowst = $rstatus->fetch_assoc()) {
                    echo '<option value="'.$rowst["STTCode"].'"';
                    if ($rowst["STTCode"]==$row["TSKStatus"]) {echo ' selected="selected"';}                    
                    echo '>'.$rowst["STTName"].'</option>';
                }            
            echo  '</select></td>'                
                . '<td>Nombre:</td><td><input type="text" name="tskname" value="'.$row["TSKName"].'"></td></tr>'

                . '<tr><td>Descripción:</td><td><input type="text" name="tskdescription" value="'.$row["TSKDescription"].'"></td>'
                . '<td>Incio:</td><td><input type="datetime-local" name="tskdatestart" value="'. date('Y-m-d\TH:i', strtotime($row["TSKDateStart"])).'"></td></tr>'
                    
                . '<tr><td>Fin:</td><td><input type="datetime-local" name="tskdateend" value="'. date('Y-m-d\TH:i', strtotime($row["TSKDateEnd"])).'"></td>'
                . '<td>Progreso:</td><td><input type="number" name="tskpercentagedone" value="'.$row["TSKPercentageDone"].'"></td></tr>'
                    
                . '<tr><td>Facturar:</td><td><input type="checkbox" name="tsktoinvoice" value="1" '.$toinvoice.'></td>'
                . '<td>Factura:</td><td><input type="text" name="tskinvoice" value="'.$row["TSKInvoice"].'"></td></tr>'                
                  
                . '<tr><td>Tarifa Hora:</td><td><input type="number" name="tskhourrate" value="'.$row["TSKHourRate"].'"></td>'
                . '<td>Horas Previstas:</td><td><input type="number" name="tsktimeplanned" value="'.$row["TSKTimePlanned"].'"></td></tr>'
                    
                . '<tr><td>Total Coste:</td><td><input type="number" name="tsktotalcost" value="'.$row["TSKTotalCost"].'"></td>'
                . '<td>Horas:</td><td><input type="number" name="tsktime" value="'.$row["TSKTime"].'"></td></tr>'
                
                . '<tr><td>Total:</td><td><input type="number" name="tsktotal" value="'.$row["TSKTotal"].'"></td>'
                . '<td>Notas:</td><td><input type="text" name="tsknotes" value="'.$row["PRJNotes"].'"></td></tr>'
                                
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="tskdateinsert" readonly="true" value="'.$row["TSKDateInsert"].'"></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="tskinsertby" readonly="true" value="'.$row["TSKInsertBy"].'"></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="tskdateupdate" readonly="true" value="'.$row["TSKDateUpdate"].'"></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="tskupdateby" readonly="true" value="'.$row["TSKUpdateBy"].'"></td></tr>';                
            } 
        } else {
                echo  '<tr><td>Id. Tarea:</td><td><input type="text" name="tskid" readonly="true" value=""></td>'
                . '<td>Asunto:</td><td><input type="text" name="tskidproject" readonly="true" value="'.$idproject.'"></td></tr>'
                                
                . '<tr><td>Responsable:</td><td><select style="width: 150px;" name="tskidemployee" value=""><option value=""></option>';            
                $rsemps = $prjCrud->sql($sqlemployees);  
                while ($rowemp = $rsemps->fetch_assoc()) {
                    echo '<option value="'.$rowemp["EMPId"].'">'.$rowemp["EMPName"].', '.$rowemp["EMPLastName"].'</option>';
                }            
                echo  '</select></td>'       
                . '<td>Cliente:</td><td><input type="text" name="tskidentity" readonly="true" value="'.$identity.'"></td></tr>'    
                                                
                . '<tr><td>Estado:</td><td><select style="width: 150px;" name="tskstatus" value=""><option value=""></option>';            
                $rstatus = $prjCrud->sql($sqlstatus);  
                while ($rowst = $rstatus->fetch_assoc()) {
                    echo '<option value="'.$rowst["STTCode"].'">'.$rowst["STTName"].'</option>';
                }            
            echo  '</select></td>'                
                . '<td>Nombre:</td><td><input type="text" name="tskname" value=""></td></tr>'

                . '<tr><td>Descripción:</td><td><input type="text" name="tskdescription" value=""></td>'
                . '<td>Incio:</td><td><input type="datetime-local" name="tskdatestart" value=""></td></tr>'
                    
                . '<tr><td>Fin:</td><td><input type="datetime-local" name="tskdateend" value=""></td>'
                . '<td>Progreso:</td><td><input type="number" name="tskpercentagedone" value=""></td></tr>'
                    
                . '<tr><td>Facturar:</td><td><input type="checkbox" name="tsktoinvoice" value="0"></td>'
                . '<td>Factura:</td><td><input type="text" name="tskinvoice" value=""></td></tr>'                
                  
                . '<tr><td>Tarifa Hora:</td><td><input type="number" name="tskhourrate" value=""></td>'
                . '<td>Horas Previstas:</td><td><input type="number" name="tsktimeplanned" value=""></td></tr>'
                    
                . '<tr><td>Total Coste:</td><td><input type="number" name="tsktotalcost" value=""></td>'
                . '<td>Horas:</td><td><input type="number" name="tsktime" value=""></td></tr>'
                
                . '<tr><td>Total:</td><td><input type="number" name="tsktotal" value=""></td>'
                . '<td>Notas:</td><td><input type="text" name="tsknotes" value=""></td></tr>'
                                
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="tskdateinsert" readonly="true" value=""></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="tskinsertby" readonly="true" value=""></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="tskdateupdate" readonly="true" value=""></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="tskupdateby" readonly="true" value=""></td></tr>';
          
        }          
    }
    
    function getIdEntity($idprj){
        $prjCrud = new dbcrud();
        $prjSQL = "SELECT * FROM projects WHERE PRJId = " . $idprj;         
        
        /* Record */
        $result = $prjCrud->sql($prjSQL);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {  
                $idclient = $row["PRJIdEntity"];
            }
        }
        else{
            $idlcient = -1;
        }
        
        return $idclient;
    }
    
    
    function selectedEntityById($idEnt){
        //$prj = new mdlProject();
        $prjCrud = new dbcrud();
        $prjSQL = "SELECT * FROM entities WHERE ENTId = " . $idEnt;  
        $sqltypes = "SELECT * FROM types WHERE TYPTable = 'ENTITIES'";
        $sqlstatus = "SELECT * FROM status WHERE STTTable = 'ENTITIES'";
        
        /* Record */
        $result = $prjCrud->sql($prjSQL);

        if ($result->num_rows > 0) {
          //  while ($cols = $result->num_cols )
          //echo '<tr><th>ID</th><th>Name</th></tr>';
          // output data of each row
          
            while($row = $result->fetch_assoc()) {  
            echo  '<tr>'
                . '<td><b>Id. Cliente:</b></td><td>'.$row["ENTId"].'</td>'
                . '<td><b>Tipo:</b></td><td>'.$row["ENTType"].'</td>'
                . '<td><b>Estado:</b></td><td>'.$row["ENTStatus"].'</td>'
                . '</tr>'
                . '<tr>'
                . '<td><b>Nombre:</b></td><td>'.$row["ENTName"].'</td>'
                . '<td><b>Apellidos:</b></td><td>'.$row["ENTLastName"].'</td>'
                . '<td><b>Empresa:</b></td><td>'.$row["ENTCompany"].'</td>'
                . '</tr>'                 
                . '<tr>'
                . '<td><b>NIF:</b></td><td>'.$row["ENTFiscalId"].'</td>'
                . '<td><b>Dirección:</b></td><td>'.$row["ENTAddress"].'</td>'
                . '<td><b>Ciudad:</b></td><td>'.$row["ENTCity"].'</td>'
                . '</tr>' 
                . '<tr>'
                . '<td><b>C. Postal:</b></td><td>'.$row["ENTPostalCode"].'</td>'
                . '<td><b>País:</b></td><td>'.$row["ENTCountry"].'</td>'
                . '<td><b>Teléfono:</b></td><td>'.$row["ENTPhone"].'</td>'
                . '</tr>' 
                . '<tr>'
                . '<td><b>Móvil:</b></td><td>'.$row["ENTMobile"].'</td>'
                . '<td><b>Notes:</b></td><td colspan="3">'.$row["ENTNotes"].'</td>'               
                . '</tr>';    
            } 
        }
    }
    
    function selectedProjectById($idprj){
        //$prj = new mdlProject();
        $prjCrud = new dbcrud();
        $prjSQL = "SELECT * FROM projects WHERE PRJId = " . $idprj;  
        $sqltypes = "SELECT * FROM types WHERE TYPTable = 'PROJECTS'";
        $sqlstatus = "SELECT * FROM status WHERE STTTable = 'PROJECTS'";
        
        /* Record */
        $result = $prjCrud->sql($prjSQL);

        if ($result->num_rows > 0) {
          //  while ($cols = $result->num_cols )
          //echo '<tr><th>ID</th><th>Name</th></tr>';
          // output data of each row
          
            while($row = $result->fetch_assoc()) {  
            echo  '<tr>'
                . '<td><b>Nombre:</b></td><td>'.$row["PRJName"].'</td>'
                . '<td><b>Descripción:</b></td><td colspan="3">'.$row["PRJDescription"].'</td>'               
                . '</tr>'                 
                . '<tr>'
                . '<td><b>Id. Asunto:</b></td><td>'.$row["PRJId"].'</td>'
                . '<td><b>Tipo:</b></td><td>'.$row["PRJType"].'</td>'
                . '<td><b>Estado:</b></td><td>'.$row["PRJStatus"].'</td>'
                . '</tr>'
                . '<tr>'
                . '<td><b>Inicio:</b></td><td>'.$row["PRJDateStart"].'</td>'
                . '<td><b>Fin:</b></td><td>'.$row["PRJDateEnd"].'</td>'
                . '<td><b>Inicio Planificado:</b></td><td>'.$row["PRJDateStartPln"].'</td>'
                . '</tr>' 
                . '<tr>'
                . '<td><b>Fin Planificado:</b></td><td>'.$row["PRJDateEndPln"].'</td>'
                . '<td><b>Importe:</b></td><td>'.$row["PRJBudget"].'</td>'
                . '<td><b>Importe Real:</b></td><td>'.$row["PRJBudgetReal"].'</td>'
                . '</tr>'  
                . '<tr>'
                . '<td><b>Coste:</b></td><td>'.$row["PRJCost"].'</td>'
                . '<td><b>Coste Real:</b></td><td>'.$row["PRJCostReal"].'</td>'
                . '<td><b>Notas:</b></td><td>'.$row["PRJNotes"].'</td>'
                . '</tr>';    
            } 
        }
    }
    
    
    
   
?>