<?php 
    session_start();  
    require_once('../model/mdlUser.php');
    
    $user = new mdlUser();
    
    //verifica si la variable registrarse está definida
	//se da que está definicda cuando el usuario se loguea, ya que la envía en la petición
    if (isset($_POST['registrarse'])) {
        $user->setNombre($_POST['usuario']);
        $user->setPsw($_POST['pas']);
        if ($crud->buscarUsuario($_POST['usuario'])) {
            $crud->insertar($user);
            echo '<script type="text/javascript">window.location="../index.php";</script>';
            //header('Location: ../index.php');
        }else{
            echo '<script type="text/javascript">window.location="../index.php";</script>';
            //header('Location: ../error.php?mensaje=El nombre de usuario ya existe');
        }		
		
    }elseif (isset($_POST['entrar'])) { //verifica si la variable entrar está definida        
        
        
        $val = $user->login($_POST['usuario'],$_POST['pas']);  
        echo $val;
        
        if ($val == "OK") {           
            
            $_SESSION['username'] = $user->getName(); //si el usuario se encuentra, crea la sesión de usuario
            $_SESSION['login'] = $user->getLogin();
            
            echo '<script type="text/javascript">window.location="../view/home.php";</script>';
            //header('Location: ../view/home.php');
        }else{
            echo '<script type="text/javascript">window.location="../view/error.php?mensaje=Tus nombre de usuario o clave son incorrectos";</script>';
            //header('Location: ../view/error.php?mensaje=Tus nombre de usuario o clave son incorrectos'); // cuando los datos son incorrectos envia a la página de error
        }
        
    }elseif(isset($_POST['salir'])){ // cuando presiona el botòn salir
        session_unset();    
        echo '<script type="text/javascript">window.location="../index.php";</script>';
        //header('Location: ../index.php');
            
    }
?>