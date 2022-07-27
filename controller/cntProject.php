<?php 
    session_start();
    include_once '../model/mdlProject.php';
    include_once '../model/mdlEntity.php';
    include_once '../model/dbcrud.php';
    
    /* INSERT NEW RECORD */    
    if (isset ($_POST['prjidu']) && $_POST['prjidu'] == 'NUEVO'){
        try{
           
            $prj = setData('I');
            
            $prj->insert();

            echo "<script>alert('El registro se ha creado correctamente.');</script>"; 
            
            /*TODO: To get the Id. of the new record.*/
            unset ($_SESSION['prjmode']);        
            echo "<script>window.close();</script>";            
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
        
       
    } /* UPDATE CURRENT RECORD */   
    elseif (isset ($_POST['prjidu']) && $_POST['prjidu'] == 'EDITAR') {
        
        try{
            $prj = setData('U');

            $prj->update();
            
            echo "<script>alert('El registro se ha editado correctamente.');</script>";
            
            unset ($_SESSION['prjmode']);
            echo '<script type="text/javascript">window.location="../view/projectdata.php?update&idproject='.$prj->getId().'";</script>';
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
        
    } /* DELETE CURRENT RECORD */
    elseif (isset ($_POST['prjidu']) && $_POST['prjidu'] == 'ELIMINAR') {                      
        
        try{
            $prj = setData('D');

            $prj->delete();

            unset ($_SESSION['prjmode']);
            echo "<script>window.close();</script>";            
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
    }
    
     /* CHECKS IF THERE IS A FILTER */
    if (isset ($_POST['prjfilter'])){        
        $_SESSION['prjfilter'] = $_POST['prjfilter'];
        echo '<script type="text/javascript">window.location="../view/projects.php";</script>';           
    }
    
    if (isset ($_POST['entprjfilter'])){        
        $_SESSION['entprjfilter'] = $_POST['entprjfilter'];        
        echo '<script type="text/javascript">window.location="../view/projects.php";</script>';           
    }
    
    function setData($mode){
        
        $date = date('Y-m-d H:i:s');
        $prj = new mdlProject();
        
        $prj->setId($_POST['prjid']);
        $prj->setIdentity($_POST['prjidentity']);
        $prj->setIdemployee($_POST['prjidemployee']);        
        $prj->setType($_POST['prjtype']);
        $prj->setStatus($_POST['prjstatus']);        
        $prj->setName($_POST['prjname']);
        $prj->setDescription($_POST['prjdescription']);        
        $prj->setDatestart($_POST['prjdatestart']);
        $prj->setDateend($_POST['prjdateend']);        
        $prj->setDatestartpln($_POST['prjdatestartpln']);
        $prj->setDateendpln($_POST['prjdateendpln']);        
        $prj->setBudget($_POST['prjbudget']);
        $prj->setBudgetreal($_POST['prjbudgetreal']);        
        $prj->setCost($_POST['prjcost']);
        $prj->setCostreal($_POST['prjcostreal']);
        $prj->setNotes($_POST['prjnotes']);
        
        if($mode == 'I'){
            $prj->setDateInsert($date);
            $prj->setInsertBy($_SESSION['login']);                
        }
        if ($mode == 'U'){
            $prj->setDateUpdate($date);
            $prj->setUpdateBy($_SESSION['login']);
        }
        
        return $prj;
    }
    
    function selectEntities($entfilter){
        //$ent = new mdlEntity();
        $prjCrud = new dbcrud();
        $filter = false;
        
         /* Headers */
        echo '<tr>'
                . '<th style="width:240px">Seleccionar</th><th>Id.</th><th>Estado</th><th>Nombre</th><th>Apellidos</th><th>Empresa</th><th>NIF</th>'
           . '</tr>';
        
        if (strlen($entfilter) > 0) {
           
            $prjSQL = "SELECT * FROM entities WHERE ENTStatus LIKE 'ACT%' AND (ENTName LIKE '%:filter%' OR ENTLastName LIKE '%:filter%' OR ENTCompany LIKE '%:filter%' OR ENTFiscalId LIKE '%:filter%')";
            
            $prjSQL = str_replace(':filter', $entfilter, $prjSQL);
            
            $filter = true;
        }
        
        /* Records */
        if ($filter)
        {
            $result = $prjCrud->sql($prjSQL);

            if ($result->num_rows > 0) {         
              // output data of each row
              //$_SESSION['numentities'] = $result->num_rows;

              while($row = $result->fetch_assoc()) {
               echo '<tr><td><a href="projects.php?entid='.$row["ENTId"].'" class="btn btn-dark btn-sm" role="button" style="margin-left: 2px" data-toggle="tooltip" data-placement="top" title="Ver datos del cliente"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                        .'<a href="entitydata.php?update&identity='.$row["ENTId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" style="margin-left: 2px" data-toggle="tooltip" data-placement="top" title="Editar Cliente"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
                        . '<a href="docs.php?obj=ENTITIES&objid='.$row["ENTId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" style="margin-left: 2px" data-toggle="tooltip" data-placement="top" title="Documentos del Cliente"><i class="fa fa-file" aria-hidden="true"></i></a></td>'
                        . '<td>'.$row["ENTId"].'</td><td>'.$row["ENTStatus"].'</td><td>'.$row["ENTName"].'</td><td>'
                        .$row["ENTLastName"].'</td><td>'.$row["ENTCompany"].'</td><td>'.$row["ENTFiscalId"].'</td>'
                       
                    .'</tr>';            
                }         
            }
            else {
                echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>'; 
                
                $_SESSION['numentities'] = 0;
            }
        }
    }
    
    function selectedEntityById($idEnt){
        
        //$prj = new mdlEntity();
        $prjCrud = new dbcrud();
        $prjSQL = "SELECT * FROM entities WHERE ENTId = " . $idEnt;  
        $sqltypes = "SELECT * FROM types WHERE TYPTable = 'ENTITIES'";
        $sqlstatus = "SELECT * FROM status WHERE STTTable = 'ENTITIES'";
                
        /* Record */
        $result = $prjCrud->sql($prjSQL);

        if ($result->num_rows > 0) {
          
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
        
    function selectProjects($identity){
        //$ent = new mdlEntity();
        $prjCrud = new dbcrud();
        $filter = false;
        
         /* Headers */
        echo '<tr>'
                . '<th style="width:260px">Seleccionar</th><th>Id.</th><th>Tipo</th><th>Estado</th><th>Nombre</th><th>Descripción</th><th>Fecha Inicio</th><th>Presupuesto</th>'
           . '</tr>';
               
        /* Records */
        if ($identity > 0)
        {
            $prjSQL = "SELECT * FROM projects WHERE PRJIdEntity = " .$identity;
            
            $result = $prjCrud->sql($prjSQL);

            if ($result->num_rows > 0) {         
              // output data of each row
              $_SESSION['numentities'] = $result->num_rows;

              while($row = $result->fetch_assoc()) {
               echo '<tr><td><a href="projectdata.php?update&idproject='.$row["PRJId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="Editar Asunto"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
                        .'<a href="projectdata.php?delete&idproject='.$row["PRJId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" style="margin-left: 2px" data-toggle="tooltip" data-placement="top" title="Eliminar Asunto"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                        .'<a href="docs.php?obj=PROJECTS&objid='.$row["PRJId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" style="margin-left: 2px" data-toggle="tooltip" data-placement="top" title="Documentos del Asunto"><i class="fa fa-file" aria-hidden="true"></i></a>'
                        .'<a href="tasks.php?idproject='.$row["PRJId"].'" class="btn btn-dark btn-sm" role="button" style="margin-left: 2px" data-toggle="tooltip" data-placement="top" title="Tareas del Asunto"><i class="fa fa-tasks" aria-hidden="true"></i></a></td>'
                        . '<td>'.$row["PRJId"].'</td><td>'.$row["PRJType"].'</td><td>'.$row["PRJStatus"].'</td><td>'
                        .$row["PRJName"].'</td><td>'.$row["PRJDescription"].'</td><td>'.$row["PRJDateStart"].'</td><td>'.$row["PRJBudget"].'</td>'
                        
                    .'</tr>';            
                }         
            }
            else {
                echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>'; 
                
                $_SESSION['numentities'] = 0;
            }
        }
    }
    
    
    function selectedProjectById($idprj){
        //$prj = new mdlProject();
        $prjCrud = new dbcrud();
        $prjSQL = "SELECT * FROM projects WHERE PRJId = " . $idprj;  
        $sqltypes = "SELECT * FROM types WHERE TYPTable = 'PROJECTS'";
        $sqlstatus = "SELECT * FROM status WHERE STTTable = 'PROJECTS'";
        $sqlemployees = "SELECT * FROM employees";
        
        /* Record */
        $result = $prjCrud->sql($prjSQL);

        if ($result->num_rows > 0) {
          //  while ($cols = $result->num_cols )
          //echo '<tr><th>ID</th><th>Name</th></tr>';
          // output data of each row
          
            while($row = $result->fetch_assoc()) {
            echo  '<tr><td>Id. Asunto:</td><td><input type="text" name="prjid" readonly="true" value="'.$row["PRJId"].'"></td>'
                . '<td>Tipo:</td><td><select style="width: 150px;" name="prjtype" value=""><option value=""></option>';            
                $rtypes = $prjCrud->sql($sqltypes);  
                while ($rowtype = $rtypes->fetch_assoc()) {
                    echo '<option value="'.$rowtype["TYPCode"].'"';
                    if ($rowtype["TYPCode"]==$row["PRJType"]) {echo ' selected="selected"';}                    
                    echo '>'.$rowtype["TYPName"].'</option>';
                }            
            echo  '</select></td></tr>'
                
                . '<tr><td>Estado:</td><td><select style="width: 150px;" name="prjstatus" value=""><option value=""></option>';            
                $rstatus = $prjCrud->sql($sqlstatus);  
                while ($rowst = $rstatus->fetch_assoc()) {
                    echo '<option value="'.$rowst["STTCode"].'"';
                    if ($rowst["STTCode"]==$row["PRJStatus"]) {echo ' selected="selected"';}                    
                    echo '>'.$rowst["STTName"].'</option>';
                }            
            echo  '</select></td>' 
                
                . '<td>Cliente:</td><td><input type="text" name="prjidentity" value="'.$row["PRJIdEntity"].'"></td></tr>'
                    
                 . '<tr><td>Responsable:</td><td><select style="width: 150px;" name="prjidemployee" value=""><option value=""></option>';            
                $rsemps = $prjCrud->sql($sqlemployees);  
                while ($rowemp = $rsemps->fetch_assoc()) {
                    echo '<option value="'.$rowemp["EMPId"].'"';
                    if ($rowemp["EMPId"]==$row["PRJIdEmployee"]) {echo ' selected="selected"';}                    
                    echo '>'.$rowemp["EMPName"].', '.$rowemp["EMPLastName"].'</option>';
                }            
                echo  '</select></td>' 
                    
                . '<td></td><td></td></tr>'
                    
                . '<tr><td>Nombre:</td><td><input type="text" name="prjname" value="'.$row["PRJName"].'"></td>'
                . '<td>Descripción:</td><td><input type="text" name="prjdescription" value="'.$row["PRJDescription"].'"></td></tr>'
                    
                . '<tr><td>Incio:</td><td><input type="date" name="prjdatestart" value="'.$row["PRJDateStart"].'"></td>'
                . '<td>Fin:</td><td><input type="date" name="prjdateend" value="'.$row["PRJDateEnd"].'"></td></tr>'
                    
                . '<tr><td>Inicio Planificado:</td><td><input type="date" name="prjdatestartpln" value="'.$row["PRJDateStartPln"].'"></td>'
                . '<td>Fin Planificado:</td><td><input type="date" name="prjdateendpln" value="'.$row["PRJDateEndPln"].'"></td></tr>'                
                  
                . '<tr><td>Importe:</td><td><input type="number" name="prjbudget" value="'.$row["PRJBudget"].'"></td>'
                . '<td>Importe Real:</td><td><input type="number" name="prjbudgetreal" value="'.$row["PRJBudgetReal"].'"></td></tr>'
                    
                . '<tr><td>Coste:</td><td><input type="number" name="prjcost" value="'.$row["PRJCost"].'"></td>'
                . '<td>Coste Real:</td><td><input type="number" name="prjcostreal" value="'.$row["PRJCostReal"].'"></td></tr>'
                    
                . '<tr><td>Notas:</td><td><input type="text" name="prjnotes" value="'.$row["PRJNotes"].'"></td>'
                . '<td></td><td></td></tr>'
                
                                
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="prjdateinsert" readonly="true" value="'.$row["PRJDateInsert"].'"></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="prjinsertby" readonly="true" value="'.$row["PRJInsertBy"].'"></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="prjdateupdate" readonly="true" value="'.$row["PRJDateUpdate"].'"></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="prjupdateby" readonly="true" value="'.$row["PRJUpdateBy"].'"></td></tr>';                
            } 
        } else {
                echo  '<tr><td>Id. Asunto:</td><td><input type="text" name="prjid" readonly="true" value=""></td>'
                . '<td>Tipo:</td><td><select style="width: 150px;" name="prjtype" value=""><option value=""></option>';            
                $rtypes = $prjCrud->sql($sqltypes);  
                while ($rowtype = $rtypes->fetch_assoc()) {
                    echo '<option value="'.$rowtype["TYPCode"].'">'.$rowtype["TYPName"].'</option>';
                }            
            echo  '</select></td></tr>'
                
                . '<tr><td>Estado:</td><td><select style="width: 150px;" name="prjstatus" value=""><option value=""></option>';            
                $rstatus = $prjCrud->sql($sqlstatus);  
                while ($rowst = $rstatus->fetch_assoc()) {
                    echo '<option value="'.$rowst["STTCode"].'">'.$rowst["STTName"].'</option>';
                }            
            echo  '</select></td>' 
                
                . '<td>Cliente:</td><td><input type="text" name="prjidentity" value="'; 
                    if (isset($_REQUEST['identity'])){
                        echo $_REQUEST['identity'];
                    }    
            echo  '"></td></tr>'
                    
                . '<tr><td>Responsable:</td><td><select style="width: 150px;" name="prjidemployee" value=""><option value=""></option>';            
                $rsemps = $prjCrud->sql($sqlemployees);  
                while ($rowemp = $rsemps->fetch_assoc()) {
                    echo '<option value="'.$rowemp["EMPId"].'">'.$rowemp["EMPName"].', '.$rowemp["EMPLastName"].'</option>';
                }            
                echo  '</select></td>' 
                . '<td></td><td></td></tr>'
                    
                . '<tr><td>Nombre:</td><td><input type="text" name="prjname" value=""></td>'
                . '<td>Descripción:</td><td><input type="text" name="prjdescription" value=""></td></tr>'
                    
                . '<tr><td>Incio:</td><td><input type="date" name="prjdatestart" value=""></td>'
                . '<td>Fin:</td><td><input type="date" name="prjdateend" value=""></td></tr>'
                    
                . '<tr><td>Inicio Planificado:</td><td><input type="date" name="prjdatestartpln" value=""></td>'
                . '<td>Fin Planificado:</td><td><input type="date" name="prjdateendpln" value=""></td></tr>'                
                  
                . '<tr><td>Importe:</td><td><input type="number" name="prjbudget" value=""></td>'
                . '<td>Importe Real:</td><td><input type="number" name="prjbudgetreal" value=""></td></tr>'
                    
                . '<tr><td>Coste:</td><td><input type="number" name="prjcost" value=""></td>'
                . '<td>Coste Real:</td><td><input type="number" name="prjcostreal" value=""></td></tr>'
                    
                . '<tr><td>Notas:</td><td><input type="text" name="prjnotes" value=""></td>'
                . '<td></td><td></td></tr>'
                
                                
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="prjdateinsert" readonly="true" value=""></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="prjinsertby" readonly="true" value=""></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="prjdateupdate" readonly="true" value=""></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="prjupdateby" readonly="true" value=""></td></tr>';
        }          
    }
    
    /* IN PROGRESS */
    /*
    function showEntity($idEnt){
        $prj = new mdlEntity();
        $prjCrud = new dbcrud();
        $prjSQL = "SELECT * FROM entities WHERE ENTId = " . $idEnt;   
        
        // Record
        $result = $prjCrud->sql($prjSQL);

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
    */        
?>