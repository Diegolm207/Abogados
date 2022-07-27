<?php 
    session_start();
    include_once '../model/mdlEmployee.php';
    include_once '../model/dbcrud.php';
    
    /* INSERT NEW RECORD */    
    if (isset ($_POST['empidu']) && $_POST['empidu'] == 'NUEVO'){
        
        try{
            
            $emp = setData('I');

            $emp->insert();

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
    elseif (isset ($_POST['empidu']) && $_POST['empidu'] == 'EDITAR') {
        
        try{
        
            $emp = setData('U');
           
            $emp->update();
            
            echo "<script>alert('El registro se ha editado correctamente.');</script>";
            
            unset ($_SESSION['mode']);
            echo '<script type="text/javascript">window.location="../view/employeedata.php?empupdate&empid='.$emp->getId().'";</script>';                        
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
        
    } /* DELETE CURRENT RECORD */
    elseif (isset ($_POST['empidu']) && $_POST['empidu'] == 'ELIMINAR') {                      
        
        try{
            $emp = setData('D');
            
            $emp->delete();

            unset ($_SESSION['mode']);
            echo "<script>window.close();</script>";           
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
    }
    
    /* CHECKS IF THERE IS A FILTER */
    if (isset ($_POST['empfilter'])){        
        $_SESSION['empfilter'] = $_POST['empfilter'];
        echo '<script type="text/javascript">window.location="../view/employees.php";</script>';            
    }
    
    /* GEST DATA FROM FIELDS INTO THE OBJET */
    function setData($mode){
        
        $date = date('Y-m-d H:i:s');
        $emp = new mdlEmployee();
        
        $emp->setId($_POST['empid']);
        $emp->setNatid($_POST['empnatid']);
        $emp->setUsrid($_POST['empusrid']);
        $emp->setType($_POST['emptype']);
        $emp->setName($_POST['empname']);
        $emp->setLastname($_POST['emplastname']);
        $emp->setEmail($_POST['empemail']);
        $emp->setPhone($_POST['empphone']);
        $emp->setMobile($_POST['empmobile']);
        $emp->setRatehour($_POST['empratehour']);
        $emp->setRateday($_POST['emprateday']);
        $emp->setNotes($_POST['empnotes']);
        
        if($mode == 'I'){
            $emp->setDateinsert($date);
            $emp->setInsertby($_SESSION['login']);
        }
        
        if($mode == 'U'){
            $emp->setDateupdate($date);
            $emp->setUpdateby($_SESSION['login']);
        }
                        
        return $emp;
    }
    
    /* RUNS SELECT QUERY AND SHOWS DATA (MAIN LIST) */
    function selectEmployees(){
        
        $emp = new mdlEmployee();
        $empCrud = new dbcrud();        
               
        if (isset ($_SESSION['empfilter'])) {
            $filter = $_SESSION['empfilter'];
            $sql = "SELECT * FROM employees WHERE EMPName LIKE '%:filter%' OR EMPLastName LIKE '%:filter%' OR EMPEmail LIKE '%:filter%'";
            
            $sql = str_replace(':filter', $filter, $sql);
        }
        else {
            $sql = "SELECT * FROM employees";
        }
        
        unset($_SESSION['empfilter']);
        
        /* Headers */
        echo '<tr>'
                . '<th style="width:220px">Acciones</th><th>Id.</th><th>NIF</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Móvil</th><th>Tarifa Hora</th><th>Tarifa día</th>'
           . '</tr>';
        
        /* Records */
        $result = $empCrud->sql($sql);

        if ($result->num_rows > 0) {         
          // output data of each row
          $_SESSION['numemp'] = $result->num_rows;
          
          while($row = $result->fetch_assoc()) {
            echo '<tr><td><a href="employeedata.php?empupdate&empid='.$row["EMPId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="Editar" style="margin-left: 10px"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
                    .'<a href="employeedata.php?empdelete&empid='.$row["EMPId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="Eliminar" style="margin-left: 10px"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                    .'<a href="employees.php?empid='.$row["EMPId"].'" class="btn btn-dark btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="Ver" style="margin-left: 10px"><i class="fa fa-eye" aria-hidden="true"></i></a></td>'
                    . '<td>'.$row["EMPId"].'</td><td>'.$row["EMPNatId"].'</td><td>'.$row["EMPName"].'</td>'
                    . '<td>'.$row["EMPLastName"].'</td><td>'.$row["EMPEmail"].'</td><td>'.$row["EMPMobile"].'</td><td>'.$row["EMPRateHour"].'</td><td>'.$row["EMPRateDay"].'</td>'
                
                .'</tr>';            
            }         
        }
        else {
            $_SESSION['numemp'] = 0;
        }
    }
    
    /* SHOW DATA OF ONE RECORD IN FORM */
    function selectEmpById($idemp){
        $emp= new mdlEmployee();
        $crud = new dbcrud();
        $sql = "SELECT * FROM employees WHERE EMPId = " . $idemp;  
        $sqltypes = "SELECT * FROM types WHERE TYPTable = 'EMPLOYEES'";
        
        /* Record */
        $result = $crud->sql($sql);

        if ($result->num_rows > 0) {            
               
            while($row = $result->fetch_assoc()) {
            echo '<tr><td>Id. Abogado:</td><td><input type="text" name="empid" readonly="true" value="'.$row["EMPId"].'"></td>'
                . '<td>NIF:</td><td><input type="text" name="empnatid" value="'.$row["EMPNatId"].'"></td></tr>'
                    
                . '<tr><td>Id. Usuario:</td><td><input type="text" name="empusrid" value="'.$row["EMPUsrId"].'"></td>'
                . '<td>Tipo:</td><td><select name="emptype" value=""><option value=""></option>';            
                $rtypes = $crud->sql($sqltypes);  
                while ($rowtype = $rtypes->fetch_assoc()) {
                    echo '<option value="'.$rowtype["TYPCode"].'"';
                    if ($rowtype["TYPCode"]==$row["EMPType"]) {echo ' selected="selected"';}                    
                    echo '>'.$rowtype["TYPName"].'</option>';
                }            
            echo  '</select></td></tr>'   
                //. '<td>Tipo:</td><td><input type="text" name="emptype" value="'.$row["EMPType"].'"></td></tr>'
                    
                . '<tr><td>Nombre:</td><td><input type="text" name="empname" value="'.$row["EMPName"].'"></td>'
                . '<td>Apellidos:</td><td><input type="text" name="emplastname" value="'.$row["EMPLastName"].'"></td></tr>'
                    
                . '<tr><td>Email:</td><td><input type="text" name="empemail" value="'.$row["EMPEmail"].'"></td>'
                . '<td>Teléfono:</td><td><input type="text" name="empphone" value="'.$row["EMPPhone"].'"></td></tr>'
                    
                . '<tr><td>Móvil:</td><td><input type="text" name="empmobile" value="'.$row["EMPMobile"].'"></td>'
                . '<td>Tarifa hora:</td><td><input type="text" name="empratehour" value="'.$row["EMPRateHour"].'"></td></tr>'
                    
                . '<tr><td>Tarifa día:</td><td><input type="text" name="emprateday" value="'.$row["EMPRateDay"].'"></td>'
                . '<td>Notas:</td><td><input type="text" name="empnotes" value="'.$row["EMPNotes"].'"></td></tr>'
                 
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="empdateinsert" readonly="true" value="'.$row["EMPDateInsert"].'"></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="empinsertby" readonly="true" value="'.$row["EMPInsertBy"].'"></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="empdateupdate" readonly="true" value="'.$row["EMPDateUpdate"].'"></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="empupdateby" readonly="true" value="'.$row["EMPUpdateBy"].'"></td></tr>';
                
            }
         
        } else {
            echo '<tr><td>Id. Abogado:</td><td><input type="text" name="empid" readonly="true" value=""></td>'
                . '<td>NIF:</td><td><input type="text" name="empnatid" value=""></td></tr>'
                    
                . '<tr><td>Id. Usuario:</td><td><input type="text" name="empusrid" value=""></td>'
                . '<td>Tipo:</td><td><select name="emptype" value=""><option value=""></option>';
                $rtypes = $crud->sql($sqltypes);  
                while ($rowtype = $rtypes->fetch_assoc()) {
                    echo '<option value="'.$rowtype["TYPCode"].'">'.$rowtype["TYPName"].'</option>';
                }
            echo  '</select></td></tr>'   
                //. '<td>Tipo:</td><td><input type="text" name="emptype" value="'.$row["EMPType"].'"></td></tr>'
                    
                . '<tr><td>Nombre:</td><td><input type="text" name="empname" value=""></td>'
                . '<td>Apellidos:</td><td><input type="text" name="emplastname" value=""></td></tr>'
                    
                . '<tr><td>Email:</td><td><input type="text" name="empemail" value=""></td>'
                . '<td>Teléfono:</td><td><input type="text" name="empphone" value=""></td></tr>'
                    
                . '<tr><td>Móvil:</td><td><input type="text" name="empmobile" value=""></td>'
                . '<td>Tarifa hora:</td><td><input type="text" name="empratehour" value=""></td></tr>'
                    
                . '<tr><td>Tarifa día:</td><td><input type="text" name="emprateday" value=""></td>'
                . '<td>Notas:</td><td><input type="text" name="empnotes" value=""></td></tr>'
                 
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="empdateinsert" readonly="true" value=""></td>'                    
                . '<td>Creado por:</td><td><input type="text" name="empinsertby" readonly="true" value=""></td></tr>'
                    
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="empdateupdate" readonly="true" value=""></td>'                    
                . '<td>Modificado por:</td><td><input type="text" name="empupdateby" readonly="true" value=""></td></tr>';                     
        }
         
    }
    
    /* SHOWS DATA OF SELECTED RECORD IN LIST */
    function showEmp($idemp){
        
        $crud = new dbcrud();
        $sql = "SELECT * FROM employees WHERE EMPId = " . $idemp;   
        
        /* Record */
        $result = $crud->sql($sql);

        if ($result->num_rows > 0) {
          //  while ($cols = $result->num_cols )
          //echo '<tr><th>ID</th><th>Name</th></tr>';
          // output data of each row
          
            while($row = $result->fetch_assoc()) {
            echo '<tr><td>Id. Abogado:</td><td><input type="text" name="empid" readonly="true" value="'.$row["EMPId"].'"></td></tr>'
                . '<tr><td>Id. Usuario:</td><td><input type="text" name="empusrid" value="'.$row["EMPUsrId"].'"></td></tr>'
                . '<tr><td>NIF:</td><td><input type="text" name="empnatid" value="'.$row["EMPNatId"].'"></td></tr>'
                . '<tr><td>Nombre:</td><td><input type="text" name="empname" value="'.$row["EMPName"].'"></td></tr>'
                . '<tr><td>Apellidos:</td><td><input type="text" name="emplastname" value="'.$row["EMPLastName"].'"></td></tr>'
                . '<tr><td>Email:</td><td><input type="text" name="empemail" value="'.$row["EMPEmail"].'"></td></tr>'
                . '<tr><td>Teléfono:</td><td><input type="text" name="empphone" value="'.$row["EMPPhone"].'"></td></tr>'
                . '<tr><td>Móvil:</td><td><input type="text" name="empmobile" value="'.$row["EMPMobile"].'"></td></tr>'
                . '<tr><td>Tarifa Hora:</td><td><input type="text" name="empratehour" value="'.$row["EMPRateHour"].'"></td></tr>'
                . '<tr><td>Tarifa día:</td><td><input type="text" name="emprateday" value="'.$row["EMPRateDay"].'"></td></tr>';   
            }
         
        } else {
            echo '<tr><td>Id. Abogado:</td><td><input type="text" name="empid" readonly="true" value=""></td></tr>'
                . '<tr><td>Id. Usuario:</td><td><input type="text" name="empusrid" value=""></td></tr>'
                . '<tr><td>NIF:</td><td><input type="text" name="empnatid" value=""></td></tr>'
                . '<tr><td>Nombre:</td><td><input type="text" name="empname" value=""></td></tr>'
                . '<tr><td>Apellidos:</td><td><input type="text" name="emplastname" value=""></td></tr>'
                . '<tr><td>Email:</td><td><input type="text" name="empemail" value=""></td></tr>'
                . '<tr><td>Teléfono:</td><td><input type="text" name="empphone" value=""></td></tr>'
                . '<tr><td>Móvil:</td><td><input type="text" name="empmobile" value=""></td></tr>'
                . '<tr><td>Tarifa Hora:</td><td><input type="text" name="empratehour" value=""></td></tr>'
                . '<tr><td>Tarifa día:</td><td><input type="text" name="emprateday" value=""></td></tr>';      
        }
         
    }
            
?>