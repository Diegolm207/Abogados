<?php    
    session_start();
    include_once '../model/mdlUser.php';
    include_once '../model/dbcrud.php';
    
    
    //if (isset($_SESSION['mode']) && strcmp($_SESSION['mode'], 'new1') == 0 ) {
    if (isset ($_POST['idu']) && $_POST['idu'] == 'NUEVO'){
        //Insert new Record
        try{
            $date = date('Y-m-d H:i:s');
            $user = new mdlUser();
            $usrCrud = new dbcrud();
            
            $user = setData('I');          

            $user->insert();

            echo "<script>alert('El registro se ha creado correctamente.');</script>"; 
            
            /*TODO: To get the Id. of the new record.*/
            unset ($_SESSION['mode']);        
            echo "<script>window.close();</script>";            
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
    }
    //elseif (isset($_SESSION['mode']) && strcmp($_SESSION['mode'], 'update1') == 0){
    elseif (isset ($_POST['idu']) && $_POST['idu'] == 'EDITAR') {
        //Update current Record
        try{
            $date = date('Y-m-d H:i:s');
            $user = new mdlUser();
            $usrCrud = new dbcrud();

            $user = setData('U');

            $user->update();
            
            echo "<script>alert('El registro se ha editado correctamente.');</script>";
            
            unset ($_SESSION['mode']);
            echo '<script type="text/javascript">window.location="../view/userdata.php?update&iduser='.$user->getId().'";</script>';            
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
        
    }elseif (isset ($_POST['idu']) && $_POST['idu'] == 'ELIMINAR') {
                      
        //Delete current Record
        $user = new mdlUser();
        $usrCrud = new dbcrud();
               
        $user = setData('D');
        
        $user->delete();
        
        unset ($_SESSION['mode']);
        echo "<script>window.close();</script>";
            
    }
    
    function setData ($mode){
        
        $date = date('Y-m-d H:i:s');
        $user = new mdlUser();
        
        $user->setId($_POST['USRId']);
        $user->setLogin($_POST['USRLogin']);
        $user->setPsw($_POST['USRPsw']);
        $user->setEmail($_POST['USREmail']);
        $user->setName($_POST['USRName']);
        $user->setLastName($_POST['USRLastName']);
        
        if ($mode == 'I'){
            $user->setDateInsert($date);
            $user->setInsertBy($_SESSION['login']);            
        }
        if ($mode=='U'){
            $user->setDateUpdate($date);
            $user->setUpdateBy($_SESSION['login']);            
        }
        
        return $user;        
    }
    
    if (isset ($_POST['usrfilter'])){        
        $_SESSION['usrfilter'] = $_POST['usrfilter'];
        echo '<script type="text/javascript">window.location="../view/users.php";</script>';                
    }
    
    function selectUsers(){
        $user = new mdlUser();
        $usrCrud = new dbcrud();
        
               
        if (isset ($_SESSION['usrfilter'])) {
            $filter = $_SESSION['usrfilter'];
            $usersSQL = "SELECT * FROM users WHERE USRName LIKE '%:filter%' OR USRLastName LIKE '%:filter%' OR USRLogin LIKE '%:filter%'";
            
            $usersSQL = str_replace(':filter', $filter, $usersSQL);
        }
        else {
            $usersSQL = "SELECT * FROM users";
        }
        
        /* Headers */
        unset($_SESSION['usrfilter']);
        
        echo '<tr>'
                . '<th style="width:220px">Acciones</th><th>Id.</th><th>Login</th><th>Contraseña</th><th>Email</th><th>Nombre</th><th>Apellidos</th>'
           . '</tr>';
        
        /* Records */
        $result = $usrCrud->sql($usersSQL);

        if ($result->num_rows > 0) {         
          // output data of each row
          $_SESSION['numusers'] = $result->num_rows;
          
          while($row = $result->fetch_assoc()) {
            echo '<tr><td><a href="userdata.php?update&iduser='.$row["USRId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>'
                    .'<a href="userdata.php?delete&iduser='.$row["USRId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" style="margin-left: 10px" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>'
                    .'<a href="users.php?iduser='.$row["USRId"].'" class="btn btn-dark btn-sm" role="button" style="margin-left: 10px" data-toggle="tooltip" data-placement="top" title="Ver datos"><i class="fa fa-eye" aria-hidden="true"></i></a></td>'
              
                    . '<td>'.$row["USRId"].'</td><td>'.$row["USRLogin"].'</td><td>'.$row["USRPsw"].'</td><td>'
                    .$row["USREmail"].'</td><td>'.$row["USRName"].'</td><td>'.$row["USRLastName"].'</td>'
                    
                    
                
                    .'</tr>';            
            }         
        }
        else {
            $_SESSION['numusers'] = 0;
        }
    }
    
    function selectUserById($idUser){
        $user = new mdlUser();
        $usrCrud = new dbcrud();
        $usersSQL = "SELECT * FROM users WHERE USRId = " . $idUser;   
        
        /* Record */
        $result = $usrCrud->sql($usersSQL);

        if ($result->num_rows > 0) {
          //  while ($cols = $result->num_cols )
          //echo '<tr><th>ID</th><th>Name</th></tr>';
          // output data of each row
          
            while($row = $result->fetch_assoc()) {
            echo '<tr><td>Id. Usr:</td><td><input type="text" name="USRId" readonly="true" value="'.$row["USRId"].'"></td></tr>'
                . '<tr><td>Login:</td><td><input type="text" name="USRLogin" value="'.$row["USRLogin"].'"></td></tr>'
                . '<tr><td>Contraseña:</td><td><input type="text" name="USRPsw" value="'.$row["USRPsw"].'"></td></tr>'
                . '<tr><td>Email:</td><td><input type="text" name="USREmail" value="'.$row["USREmail"].'"></td></tr>'
                . '<tr><td>Nombre:</td><td><input type="text" name="USRName" value="'.$row["USRName"].'"></td></tr>'
                . '<tr><td>Apellidos:</td><td><input type="text" name="USRLastName" value="'.$row["USRLastName"].'"></td></tr>';            
            }
         
        } else {
            echo '<tr><td>Id. Usr:</td><td><input type="text" name="USRId" readonly="true" value=""></td></tr>'
                . '<tr><td>Login:</td><td><input type="text" name="USRLogin" value=""></td></tr>'
                . '<tr><td>Contraseña:</td><td><input type="text" name="USRPsw" value=""></td></tr>'
                . '<tr><td>Email:</td><td><input type="text" name="USREmail" value=""></td></tr>'
                . '<tr><td>Nombre:</td><td><input type="text" name="USRName" value=""></td></tr>'
                . '<tr><td>Apellidos:</td><td><input type="text" name="USRLastName" value=""></td></tr>';
        }
         
    }
    
    function showUser($idUser){
        $user = new mdlUser();
        $usrCrud = new dbcrud();
        $usersSQL = "SELECT * FROM users WHERE USRId = " . $idUser;   
        
        /* Record */
        $result = $usrCrud->sql($usersSQL);

        if ($result->num_rows > 0) {
          //  while ($cols = $result->num_cols )
          //echo '<tr><th>ID</th><th>Name</th></tr>';
          // output data of each row
          
            while($row = $result->fetch_assoc()) {
            echo '<tr><td>Id. Usr:</td><td><input type="text" name="USRId" readonly="true" value="'.$row["USRId"].'"></td></tr>'
                . '<tr><td>Login:</td><td><input type="text" name="USRLogin" readonly="true" value="'.$row["USRLogin"].'"></td></tr>'
                . '<tr><td>Contraseña:</td><td><input type="text" name="USRPsw" readonly="true" value="'.$row["USRPsw"].'"></td></tr>'
                . '<tr><td>Email:</td><td><input type="text" name="USREmail" readonly="true" value="'.$row["USREmail"].'"></td></tr>'
                . '<tr><td>Nombre:</td><td><input type="text" name="USRName" readonly="true" value="'.$row["USRName"].'"></td></tr>'
                . '<tr><td>Apellidos:</td><td><input type="text" name="USRLastName" readonly="true" value="'.$row["USRLastName"].'"></td></tr>'
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="USRDateInsert" readonly="true" value="'.$row["USRDateInsert"].'"></td></tr>'
                . '<tr><td>Creado por:</td><td><input type="text" name="USRInsertBy" readonly="true" value="'.$row["USRInsertBy"].'"></td></tr>'
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="USRDateUpdate" readonly="true" value="'.$row["USRDateUpdate"].'"></td></tr>'
                . '<tr><td>Modificado por:</td><td><input type="text" name="USRUpdateBy" readonly="true" value="'.$row["USRUpdateBy"].'"></td></tr>';
            }
         
        } else {
            echo '<tr><td>Id. Usr:</td><td><input type="text" name="USRId" readonly="true" value=""></td></tr>'
                . '<tr><td>Login:</td><td><input type="text" name="USRLogin" readonly="true" value=""></td></tr>'
                . '<tr><td>Contraseña:</td><td><input type="text" name="USRPsw" readonly="true" value=""></td></tr>'
                . '<tr><td>Email:</td><td><input type="text" name="USREmail" readonly="true" value=""></td></tr>'
                . '<tr><td>Nombre:</td><td><input type="text" name="USRName" readonly="true" value=""></td></tr>'
                . '<tr><td>Apellidos:</td><td><input type="text" name="USRLastName" readonly="true" value=""></td></tr>'
                . '<tr><td>Fecha Creación:</td><td><input type="text" name="USRDateInsert" readonly="true" value=""></td></tr>'
                . '<tr><td>Creado por:</td><td><input type="text" name="USRInsertBy" readonly="true" value=""></td></tr>'
                . '<tr><td>Fecha Modificación:</td><td><input type="text" name="USRDateUpdate" readonly="true" value=""></td></tr>'
                . '<tr><td>Modificado por:</td><td><input type="text" name="USRUpdateBy" readonly="true" value=""></td></tr>';
        }
         
    }
            
?>