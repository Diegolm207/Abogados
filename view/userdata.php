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
    
        
    <script language="JavaScript">
        function Confirm(){
            if (confirm('¿Estás seguro ejecutar la acción?')){
                document.dataidu.submit();
            }
            else{
                alert('Operacion Cancelada');
            }
        }
    </script>
    
</head>
<body class="bgsilver">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="home.php">Plataforma de Gestión Jurídica - Usuario - 
            <?php 
                if (isset ($_REQUEST['insert'])){                
                    $_SESSION['mode'] = 'insert';
                    $mode='NUEVO';
                    echo 'Nuevo';
                }
                if (isset ($_REQUEST['update'])){
                    $_SESSION['mode'] = 'update';
                    $mode='EDITAR';
                    echo 'Editar';
                }                
                if (isset ($_REQUEST['delete'])){                
                    $_SESSION['mode'] = 'delete';
                    $mode='ELIMINAR';
                    echo 'Eliminar';
                }
               
            ?>
        </a>                   
    </nav>
    <form name=dataidu class="w3-container" action="../controller/cntUser.php" method="post">
        <table class="table table-borderless">
            <tr>                
                <td>  
                    <!--<input type="hidden" name="save" value="save">
                    <button class="btn btn-dark btn-sm">Guardar</button>-->
                    <input type=button onclick="Confirm()" class="btn btn-dark btn-sm" value="<?php echo $mode ?>">
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-striped" style="font-size: 75%">
                    <?php
                        echo '<tr><td>Acción:</td><td><input type="text" name="idu" value="'. $mode.'" readonly></td></tr>';
                        /*Show form with data or empty*/
                        if (isset($_REQUEST['iduser'])){ 
                            selectUserById($_REQUEST['iduser']);
                        }
                        else {
                            selectUserById(-1);
                        }
                    ?>
                </table>
            </div>
        </div>
    </form>
    
</body>
</html>