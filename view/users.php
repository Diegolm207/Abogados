<?php     
    include '../controller/cntUser.php';
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
    <title>ERP - Alberto Martínez - Usuarios</title>  
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
        $_SESSION['mode'] = 'read'; 
    ?>
    
    <table class="table table-borderless">
        <tr>
            <td>
                <h4> <a href="users.php" style="align: right; color: black">USUARIOS</a> </h4>
            </td>
            <td>
                <form class="w3-container" action="../controller/cntUser.php" method="post">
                    Buscar: <input type="text" name="usrfilter" id="txtfilter" size="40" value="">
                    
                    <input type="submit" class="btn btn-dark btn-md" value="Buscar">
                </form
            </td>
            <td style="text-align: right">
                <input type="hidden" name="new" value="new">
                <a href="userdata.php?insert" target="_blank" class="btn btn-dark btn-md" role="button">Nuevo</a>                                                       
            </td>
        </tr>
    </table>
   
    <div class="row">
        <!-- DATA TABBLE -->
        <div class="col-md-9">
            <div class="table-responsive"> <!-- Adds Scrollbars if it is needed-->
                <table id="DataTable" class="table table-striped" style="font-size: 75%">
                    <?php selectUsers(); ?>
                </table>   
            </div>
        </div>
        <!-- LEFT FORM, RECORD DATA -->
        <div class="col-md-3">
            <form class="w3-container" action="../controller/cntUser.php" method="post">
                <table class="table table-striped" style="font-size: 75%">
                    <tr><th>Total Registros:</th>
                        <th>
                            <?php 
                            if (isset ($_SESSION['numusers'])){
                                echo $_SESSION['numusers']; 
                            }
                            ?>
                        </th></tr>
                    <?php 
                    if (isset($_REQUEST['iduser'])){ 
                        showUser($_REQUEST['iduser']);
                    }
                    else {
                        showUser(-1);
                    }
                    ?>
                   
                </table>
            </form>
        </div>  
    </div>
	
</body>
</html>