<?php
    session_start();  
    include '../controller/cntHome.php';
    if (!isset($_SESSION["username"])) {
	header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html>
    <!--
    Project: LAW MANAGEMENT PLATFORM
    Date: September 2020
    By: Alberto Martínez pineda
    -->
<head>
    <title>ERP - Alberto Martínez</title>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/globalstyles.css">
    
    <!-- BS5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>   
     
    <!-- BS5 -->
    
    <link rel="icon" type="image/png" href="imgs/icons/legal03.png">
    
    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        
    <!-- OLD VERSIONS
        BS4
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>        
    -->
      
</head>
<body class="bgmain">    
    <?php include 'menu.php'; ?>   
    <h4>Inicio de Sesión correcto: 
    <?php
     if(isset ($_SESSION['username'])){
         echo $_SESSION['username'];
     }
     else {
         echo "Sin Usuario";
     }   
    ?>
    </h4>
    <br>
    <h1>HOME - DASHBOAD </h1>       
    <div class="row">
        <!-- DATA TABBLE -->
        <div class="col-md-3">
            <div class="table-responsive"> <!-- Adds Scrollbars if it is needed-->
                <table id="DataTable" class="table table-striped" style="font-size: 75%">
                    <tr><th>Dato Estadístico</th><th>Valor</th></tr>
                    <?php 
                        selectEntities();
                        selectProjects();
                    ?>
                </table>   
            </div>
        </div>
        <!-- LEFT FORM, RECORD DATA -->
        <div class="col-md-3">
            <form class="w3-container" action="../controller/cntEmployee.php" method="post">
                <table class="table table-striped" style="font-size: 75%">
                    <?php //selectEmployees(); ?> 
                </table>
            </form>
        </div>  
    </div>   
    
    
	
</body>
</html>