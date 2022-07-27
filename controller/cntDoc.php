<?php    
    session_start();
    include_once '../model/mdlDoc.php';
    include_once '../model/dbcrud.php';
           
    if (isset ($_POST['idu']) && $_POST['idu'] == 'NUEVO'){
        //Insert new Record
        try{
            $date = date('Y-m-d H:i:s');
            $doc = new mdlDoc();
                        
            $doc = setData('I');          

            $doc->insert();

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
            $doc = new mdlDoc();
            
            $doc = setData('U');

            $doc->update();
            
            echo "<script>alert('El registro se ha editado correctamente.');</script>";
            
            unset ($_SESSION['mode']);
            echo '<script type="text/javascript">window.location="../view/docdata.php?update&docid='.$doc->getId().'";</script>';   
                
;
        }
        catch (Exception $e)
        {
            echo "<script>alert('Se ha producido un error en el proceso:'" . var_dump($e) .");</script>";   
        }
        
    }elseif (isset ($_POST['idu']) && $_POST['idu'] == 'ELIMINAR') {
                      
        //Delete current Record
        $doc = new mdlDoc();        
               
        $doc = setData('D');
        
        $doc->delete();
        
        unset ($_SESSION['mode']);
        echo "<script>window.close();</script>";
            
    }
    
    function setData ($mode){
        
        $date = date('Y-m-d H:i:s');
        $doc = new mdlDoc();
        
        $doc->setId($_POST['docid']);
        $doc->setName($_POST['name']);
        $doc->setObj($_POST['obj']);
        $doc->setObjid($_POST['objid']);
        $doc->setPath($_POST['path']);
//        $folder = $_POST['obj'] . '/' . $_POST['objid'];
//        uploadFile($folder, basename($_FILES['path']['name']));
 
                
        if ($mode == 'I'){
            $doc->setDateInsert($date);
            $doc->setInsertBy($_SESSION['login']);            
        }
                
        return $doc;        
    }
    
    function uploadFile($folder, $path)
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . $path;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($path);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                 echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($path, $target_file)) {
            echo "The file ". htmlspecialchars($path). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
    }
    
    if (isset ($_POST['docfilter'])){        
        $_SESSION['docfilter'] = $_POST['docfilter'];
        echo '<script type="text/javascript">window.location="../view/docs.php";</script>';                
    }
    
    function listDocs(){
        $doc = new mdlDoc();
        $docCrud = new dbcrud();   
        
        if (isset($_REQUEST['obj'])){ 
            $table = $_REQUEST['obj'];
        }
        if (isset($_REQUEST['objid'])){ 
            $docid = $_REQUEST['objid'];
        }
          
        $docsSQL = "SELECT * FROM documents WHERE DOCObj = ':table' AND DOCObjId = :docid";
            
        $docsSQL = str_replace(':table', $table, $docsSQL);
        $docsSQL = str_replace(':docid', $docid, $docsSQL);
        
        
        /* Headers */
        echo '<tr>'
                . '<th style="width:220px">Acciones</th><th>Id.</th><th>Nombre</th><th>Ruta</th><th>Insertado</th><th>Insertado por</th>'
           . '</tr>';
        
        /* Records */
        $result = $docCrud->sql($docsSQL);

        if ($result->num_rows > 0) {         
          // output data of each row
          $_SESSION['numdocs'] = $result->num_rows;
          
          while($row = $result->fetch_assoc()) {
            echo '<tr><td><a href="docdata.php?update&docid='.$row["DOCId"].'" target="_blank" class="btn btn-dark btn-sm" role="button">Editar</a>'
                    .'<a href="docdata.php?delete&docid='.$row["DOCId"].'" target="_blank" class="btn btn-dark btn-sm" role="button" style="margin-left: 10px">Borrar</a>'
                                  
                    . '<td>'.$row["DOCId"].'</td><td>'.$row["DOCName"].'</td><td><a href="'.$row["DOCPath"].'" target="_blank">'.$row["DOCPath"].'</a></td><td>'
                    .$row["DOCInsertDate"].'</td><td>'.$row["DOCInsertBy"].'</td></tr>';            
            }         
        }
        else {
            $_SESSION['numdocs'] = 0;
        }
    }
    
   
    function selectDocById($docid, $obj, $objid){
        $doc = new mdlDoc();
        $docCrud = new dbcrud();
        $docsSQL = "SELECT * FROM documents WHERE DOCId = " . $docid; 
                
        /* Record */
        $result = $docCrud->sql($docsSQL);
                
        if ($result->num_rows > 0) {
                  
            while($row = $result->fetch_assoc()) {
            echo '<tr><td>Id. Doc:</td><td><input type="text" name="docid" readonly="true" value="'.$row["DOCId"].'"></td></tr>'                
                . '<tr><td>Tabla:</td><td><input type="text" name="obj" value="'.$row["DOCObj"].'"></td></tr>'
                . '<tr><td>Id:</td><td><input type="text" name="objid" value="'.$row["DOCObjId"].'"></td></tr>'
                . '<tr><td>Nombre:</td><td><input type="text" name="name" value="'.$row["DOCName"].'"></td></tr>'
                . '<tr><td>Link:</td><td><input type="text" name="path" value="'.$row["DOCPath"].'"></td></tr>'
                . '<tr><td>Creado:</td><td><input type="text" name="insertdate" value="'.$row["DOCInsertDate"].'"></td></tr>'
                . '<tr><td>Creado por:</td><td><input type="text" name="insertby" value="'.$row["DOCInsertBy"].'"></td></tr>';            
            }
         
        } else {
            echo  '<tr><td>Id. Doc:</td><td><input type="text" name="docid" readonly="true" value=""></td></tr>'                
                . '<tr><td>Tabla:</td><td><input type="text" name="obj" readonly="true" value="'.$obj.'"></td></tr>'
                . '<tr><td>Id:</td><td><input type="text" name="objid" readonly="true" value="'.$objid.'"></td></tr>'
                . '<tr><td>Nombre:</td><td><input type="text" name="name" value=""></td></tr>'
                . '<tr><td>Ruta:</td><td><input type="link" name="path" value=""></td></tr>'
                . '<tr><td>Creado:</td><td><input type="text" name="insertdate" readonly="true" value=""></td></tr>'
                . '<tr><td>Creado por:</td><td><input type="text" name="insertby" readonly="true" value=""></td></tr>';
        }
         
    }
    
    
            
?>