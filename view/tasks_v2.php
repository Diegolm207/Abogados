<?php     
    include '../controller/cntTask.php';
    include '../controller/cntInvoice.php';
    /* si la sesión ha caducado se reenvía a la página de Login */
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
    <title>ERP - Alberto Martínez - Abogados - Tareas y Facturación</title>  
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
<body class="bgsilver">
    <?php 
        include 'menu.php'; 
        //$_SESSION['mode'] = 'read'; 
    ?>
    
    <table class="table table-borderless">
        <tr>
            <td>
                <h4>ASUNTOS - TAREAS Y FACTURACIÓN</h4>
            </td>
            <td>
                
            </td>
            <td style="text-align: right">
                <input type="hidden" name="new" value="new">
                <?php
                 if (isset($_REQUEST['idproject'])){ 
                    echo '<a href="taskdata.php?insert&idproject='. $_REQUEST['idproject'].'" target="_blank" class="btn btn-dark btn-md" role="button">Nueva Tarea</a> '; 
                    echo '<a href="invoicedata.php?insert&idproject='. $_REQUEST['idproject'].'" target="_blank" class="btn btn-dark btn-md" role="button">Nueva Factura</a>'; 
                }
                ?>                                                       
            </td>
        </tr>
    </table>
   
    <div class="row">
        <!-- DATA ENTITIES -->
        <div class="col-md-5">
            <div class="container rounded" style="margin: auto; background: whitesmoke; padding: 10px;">  
            <h4 style="margin-left: 5px">Cliente</h4>
            <div class="table-responsive"> <!-- Adds Scrollbars if it is needed-->
                <table id="DataTable" class="table table-striped" style="font-size: 75%">
                    <?php                        
                        if (isset($_REQUEST['idproject'])){ 
                            selectedEntityById(getIdEntity($_REQUEST['idproject']));                            
                        }                       
                    ?>
                </table>   
            </div>
            </div>
            <!-- DATA PROJECT -->
            <div class="container rounded" style="margin: auto; background: whitesmoke; padding: 10px;"> 
            <h4 style="margin-left: 5px">Asunto</h4>
            <form class="w3-container" action="../controller/cntProject.php" method="post">
                <table class="table table-striped" style="font-size: 75%">                    
                    <?php 
                    if (isset($_REQUEST['idproject'])){ 
                        selectedProjectById($_REQUEST['idproject']);                         
                    }
                    ?>                   
                </table>
            </form>
            </div>            
            
        </div>
        
        
        
        <div class="col-md-7">
            <!-- INVOICING -->
            <div class="d-grid">
                <button type="button" class="btn btn-dark btn-md" data-bs-toggle="collapse" data-bs-target="#facturacion">HITOS DE FACTURACIÓN. PULSAR PARA DESPLEGAR</button>
            </div>
            <div id="facturacion" class="collapse">
                <br>
                <div class="table-responsive" style="height: 300px;overflow: scroll;"> <!-- Adds Scrollbars if it is needed-->
                    <table id="DataTable" class="table table-striped" style="font-size: 75%">
                        <?php                        
                            if (isset($_REQUEST['idproject'])){ 
                                selectInvoices($_REQUEST['idproject']);                            
                            }                       
                        ?>
                    </table>   
                </div>
            </div>  
             <!-- TASKS -->
             <div class="d-grid">
                <button type="button" class="btn btn-dark btn-md" data-bs-toggle="collapse" data-bs-target="#listatareas">TAREAS. PULSAR PARA DESPLEGAR</button>
            </div>
            <div id="listatareas" class="collapse">
                <br>
                <div class="table-responsive" style="height: 300px;overflow: scroll;"> <!-- Adds Scrollbars if it is needed-->
                    <table id="DataTable" class="table table-striped" style="font-size: 75%; height: 100px; overflow: scroll;">
                        <?php                        
                            if (isset($_REQUEST['idproject'])){ 
                                selectTasks($_REQUEST['idproject']);                            
                            }

                        ?>
                    </table>   
                </div>
            </div>
            
        </div>  
    </div>
    
    <div class="row">
        <div class="col-md-12"> 
                      
        </div>        
    </div>
    <br>
   
    <div class="row">
        <div class="col-md-12">
            
        </div>        
    </div>
	
</body>
</html>