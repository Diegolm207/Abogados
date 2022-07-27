<?php 
    include_once '../model/dbcrud.php';
    /*
        SELECT COUNT(*) DATA FROM entities;
        SELECT COUNT(*) DATA FROM entities WHERE ENTStatus = 'ACT';
        SELECT COUNT(*) DATA FROM projects;
        SELECT COUNT(*) DATA FROM projects WHERE PRJStatus <> 'PCRD';
      
    */
    
    /* RUNS SELECT QUERY AND SHOWS DATA (MAIN LIST) */
    function selectEntities(){
        
        //$emp = new mdlEmployee();
        $crud = new dbcrud();        
               
   
        $sql = "SELECT COUNT(*) DATA FROM entities;";
        
        /* Records */
        $result = $crud->sql($sql);

        if ($result->num_rows > 0) {        
                    
          while($row = $result->fetch_assoc()) {
            echo '<tr><td>Total Clientes: </td><td>'.$row["DATA"].'</td></tr>';            
            }         
        }
        
        $sql = "SELECT COUNT(*) DATA FROM entities WHERE ENTStatus = 'ACT';";
        
        /* Records */
        $result = $crud->sql($sql);

        if ($result->num_rows > 0) {        
                    
          while($row = $result->fetch_assoc()) {
            echo '<tr><td>Total Clientes Activos: </td><td>'.$row["DATA"].'</td></tr>';            
            }         
        }
       
    }
    
    function selectProjects(){
        
        //$emp = new mdlEmployee();
        $crud = new dbcrud();     
   
        $sql = "SELECT COUNT(*) DATA FROM projects;";
              
        /* Records */
        $result = $crud->sql($sql);

        if ($result->num_rows > 0) {        
                    
          while($row = $result->fetch_assoc()) {
            echo '<tr><td>Total Asuntos: </td><td>'.$row["DATA"].'</td></tr>';            
            }         
        }
        
        $sql = "SELECT COUNT(*) DATA FROM projects WHERE PRJStatus <> 'PCRD';";
        
        /* Records */
        $result = $crud->sql($sql);

        if ($result->num_rows > 0) {        
                    
          while($row = $result->fetch_assoc()) {
            echo '<tr><td>Total Asuntos Activos: </td><td>'.$row["DATA"].'</td></tr>';            
            }         
        }
       
    }
    
    
            
?>