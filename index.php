<?php 
    //session_start();   
    include 'model/dbconn.php';  
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
    <link rel="stylesheet" href="view/css/globalstyles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    
    <link rel="icon" type="image/png" href="view/imgs/icons/legal03.png">
    
</head>
<body class="bgmain">
    <header>
        <div class="w3-container w3-center bg-dark text-white">
            <h1>Plataforma de Gestión Jurídica</h1>
        </div>
    </header>
    <br>
    <br>
    <br>
    <div class="container rounded" style="max-width: 600px; margin: auto; background: white; padding: 10px;">           
        <h2>Login</h2>            
        <br>
        <br>
        <form class="w3-container" action="controller/cntLogin.php" method="post">
            <p>
            <label class="w3-label">Usuario</label>
            <input class="w3-input w3-border " type="text" name="usuario">
            </p>
            <p>
            <label class="w3-label">Password</label>
            <input class="w3-input w3-border" type="password" name="pas">
            </p>
            <p>            
            <input type="hidden" name="entrar" value="entrar">
            <button class="btn bg-dark text-white"> <!-- style="background-color:#004d4d" -->
                Iniciar Sesión
            </button>           
            </p>            
	</form>
            <br>
            <br>  
         <div class="container rounded bg-dark text-white">            
            <?php
                //echo date("jS F Y") 
            ?>
             <br>  
            Designed by Alberto Martínez Pineda
        </div>
    </div>
    <br>         
    <br>
    <br>
       
</body>
</html>