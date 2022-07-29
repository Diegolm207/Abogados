<!DOCTYPE html>
<?php 

    echo '
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="home.php">Plataforma de Gestión Jurídica</a>
            
            
            
            <!-- Links -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="projects.php">Gestión Casos</a>
                  </li>

                  <!-- Dropdown -->
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                      Ficheros Base
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="entities.php">Clientes</a>
                      <a class="dropdown-item" href="employees.php">Abogados</a>              
                    </div>
                  </li>
                  <!-- Dropdown -->
                  <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                      Configuración
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="users.php">Usuarios</a>
                      <a class="dropdown-item" href="#">Plataforma</a>              
                    </div>
                  </li>
                </ul>
            </div>  
            <!-- Info -->
            <span class="navbar-text">HERAS Y ABOGADOS - ';
                echo date("jS F Y") . " - Usuario: ";   
                if(isset ($_SESSION['username'])){
                    echo $_SESSION['username'];
                }
                echo '   
            </span>
            <form class="w3-container" action="../controller/cntLogin.php" method="post">
                <input type="hidden" name="salir" value="salir">
                <button class="btn btn-dark btn-md" style="margin-left: 10px">Salir</button>
            </form>
    </nav>';
        

?>
   



