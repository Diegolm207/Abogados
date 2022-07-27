<?php
    include_once ('dbconn.php');
    
    class dbcrud {
        
        public function sql ($sql){
        
            // Create connection
            $dbConn = new dbconn();        
            $dbConn->connect();
           
            
            $conn = $dbConn->getConn();
            $result = $conn->query($sql);           
            
            $conn->close();  
            
            return $result;
            
        }
        
        
        public function selectId ($table, $id, $value){
        
            // Create connection
            $conn = new dbconn();        
            $conn->connect(); 

            $sql = "SELECT * FROM " + $table + " WHERE " + $id + " = " + $value;

            //$conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              echo "<table><tr><th>ID</th><th>Name</th></tr>";
              // output data of each row
              while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
              }
              echo "</table>";
            } else {
              echo "0 results";
            }
            $conn->close();            
            
        }
        
        
        
        
    }

?>